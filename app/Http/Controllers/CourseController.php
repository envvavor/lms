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
            // Admin can see all courses
            $courses = Course::with('posts')->paginate(12);
        } elseif ($user->isTeacher()) {
            // Teachers can see their own courses and courses they're enrolled in
            $courses = Course::where('user_id', $user->id)
                ->orWhereHas('enrollments', function($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->with('posts')
                ->paginate(10);
        } else {
            // Regular users can only see courses they're enrolled in
            $courses = $user->enrolledCourses()->with('posts')->paginate(12);
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
        ]);

        Course::create([
            'name' => $request->name,
            'description' => $request->description,
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
        
        // Check if user can access this course
        if (!$user->isAdmin() && !$user->canManageCourse($course)) {
            // Check if user is enrolled
            $isEnrolled = $course->enrollments()->where('user_id', $user->id)->exists();
            if (!$isEnrolled) {
                return redirect()->route('courses.index')
                    ->with('error', 'You do not have access to this course.');
            }
        }
        
        $course->load('posts.user');
        return view('courses.show', compact('course'));
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
        ]);

        $course->update([
            'name' => $request->name,
            'description' => $request->description,
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
}
