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
            'title' => 'required|string|max:255',
            'type' => 'required|in:text,image,file,video',
            'content' => 'required_if:type,text',
            'file' => 'required_if:type,image,file,video|file|max:10240', // 10MB max
        ]);

        $data = [
            'title' => $request->title,
            'type' => $request->type,
            'course_id' => $course->id,
            'user_id' => Auth::id(),
        ];

        if ($request->type === 'text') {
            $data['content'] = $request->content;
        } else {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('posts', $fileName, 'public');
                $data['file_path'] = $filePath;
            }
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
            'title' => 'required|string|max:255',
            'content' => 'required_if:type,text',
            'file' => 'nullable|file|max:10240',
        ]);

        $data = [
            'title' => $request->title,
        ];

        if ($post->type === 'text') {
            $data['content'] = $request->content;
        } else {
            if ($request->hasFile('file')) {
                // Delete old file
                if ($post->file_path) {
                    Storage::disk('public')->delete($post->file_path);
                }
                
                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('posts', $fileName, 'public');
                $data['file_path'] = $filePath;
            }
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
            Storage::disk('public')->delete($post->file_path);
        }
        
        $course = $post->course;
        $post->delete();
        
        return redirect()->route('courses.show', $course)->with('success', 'Post deleted successfully!');
    }
}
