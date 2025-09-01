<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            $posts = Post::with(['course', 'user'])->get();
        } elseif ($user->isTeacher()) {
            $posts = Post::whereHas('course', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->with(['course', 'user'])->get();
        } else {
            $posts = Post::whereHas('course.enrollments', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->with(['course', 'user'])->get();
        }
        
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course)
    {
        if (!Auth::user()->canManageCourse($course)) {
            return redirect()->route('courses.show', $course)
                ->with('error', 'You do not have permission to create posts in this course.');
        }
        
        return view('posts.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Course $course)
    {
        if (!Auth::user()->canManageCourse($course)) {
            return redirect()->route('courses.show', $course)
                ->with('error', 'You do not have permission to create posts in this course.');
        }

        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'nullable|string',
            'file'    => 'nullable|file|max:30000', // max 30MB
            'link'    => 'nullable|url',
        ]);

        // pastikan salah satu ada
        if (!$request->content && !$request->hasFile('file')) {
            return back()->withErrors(['content' => 'Content or File is required.']);
        }

        $data = [
            'title'     => $request->title,
            'content'   => $request->content,
            'course_id' => $course->id,
            'user_id'   => Auth::id(),
            'link'      => $request->link,
        ];

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
        
            // simpan langsung ke public/uploads
            $file->move(public_path('uploads/posts'), $fileName);
        
            $data['file_path'] = 'uploads/posts/' . $fileName;
        }

        Post::create($data);

        return redirect()->route('courses.show', $course)->with('success', 'Post created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $user = Auth::user();
        
        // Check if user can access this post
        if (!$user->isAdmin() && !$user->canManageCourse($post->course)) {
            // Check if user is enrolled in the course
            $isEnrolled = $post->course->enrollments()->where('user_id', $user->id)->exists();
            if (!$isEnrolled) {
                return redirect()->route('courses.index')
                    ->with('error', 'You do not have access to this post.');
            }
        }
        
        $post->load(['course', 'user']);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (!Auth::user()->canManageCourse($post->course)) {
            return redirect()->route('courses.show', $post->course)
                ->with('error', 'You do not have permission to edit this post.');
        }
        
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if (!Auth::user()->canManageCourse($post->course)) {
            return redirect()->route('courses.show', $post->course)
                ->with('error', 'You do not have permission to edit this post.');
        }
    
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'nullable|string',
            'file'    => 'nullable|file|max:30000',
            'link'    => 'nullable|url',
        ]);
    
        if (!$request->content && !$request->hasFile('file') && !$post->file_path) {
            return back()->withErrors(['content' => 'Content or File is required.']);
        }
    
        $data = [
            'title'   => $request->title,
            'content' => $request->content,
            'link'    => $request->link,
        ];
    
        if ($request->hasFile('file')) {
            // hapus file lama kalau ada
            if ($post->file_path) {
                $oldFile = public_path($post->file_path);
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }
    
            // simpan file baru
            $file     = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/posts'), $fileName);
    
            $data['file_path'] = 'uploads/posts/' . $fileName;
        }
    
        $post->update($data);
    
        return redirect()->route('courses.show', $post->course)->with('success', 'Post updated successfully!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (!Auth::user()->canManageCourse($post->course)) {
            return redirect()->route('courses.show', $post->course)
                ->with('error', 'You do not have permission to delete this post.');
        }
        
        if ($post->file_path) {
            $filePath = public_path($post->file_path);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        
        $course = $post->course;
        $post->delete();
        
        return redirect()->route('courses.show', $course)->with('success', 'Post deleted successfully!');
    }
}
