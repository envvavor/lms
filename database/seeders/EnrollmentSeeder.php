<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get users
        $admin = User::where('email', 'admin@lms.com')->first();
        $teacher = User::where('email', 'teacher@lms.com')->first();
        $student = User::where('email', 'student@lms.com')->first();

        // Get or create a course
        $course = Course::first();
        
        if (!$course) {
            // Create a sample course if none exists
            $course = Course::create([
                'name' => 'Sample Course',
                'description' => 'This is a sample course for testing enrollments.',
                'user_id' => $teacher->id,
            ]);
        }

        // Enroll student in the course
        if ($student && $course) {
            CourseEnrollment::firstOrCreate([
                'user_id' => $student->id,
                'course_id' => $course->id,
            ]);
        }

        // Enroll admin in the course (for testing)
        if ($admin && $course) {
            CourseEnrollment::firstOrCreate([
                'user_id' => $admin->id,
                'course_id' => $course->id,
            ]);
        }

        // Create additional test courses
        $course2 = Course::firstOrCreate([
            'name' => 'Advanced Course',
            'description' => 'Advanced level course for experienced students.',
            'user_id' => $teacher->id,
        ]);

        $course3 = Course::firstOrCreate([
            'name' => 'Beginner Course',
            'description' => 'Basic course for beginners.',
            'user_id' => $admin->id,
        ]);

        // Enroll student in additional courses
        if ($student) {
            CourseEnrollment::firstOrCreate([
                'user_id' => $student->id,
                'course_id' => $course2->id,
            ]);
        }
    }
}
