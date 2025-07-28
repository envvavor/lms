<?php

namespace App\Console\Commands;

use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\User;
use Illuminate\Console\Command;

class AddUserToCourse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'course:enroll {user_email} {course_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a user to a course enrollment';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userEmail = $this->argument('user_email');
        $courseId = $this->argument('course_id');

        // Find user
        $user = User::where('email', $userEmail)->first();
        if (!$user) {
            $this->error("User with email '{$userEmail}' not found.");
            return 1;
        }

        // Find course
        $course = Course::find($courseId);
        if (!$course) {
            $this->error("Course with ID '{$courseId}' not found.");
            return 1;
        }

        // Check if already enrolled
        $existingEnrollment = CourseEnrollment::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->first();

        if ($existingEnrollment) {
            $this->warn("User '{$user->name}' is already enrolled in course '{$course->name}'.");
            return 0;
        }

        // Create enrollment
        CourseEnrollment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
        ]);

        $this->info("Successfully enrolled user '{$user->name}' in course '{$course->name}'.");
        return 0;
    }
}
