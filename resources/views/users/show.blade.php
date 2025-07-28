@extends('layouts.app')

@section('title', $user->name . ' - User Details')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col-lg-8 col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('users.index') }}" class="text-decoration-none">
                            <i class="fas fa-users me-1"></i>
                            Users
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $user->name }}
                    </li>
                </ol>
            </nav>
            
            <h1 class="page-title">
                <i class="fas fa-user me-2"></i>
                {{ $user->name }}
            </h1>
            
            <div class="d-flex flex-wrap align-items-center gap-2 gap-md-3">
                <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : ($user->role === 'teacher' ? 'warning' : 'info') }}">
                    <i class="fas fa-{{ $user->role === 'admin' ? 'user-shield' : ($user->role === 'teacher' ? 'chalkboard-teacher' : 'user-graduate') }} me-1"></i>
                    {{ ucfirst($user->role) }}
                </span>
                <span class="badge bg-secondary">
                    <i class="fas fa-envelope me-1"></i>
                    {{ $user->email }}
                </span>
                <span class="badge bg-info">
                    <i class="fas fa-calendar me-1"></i>
                    Joined {{ $user->created_at->format('M d, Y') }}
                </span>
                @if($user->id === Auth::id())
                    <span class="badge bg-primary">
                        <i class="fas fa-user-check me-1"></i>
                        Current User
                    </span>
                @endif
            </div>
        </div>
        <div class="col-lg-4 col-md-12 text-lg-end text-md-start mt-3 mt-lg-0">
            @if($user->id !== Auth::id())
                <div class="btn-group" role="group">
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-primary">
                        <i class="fas fa-edit me-2"></i>
                        Edit User
                    </a>
                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger" 
                                onclick="return confirm('Are you sure you want to delete {{ $user->name }}? This action cannot be undone.')">
                            <i class="fas fa-trash me-2"></i>
                            Delete
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- User Content -->
<div class="row">
    <div class="col-lg-8 col-md-12">
        <!-- User Statistics -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="stats-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="stats-number">{{ $user->courses->count() }}</div>
                    <div class="stats-label">Courses Created</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                    <div class="stats-number">{{ $user->enrollments->count() }}</div>
                    <div class="stats-label">Enrolled Courses</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                    <div class="stats-number">{{ $user->posts->count() }}</div>
                    <div class="stats-label">Posts Created</div>
                </div>
            </div>
        </div>

        <!-- Created Courses -->
        @if($user->courses->count() > 0)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-book me-2"></i>
                        Courses Created ({{ $user->courses->count() }})
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($user->courses as $course)
                            <div class="col-lg-6 col-md-12 mb-3">
                                <div class="card course-card h-100">
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            <i class="fas fa-graduation-cap me-2 text-primary"></i>
                                            {{ $course->name }}
                                        </h6>
                                        <p class="card-text text-muted small">
                                            {{ Str::limit($course->description, 100) }}
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="badge bg-success">
                                                <i class="fas fa-users me-1"></i>
                                                {{ $course->enrollments->count() }} students
                                            </span>
                                            <span class="badge bg-info">
                                                <i class="fas fa-file-alt me-1"></i>
                                                {{ $course->posts->count() }} posts
                                            </span>
                                        </div>
                                        <div class="mt-3">
                                            <a href="{{ route('courses.show', $course) }}" class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-eye me-1"></i>
                                                View Course
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <!-- Enrolled Courses -->
        @if($user->enrolledCourses->count() > 0)
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-graduation-cap me-2"></i>
                        Enrolled Courses ({{ $user->enrolledCourses->count() }})
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($user->enrolledCourses as $course)
                            <div class="col-lg-6 col-md-12 mb-3">
                                <div class="card course-card h-100">
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            <i class="fas fa-graduation-cap me-2 text-primary"></i>
                                            {{ $course->name }}
                                        </h6>
                                        <p class="card-text text-muted small">
                                            {{ Str::limit($course->description, 100) }}
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="badge bg-secondary">
                                                <i class="fas fa-user me-1"></i>
                                                {{ $course->user->name }}
                                            </span>
                                            <span class="badge bg-info">
                                                <i class="fas fa-file-alt me-1"></i>
                                                {{ $course->posts->count() }} posts
                                            </span>
                                        </div>
                                        <div class="mt-3">
                                            <a href="{{ route('courses.show', $course) }}" class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-eye me-1"></i>
                                                View Course
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
    
    <div class="col-lg-4 col-md-12 mt-4 mt-lg-0">
        <!-- User Information -->
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    User Information
                </h6>
            </div>
            <div class="card-body">
                <div class="text-center mb-4">
                    <div class="user-avatar-large mx-auto mb-3">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <h5 class="mb-1">{{ $user->name }}</h5>
                    <p class="text-muted mb-0">{{ $user->email }}</p>
                </div>
                
                <div class="mb-3">
                    <strong>Role:</strong><br>
                    <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : ($user->role === 'teacher' ? 'warning' : 'info') }}">
                        <i class="fas fa-{{ $user->role === 'admin' ? 'user-shield' : ($user->role === 'teacher' ? 'chalkboard-teacher' : 'user-graduate') }} me-1"></i>
                        {{ ucfirst($user->role) }}
                    </span>
                </div>
                
                <div class="mb-3">
                    <strong>Joined:</strong><br>
                    <span class="text-muted">{{ $user->created_at->format('F d, Y \a\t H:i') }}</span>
                </div>
                
                <div class="mb-3">
                    <strong>Last Updated:</strong><br>
                    <span class="text-muted">{{ $user->updated_at->format('F d, Y \a\t H:i') }}</span>
                </div>
                
                <div class="mb-0">
                    <strong>User ID:</strong><br>
                    <span class="text-muted">#{{ $user->id }}</span>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        @if($user->id !== Auth::id())
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-tools me-2"></i>
                        Quick Actions
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-primary">
                            <i class="fas fa-edit me-2"></i>
                            Edit User
                        </a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger w-100" 
                                    onclick="return confirm('Are you sure you want to delete {{ $user->name }}? This action cannot be undone.')">
                                <i class="fas fa-trash me-2"></i>
                                Delete User
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

<style>
    .user-avatar-large {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 2rem;
    }
</style> 