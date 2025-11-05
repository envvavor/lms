<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            $courses = Course::with('posts')->paginate(12);
        } elseif ($user->isTeacher()) {
            $courses = Course::where('user_id', $user->id)
                ->orWhereHas('enrollments', function($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->with('posts')
                ->paginate(10);
        } else {
            $courses = $user->enrolledCourses()->with('posts')->paginate(12);
        }

        // Hitung progress untuk setiap course
        foreach ($courses as $course) {
            $totalPosts = $course->posts->count();

            if ($totalPosts > 0) {
                // Ambil data post yang sudah dilihat user (bisa dari tabel course_views / post_views)
                $viewedPosts = \DB::table('post_views')
                    ->where('user_id', $user->id)
                    ->whereIn('post_id', $course->posts->pluck('id'))
                    ->count();

                $course->progress = round(($viewedPosts / $totalPosts) * 100, 2);
            } else {
                $course->progress = 0;
            }
        }

        return view('courses.index', compact('courses'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()->canCreateCourses()) {
            return redirect()->route('courses.index')
                ->with('error', 'You do not have permission to create courses.');
        }
        
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::user()->canCreateCourses()) {
            return redirect()->route('courses.index')
                ->with('error', 'You do not have permission to create courses.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        Course::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('courses.index')->with('success', 'Course created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $user = Auth::user();

        // Access control
        if (!$user->isAdmin() && !$user->canManageCourse($course)) {
            $isEnrolled = $course->enrollments()->where('user_id', $user->id)->exists();
            if (!$isEnrolled) {
                return redirect()->route('courses.index')
                    ->with('error', 'You do not have access to this course.');
            }
        }

        $course->load('posts.user');

        // === Calculate progress ===
        $totalPosts = $course->posts()->count();
        $viewedPosts = \App\Models\PostView::where('user_id', $user->id)
            ->whereIn('post_id', $course->posts->pluck('id'))
            ->count();
        $progress = $totalPosts > 0 ? round(($viewedPosts / $totalPosts) * 100, 1) : 0;

        return view('courses.show', compact('course', 'progress'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        if (!Auth::user()->canManageCourse($course)) {
            return redirect()->route('courses.show', $course)
                ->with('error', 'You do not have permission to edit this course.');
        }
        
        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        if (!Auth::user()->canManageCourse($course)) {
            return redirect()->route('courses.show', $course)
                ->with('error', 'You do not have permission to edit this course.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $course->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->route('courses.show', $course)->with('success', 'Course updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        if (!Auth::user()->canManageCourse($course)) {
            return redirect()->route('courses.show', $course)
                ->with('error', 'You do not have permission to delete this course.');
        }
        
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully!');
    }

    /**
     * Display all available courses (public list).
     */
    public function allCourses()
    {
        // Ambil semua courses dengan pagination
        $courses = Course::with('user') // include pembuat course
            ->withCount('enrollments') // hitung jumlah siswa enrolled
            ->paginate(12);

        return view('courses.all', compact('courses'));
    }

}
