@extends('layouts.app')

@section('title', 'Manage Enrollments - ' . $course->name)

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col-lg-8 col-md-12">
            <h1 class="page-title">
                <i class="fas fa-users me-2"></i>
                Manage Enrollments
            </h1>
            <p class="page-subtitle">
                Course: {{ $course->name }}
            </p>
            <div class="d-flex flex-wrap align-items-center gap-2 gap-md-3">
                <span class="badge bg-primary">
                    <i class="fas fa-users me-1"></i>
                    {{ $enrollments->count() }} enrolled students
                </span>
                <span class="badge bg-info">
                    <i class="fas fa-user-plus me-1"></i>
                    {{ $availableUsers->count() }} available users
                </span>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 text-lg-end text-md-start mt-3 mt-lg-0">
            <a href="{{ route('courses.show', $course) }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i>
                Back to Course
            </a>
        </div>
    </div>
</div>

<!-- Add User to Course -->
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fas fa-user-plus me-2"></i>
            Add User to Course
        </h5>
    </div>
    <div class="card-body">
        @if($availableUsers->count() > 0)
            <form action="{{ route('enrollments.add', $course) }}" method="POST">
                @csrf
                <div class="row align-items-end">
                    <div class="col-lg-8 col-md-12 mb-3 mb-lg-0">
                        <label for="user_id" class="form-label">
                            <i class="fas fa-user me-1"></i>
                            Select User
                        </label>
                        <select name="user_id" id="user_id" class="form-select" required>
                            <option value="">Choose a user to enroll...</option>
                            @foreach($availableUsers as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }} ({{ $user->email }}) - 
                                    <span class="badge bg-{{ $user->role === 'teacher' ? 'warning' : ($user->role === 'admin' ? 'danger' : 'info') }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-plus me-2"></i>
                            Add to Course
                        </button>
                    </div>
                </div>
            </form>
        @else
            <div class="text-center py-4">
                <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                <h5 class="text-success">All Users Enrolled</h5>
                <p class="text-muted mb-0">All available users are already enrolled in this course.</p>
            </div>
        @endif
    </div>
</div>

<!-- Enrolled Students -->
@if($enrollments->count() > 0)
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fas fa-user-graduate me-2"></i>
                Enrolled Students ({{ $enrollments->count() }})
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>
                                <i class="fas fa-user me-1"></i>
                                Student
                            </th>
                            <th>
                                <i class="fas fa-envelope me-1"></i>
                                Email
                            </th>
                            <th>
                                <i class="fas fa-user-tag me-1"></i>
                                Role
                            </th>
                            <th>
                                <i class="fas fa-calendar me-1"></i>
                                Enrolled Date
                            </th>
                            <th class="text-center">
                                <i class="fas fa-tools me-1"></i>
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($enrollments as $enrollment)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-3" style="width: 40px; height: 40px; background: var(--primary-color);">
                                            {{ strtoupper(substr($enrollment->user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <strong>{{ $enrollment->user->name }}</strong>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $enrollment->user->email }}</td>
                                <td>
                                    <span class="badge bg-{{ $enrollment->user->role === 'teacher' ? 'warning' : ($enrollment->user->role === 'admin' ? 'danger' : 'info') }}">
                                        <i class="fas fa-{{ $enrollment->user->role === 'teacher' ? 'chalkboard-teacher' : ($enrollment->user->role === 'admin' ? 'crown' : 'user-graduate') }} me-1"></i>
                                        {{ ucfirst($enrollment->user->role) }}
                                    </span>
                                </td>
                                <td>
                                    <i class="fas fa-calendar-alt me-1 text-muted"></i>
                                    {{ $enrollment->created_at->format('M d, Y') }}
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('enrollments.remove', ['course' => $course, 'enrollmentId' => $enrollment->id]) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                onclick="return confirm('Are you sure you want to remove {{ $enrollment->user->name }} from this course?')">
                                            <i class="fas fa-user-times me-1"></i>
                                            Remove
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@else
    <div class="empty-state">
        <i class="fas fa-users"></i>
        <h3>No Enrollments Yet</h3>
        <p class="text-muted">No students have enrolled in this course yet.</p>
        @if($availableUsers->count() > 0)
            <p class="text-muted">Use the form above to add students to this course.</p>
        @endif
    </div>
@endif
@endsection 