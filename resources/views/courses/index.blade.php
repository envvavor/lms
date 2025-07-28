@extends('layouts.app')

@section('title', 'My Courses')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="fas fa-book"></i> My Courses</h1>
            @if(Auth::user()->canCreateCourses())
                <a href="{{ route('courses.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Create New Course
                </a>
            @endif
        </div>

        @if($courses->count() > 0)
            <div class="row">
                @foreach($courses as $course)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">{{ $course->name }}</h5>
                                <p class="card-text text-muted">
                                    {{ Str::limit($course->description, 100) ?: 'No description available' }}
                                </p>
                                <p class="card-text">
                                    <small class="text-muted">
                                        <i class="fas fa-file-alt"></i> {{ $course->posts->count() }} posts
                                    </small>
                                </p>
                                <p class="card-text">
                                    <small class="text-muted">
                                        <i class="fas fa-user"></i> {{ $course->user->name }}
                                        @if($course->user_id === Auth::id())
                                            <span class="badge bg-primary">Owner</span>
                                        @endif
                                    </small>
                                </p>
                            </div>
                            <div class="card-footer">
                                <div class="btn-group w-100" role="group">
                                    <a href="{{ route('courses.show', $course) }}" class="btn btn-outline-primary">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    
                                    @if(Auth::user()->canManageCourse($course))
                                        <a href="{{ route('courses.edit', $course) }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('courses.destroy', $course) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this course?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    @endif
                                    
                                    @if(Auth::user()->isUser() && $course->user_id !== Auth::id())
                                        @php
                                            $isEnrolled = $course->enrollments()->where('user_id', Auth::id())->exists();
                                        @endphp
                                        @if($isEnrolled)
                                            <form action="{{ route('enrollments.unenroll', $course) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-warning">
                                                    <i class="fas fa-sign-out-alt"></i> Unenroll
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('enrollments.enroll', $course) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-success">
                                                    <i class="fas fa-sign-in-alt"></i> Enroll
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-book fa-3x text-muted mb-3"></i>
                <h3 class="text-muted">No courses yet</h3>
                @if(Auth::user()->canCreateCourses())
                    <p class="text-muted">Create your first course to get started!</p>
                    <a href="{{ route('courses.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Create Your First Course
                    </a>
                @else
                    <p class="text-muted">You are not enrolled in any courses yet.</p>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection 