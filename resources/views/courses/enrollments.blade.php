@extends('layouts.app')

@section('title', 'Manage Enrollments - ' . $course->name)

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1><i class="fas fa-users"></i> Manage Enrollments</h1>
                <p class="text-muted mb-0">Course: {{ $course->name }}</p>
            </div>
            <a href="{{ route('courses.show', $course) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Course
            </a>
        </div>

        <!-- Add User to Course -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-user-plus"></i> Add User to Course</h5>
            </div>
            <div class="card-body">
                @if($availableUsers->count() > 0)
                    <form action="{{ route('enrollments.add', $course) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <select name="user_id" class="form-select" required>
                                    <option value="">Select a user to enroll</option>
                                    @foreach($availableUsers as $user)
                                        <option value="{{ $user->id }}">
                                            {{ $user->name }} ({{ $user->email }}) - {{ ucfirst($user->role) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Add to Course
                                </button>
                            </div>
                        </div>
                    </form>
                @else
                    <p class="text-muted mb-0">All users are already enrolled in this course.</p>
                @endif
            </div>
        </div>

        <!-- Enrolled Students -->
        @if($enrollments->count() > 0)
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Enrolled Students ({{ $enrollments->count() }})</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Enrolled Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($enrollments as $enrollment)
                                    <tr>
                                        <td>{{ $enrollment->user->name }}</td>
                                        <td>{{ $enrollment->user->email }}</td>
                                        <td>
                                            <span class="badge bg-{{ $enrollment->user->role === 'teacher' ? 'warning' : ($enrollment->user->role === 'admin' ? 'danger' : 'info') }}">
                                                {{ ucfirst($enrollment->user->role) }}
                                            </span>
                                        </td>
                                        <td>{{ $enrollment->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <form action="{{ route('enrollments.remove', ['course' => $course, 'enrollmentId' => $enrollment->id]) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                        onclick="return confirm('Are you sure you want to remove this student from the course?')">
                                                    <i class="fas fa-user-times"></i> Remove
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
            <div class="text-center py-5">
                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                <h3 class="text-muted">No enrollments yet</h3>
                <p class="text-muted">No students have enrolled in this course yet.</p>
            </div>
        @endif
    </div>
</div>
@endsection 