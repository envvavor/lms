<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\GoogleController;
use App\Models\Course;

// Route::get('/', function () {
//     return redirect()->route('courses.index');
// });

Route::view('/welcome', 'welcome')->name('welcome');


Route::get('/kelas', function () {
    $courses = Course::with('user')->latest()->take(6)->get(); 
    return view('kelas', compact('courses'));
})->name('kelas');

Route::get('/tentang', function () {
    return view('tentang');
});

Route::get('/', function () {
    return view('home');
});

Route::get('/lokasi', function () {
    return view('lokasi');
});

Route::get('/galeri_kami', function () {
    return view('galeri_kami');
});

Route::view('/privacy-policy', 'privacy-policy')->name('privacy.policy');

// Authentication routes with guest middleware
Route::middleware(['guest'])->group(function () {
    Auth::routes(['verify' => false, 'logout' => false]);
});

// Logout routes (accessible to authenticated users)
Route::match(['GET', 'POST'], '/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    
    return redirect()->route('login')->with('success', 'You have been successfully logged out.');
})->name('logout');

// Protected routes that require authentication
Route::middleware(['auth'])->group(function () {

    // all courses
    Route::get('/courses/all', [CourseController::class, 'allCourses'])
    ->name('courses.all');

    Route::get('/users/profile', [UserController::class, 'profile'])->name('profile.show');

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

    
Route::get('auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'callback']);

