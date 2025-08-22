@extends('layouts.app')

@section('title', $user->name . ' - User Details')

@section('content')
<div class="m-3 sm:m-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb bg-light p-2 rounded shadow-sm">
            <li class="breadcrumb-item">
                <a href="{{ route('users.index') }}" class="text-decoration-none">
                    <i class="fas fa-users me-1"></i> Users
                </a>
            </li>
            <li class="breadcrumb-item active">{{ $user->name }}</li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">
            <i class="fas fa-user-circle text-primary me-2"></i> {{ $user->name }}
        </h3>
        @if($user->id !== Auth::id())
            <div class="btn-group">
                <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
                <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger"
                        onclick="return confirm('Delete {{ $user->name }} permanently?')">
                        <i class="fas fa-trash me-1"></i> Delete
                    </button>
                </form>
            </div>
        @endif
    </div>

    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-8 mb-4">
            <!-- User Info Card -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white fw-bold">
                    <i class="fas fa-id-card me-2"></i> User Information
                </div>
                <div class="card-body">
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Role:</strong>
                        <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : ($user->role === 'teacher' ? 'warning text-dark' : 'info') }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </p>
                    <p><strong>Joined:</strong> {{ $user->created_at->format('M d, Y') }}</p>
                </div>
            </div>

            <!-- Courses Created -->
            @if($user->courses->count() > 0)
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white fw-bold">
                    <i class="fas fa-book me-2"></i> Courses Created
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($user->courses as $course)
                        <div class="col-md-6 mb-3">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <h6 class="fw-bold">
                                        <i class="fas fa-graduation-cap text-primary me-1"></i> {{ $course->name }}
                                    </h6>
                                    <p class="text-muted small">{{ Str::limit($course->description, 80) }}</p>
                                    <span class="badge bg-success">{{ $course->enrollments->count() }} students</span>
                                    <a href="{{ route('courses.show', $course) }}" class="btn btn-sm btn-outline-primary mt-2">View</a>
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
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white fw-bold">
                    <i class="fas fa-chalkboard-teacher me-2"></i> Enrolled Courses
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($user->enrolledCourses as $course)
                        <div class="col-md-6 mb-3">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <h6 class="fw-bold">
                                        <i class="fas fa-graduation-cap text-primary me-1"></i> {{ $course->name }}
                                    </h6>
                                    <p class="text-muted small">{{ Str::limit($course->description, 80) }}</p>
                                    <span class="badge bg-secondary">By {{ $course->user->name }}</span>
                                    <a href="{{ route('courses.show', $course) }}" class="btn btn-sm btn-outline-primary mt-2">View</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Right Column -->
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width:80px;height:80px;font-size:2rem;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <h5>{{ $user->name }}</h5>
                    <p class="text-muted">{{ $user->email }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
