<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect()->route('courses.index');
});



// Authentication routes with guest middleware
Route::middleware(['guest'])->group(function () {
    Auth::routes(['verify' => false, 'logout' => false]);
});

// Logout routes (accessible to authenticated users)
Route::match(['GET', 'POST'], '/logout', function () {
    \Log::info('Logout attempt from IP: ' . request()->ip());
    
    if (Auth::check()) {
        \Log::info('User logged out: ' . Auth::user()->email);
    }
    
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    
    \Log::info('Logout completed, redirecting to login');
    
    return redirect()->route('login')->with('success', 'You have been successfully logged out.');
})->name('logout');

// Protected routes that require authentication
Route::middleware(['auth'])->group(function () {
    // Course routes
    Route::resource('courses', CourseController::class);
    Route::get('/courses/{course}/enrollments', [EnrollmentController::class, 'manageEnrollments'])->name('courses.enrollments');

    // Post routes
    Route::resource('posts', PostController::class)->except(['create', 'store']);
    Route::get('/courses/{course}/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/courses/{course}/posts', [PostController::class, 'store'])->name('posts.store');

    // Enrollment routes
    Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'enroll'])->name('enrollments.enroll');
    Route::post('/courses/{course}/unenroll', [EnrollmentController::class, 'unenroll'])->name('enrollments.unenroll');
    Route::post('/courses/{course}/enrollments/add', [EnrollmentController::class, 'addEnrollment'])->name('enrollments.add');
    Route::delete('/courses/{course}/enrollments/{enrollmentId}', [EnrollmentController::class, 'removeEnrollment'])->name('enrollments.remove');

    // User management routes (admin only)
    Route::resource('users', UserController::class);
});
