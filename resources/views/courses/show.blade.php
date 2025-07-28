@extends('layouts.app')

@section('title', $course->name . ' - LMS Pro')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col-lg-8 col-md-12">
            <h1 class="page-title">
                <i class="fas fa-graduation-cap me-2"></i>
                {{ $course->name }}
            </h1>
            <p class="page-subtitle">
                {{ $course->description ?: 'No description available' }}
            </p>
            <div class="d-flex flex-wrap align-items-center gap-2 gap-md-3">
                <span class="badge bg-primary">
                    <i class="fas fa-user me-1"></i>
                    {{ $course->user->name }}
                </span>
                <span class="badge bg-info">
                    <i class="fas fa-users me-1"></i>
                    {{ $course->enrollments->count() }} students
                </span>
                <span class="badge bg-success">
                    <i class="fas fa-file-alt me-1"></i>
                    {{ $course->posts->count() }} posts
                </span>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 text-lg-end text-md-start mt-3 mt-lg-0">
            @auth
                @if(Auth::user()->canManageCourse($course))
                    <div class="btn-group" role="group">
                        <a href="{{ route('posts.create', $course) }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>
                            Add Post
                        </a>
                        <a href="{{ route('courses.edit', $course) }}" class="btn btn-outline-primary">
                            <i class="fas fa-edit me-2"></i>
                            Edit Course
                        </a>
                        <a href="{{ route('courses.enrollments', $course) }}" class="btn btn-outline-info">
                            <i class="fas fa-users me-2"></i>
                            Manage Enrollments
                        </a>
                    </div>
                @elseif(Auth::user()->isUser())
                    @if(Auth::user()->enrolledCourses()->where('course_id', $course->id)->exists())
                        <form action="{{ route('enrollments.unenroll', $course) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="fas fa-user-times me-2"></i>
                                Unenroll
                            </button>
                        </form>
                    @else
                        <form action="{{ route('enrollments.enroll', $course) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-user-plus me-2"></i>
                                Enroll
                            </button>
                        </form>
                    @endif
                @endif
            @endauth
        </div>
    </div>
</div>

<!-- Course Content -->
<div class="row">
    <div class="col-lg-8 col-md-12">
        <!-- Posts Section -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-file-alt me-2"></i>
                    Course Posts
                </h5>
            </div>
            <div class="card-body">
                @if($course->posts->count() > 0)
                    @foreach($course->posts as $post)
                        <div class="post-item">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="mb-1">
                                        <i class="fas fa-{{ $post->type === 'text' ? 'file-text' : ($post->type === 'image' ? 'image' : ($post->type === 'video' ? 'video' : 'file')) }} me-2 text-primary"></i>
                                        {{ $post->title }}
                                    </h5>
                                    <div class="post-meta">
                                        <i class="fas fa-user me-1"></i>
                                        {{ $post->user->name }} • 
                                        <i class="fas fa-calendar me-1"></i>
                                        {{ $post->created_at->format('M d, Y H:i') }} • 
                                        <span class="badge bg-{{ $post->type === 'text' ? 'primary' : ($post->type === 'image' ? 'success' : ($post->type === 'video' ? 'warning' : 'info')) }}">
                                            {{ ucfirst($post->type) }}
                                        </span>
                                    </div>
                                </div>
                                @auth
                                    @if(Auth::user()->canManageCourse($course))
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('posts.show', $post) }}">
                                                        <i class="fas fa-eye me-2"></i>
                                                        View Post
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('posts.edit', $post) }}">
                                                        <i class="fas fa-edit me-2"></i>
                                                        Edit Post
                                                    </a>
                                                </li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger" 
                                                                onclick="return confirm('Are you sure you want to delete this post?')">
                                                            <i class="fas fa-trash me-2"></i>
                                                            Delete Post
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                            
                            @if($post->content)
                                <div class="mb-3">
                                    <p class="mb-0">{{ Str::limit($post->content, 200) }}</p>
                                </div>
                            @endif
                            
                            @if($post->file_path)
                                <div class="file-preview">
                                    @if($post->type === 'image')
                                        <img src="{{ Storage::url($post->file_path) }}" alt="{{ $post->title }}" 
                                             class="img-fluid rounded" style="max-height: 200px;">
                                    @elseif($post->type === 'video')
                                        <video controls class="w-100 rounded" style="max-height: 200px;">
                                            <source src="{{ Storage::url($post->file_path) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    @else
                                        <div class="d-flex align-items-center">
                                            <div class="file-icon me-3">
                                                <i class="fas fa-file-pdf"></i>
                                            </div>
                                            <div>
                                                <strong>{{ basename($post->file_path) }}</strong>
                                                <br>
                                                <small class="text-muted">File attachment</small>
                                            </div>
                                            <a href="{{ Storage::url($post->file_path) }}" 
                                               class="btn btn-sm btn-outline-primary ms-auto" 
                                               target="_blank">
                                                <i class="fas fa-download me-1"></i>
                                                Download
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endif
                            
                            <div class="mt-3">
                                <a href="{{ route('posts.show', $post) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye me-1"></i>
                                    View Full Post
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <i class="fas fa-file-alt"></i>
                        <h4>No Posts Yet</h4>
                        <p class="text-muted">This course doesn't have any posts yet.</p>
                        @auth
                            @if(Auth::user()->canManageCourse($course))
                                <a href="{{ route('posts.create', $course) }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>
                                    Create First Post
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-12 mt-4 mt-lg-0">
        <!-- Course Info Sidebar -->
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    Course Information
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Created by:</strong><br>
                    <span class="text-muted">{{ $course->user->name }}</span>
                </div>
                <div class="mb-3">
                    <strong>Created on:</strong><br>
                    <span class="text-muted">{{ $course->created_at->format('M d, Y') }}</span>
                </div>
                <div class="mb-3">
                    <strong>Last updated:</strong><br>
                    <span class="text-muted">{{ $course->updated_at->format('M d, Y') }}</span>
                </div>
                <div class="mb-3">
                    <strong>Total posts:</strong><br>
                    <span class="text-muted">{{ $course->posts->count() }}</span>
                </div>
                <div class="mb-3">
                    <strong>Enrolled students:</strong><br>
                    <span class="text-muted">{{ $course->enrollments->count() }}</span>
                </div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        @auth
            @if(Auth::user()->canManageCourse($course))
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-tools me-2"></i>
                            Quick Actions
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('posts.create', $course) }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>
                                Add New Post
                            </a>
                            <a href="{{ route('courses.enrollments', $course) }}" class="btn btn-outline-primary">
                                <i class="fas fa-users me-2"></i>
                                Manage Students
                            </a>
                            <a href="{{ route('courses.edit', $course) }}" class="btn btn-outline-secondary">
                                <i class="fas fa-edit me-2"></i>
                                Edit Course
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        @endauth
    </div>
</div>
@endsection 