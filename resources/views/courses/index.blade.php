@extends('layouts.app')

@section('title', 'Courses - LMS Pro')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h1 class="page-title">
                <i class="fas fa-book-open me-2"></i>
                Courses
            </h1>
            <p class="page-subtitle">
                Explore and manage your learning journey
            </p>
        </div>
        <div class="col-md-4 text-md-end">
            @auth
                @if(Auth::user()->canCreateCourses())
                    <a href="{{ route('courses.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>
                        Create New Course
                    </a>
                @endif
            @endauth
        </div>
    </div>
</div>

<!-- Statistics Cards -->
@auth
<div class="row mb-4">
    <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
        <div class="stats-card">
            <div class="stats-number">{{ method_exists($courses, 'total') ? $courses->total() : $courses->count() }}</div>
            <div class="stats-label">Total Courses</div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
        <div class="stats-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
            <div class="stats-number">{{ Auth::user()->enrolledCourses()->count() }}</div>
            <div class="stats-label">Enrolled Courses</div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
        <div class="stats-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
            <div class="stats-number">{{ Auth::user()->courses()->count() }}</div>
            <div class="stats-label">My Courses</div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
        <div class="stats-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
            <div class="stats-number">{{ App\Models\Post::count() }}</div>
            <div class="stats-label">Total Posts</div>
        </div>
    </div>
</div>
@endauth

<!-- Courses Grid -->
@if($courses->count() > 0)
    <div class="row">
        @foreach($courses as $course)
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="card course-card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title mb-0">
                                <i class="fas fa-graduation-cap me-2 text-primary"></i>
                                {{ $course->name }}
                            </h5>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('courses.show', $course) }}">
                                        <i class="fas fa-eye me-2"></i>
                                        View Course
                                    </a>
                                </li>
                                @auth
                                    @if(Auth::user()->canManageCourse($course))
                                        <li>
                                            <a class="dropdown-item" href="{{ route('courses.edit', $course) }}">
                                                <i class="fas fa-edit me-2"></i>
                                                Edit Course
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('courses.enrollments', $course) }}">
                                                <i class="fas fa-users me-2"></i>
                                                Manage Enrollments
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form action="{{ route('courses.destroy', $course) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger" 
                                                        onclick="return confirm('Are you sure you want to delete this course?')">
                                                    <i class="fas fa-trash me-2"></i>
                                                    Delete Course
                                                </button>
                                            </form>
                                        </li>
                                    @endif
                                @endauth
                            </ul>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <p class="card-text text-muted mb-3">
                            {{ Str::limit($course->description, 120) }}
                        </p>
                        
                        <div class="row mb-3">
                            <div class="col-6">
                                <small class="text-muted">
                                    <i class="fas fa-user me-1"></i>
                                    {{ $course->user->name }}
                                </small>
                            </div>
                            <div class="col-6 text-end">
                                <small class="text-muted">
                                    <i class="fas fa-file-alt me-1"></i>
                                    {{ $course->posts->count() }} posts
                                </small>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-6">
                                <small class="text-muted">
                                    <i class="fas fa-users me-1"></i>
                                    {{ $course->enrollments->count() }} students
                                </small>
                            </div>
                            <div class="col-6 text-end">
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ $course->created_at->format('M d, Y') }}
                                </small>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('courses.show', $course) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye me-1"></i>
                                View Course
                            </a>
                            
                            @auth
                                @if(Auth::user()->isUser())
                                    @if(Auth::user()->enrolledCourses()->where('course_id', $course->id)->exists())
                                        <form action="{{ route('enrollments.unenroll', $course) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="fas fa-user-times me-1"></i>
                                                Unenroll
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('enrollments.enroll', $course) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fas fa-user-plus me-1"></i>
                                                Enroll
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="empty-state">
        <i class="fas fa-book-open"></i>
        <h3>No Courses Available</h3>
        <p class="text-muted">There are no courses available at the moment.</p>
        @auth
            @if(Auth::user()->canCreateCourses())
                <a href="{{ route('courses.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>
                    Create Your First Course
                </a>
            @endif
        @endauth
    </div>
@endif

<!-- Pagination -->
@if(method_exists($courses, 'hasPages') && $courses->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $courses->links() }}
    </div>
@endif
@endsection 