<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    public function enroll(Course $course)
    {
        // Check if user is already enrolled
        $existingEnrollment = CourseEnrollment::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->first();

        if ($existingEnrollment) {
            return redirect()->route('courses.show', $course)
                ->with('error', 'You are already enrolled in this course.');
        }

        // Create enrollment
        CourseEnrollment::create([
            'user_id' => Auth::id(),
            'course_id' => $course->id,
        ]);

        return redirect()->route('courses.show', $course)
            ->with('success', 'Successfully enrolled in the course!');
    }

    public function unenroll(Course $course)
    {
        $enrollment = CourseEnrollment::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->first();

        if (!$enrollment) {
            return redirect()->route('courses.show', $course)
                ->with('error', 'You are not enrolled in this course.');
        }

        $enrollment->delete();

        return redirect()->route('courses.index')
            ->with('success', 'Successfully unenrolled from the course.');
    }

    public function manageEnrollments(Course $course)
    {
        // Only course owner or admin can manage enrollments
        if (!Auth::user()->canManageCourse($course)) {
            return redirect()->route('courses.show', $course)
                ->with('error', 'You do not have permission to manage enrollments for this course.');
        }

        $enrollments = $course->enrollments()->with('user')->get();
        $availableUsers = User::whereDoesntHave('enrollments', function($query) use ($course) {
            $query->where('course_id', $course->id);
        })->get();
        
        return view('courses.enrollments', compact('course', 'enrollments', 'availableUsers'));
    }

    public function addEnrollment(Request $request, Course $course)
    {
        // Only course owner or admin can add enrollments
        if (!Auth::user()->canManageCourse($course)) {
            return redirect()->route('courses.show', $course)
                ->with('error', 'You do not have permission to manage enrollments for this course.');
        }

        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        // Check if user is already enrolled
        $existingEnrollment = CourseEnrollment::where('user_id', $request->user_id)
            ->where('course_id', $course->id)
            ->first();

        if ($existingEnrollment) {
            return redirect()->route('courses.enrollments', $course)
                ->with('error', 'User is already enrolled in this course.');
        }

        // Create enrollment
        CourseEnrollment::create([
            'user_id' => $request->user_id,
            'course_id' => $course->id,
        ]);

        return redirect()->route('courses.enrollments', $course)
            ->with('success', 'User successfully enrolled in the course.');
    }

    public function removeEnrollment(Course $course, $enrollmentId)
    {
        // Only course owner or admin can remove enrollments
        if (!Auth::user()->canManageCourse($course)) {
            return redirect()->route('courses.show', $course)
                ->with('error', 'You do not have permission to manage enrollments for this course.');
        }

        $enrollment = CourseEnrollment::findOrFail($enrollmentId);

        // Ensure the enrollment belongs to this course
        if ($enrollment->course_id !== $course->id) {
            return redirect()->route('courses.enrollments', $course)
                ->with('error', 'Invalid enrollment for this course.');
        }

        $enrollment->delete();

        return redirect()->route('courses.enrollments', $course)
            ->with('success', 'Student removed from the course.');
    }
}
