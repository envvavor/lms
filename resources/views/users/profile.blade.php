@extends('layouts.app')

@section('title', $user->name . ' - User Details')

@section('content')
<div class="m-3 sm:m-5">
    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-8 mb-4">
            <!-- User Info Card -->
            <div class="card border-0 shadow-lg mb-4">
                <div class="card-header text-white fw-bold" style="background:#2b2738;">
                    <i class="fas fa-id-card me-2"></i> User Information
                </div>
                <div class="card-body">
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Role:</strong>
                        <span class="badge px-3 py-2 rounded-pill text-white" style="background:
                            {{ $user->role === 'admin' ? '#e63946' : ($user->role === 'teacher' ? '#ffb703' : '#219ebc') }};
                        ">
                            {{ ucfirst($user->role) }}
                        </span>
                    </p>
                    <p><strong>Joined:</strong> {{ $user->created_at->format('M d, Y') }}</p>
                </div>
            </div>

            <!-- Courses Created -->
            @if($user->courses->count() > 0)
            <div class="card border-0 shadow-lg mb-4">
                <div class="card-header text-white fw-bold" style="background:#2b2738;">
                    <i class="fas fa-book me-2"></i> Courses Created
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($user->courses as $course)
                        <div class="col-md-6 mb-3">
                            <div class="card h-100 border-0 shadow-sm hover-shadow">
                                <div class="card-body">
                                    <h6 class="fw-bold text-dark">
                                        <i class="fas fa-graduation-cap text-primary me-1"></i> {{ $course->name }}
                                    </h6>
                                    <p class="text-muted small">{{ Str::limit($course->description, 80) }}</p>
                                    <span class="badge bg-success mb-2">{{ $course->enrollments->count() }} students</span>
                                    <br>
                                    <a href="{{ route('courses.show', $course) }}" class="btn btn-sm text-white" style="background:#2b2738;">
                                        <i class="fas fa-eye me-1"></i> View
                                    </a>
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
            <div class="card border-0 shadow-lg mb-4">
                <div class="card-header text-white fw-bold" style="background:#2b2738;">
                    <i class="fas fa-chalkboard-teacher me-2"></i> Enrolled Courses
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($user->enrolledCourses as $course)
                        <div class="col-md-6 mb-3">
                            <div class="card h-100 border-0 shadow-sm hover-shadow">
                                <div class="card-body">
                                    <h6 class="fw-bold text-dark">
                                        <i class="fas fa-graduation-cap text-primary me-1"></i> {{ $course->name }}
                                    </h6>
                                    <p class="text-muted small">{{ Str::limit($course->description, 80) }}</p>
                                    <span class="badge bg-secondary mb-2">By {{ $course->user->name }}</span>
                                    <br>
                                    <a href="{{ route('courses.show', $course) }}" class="btn btn-sm text-white" style="background:#2b2738;">
                                        <i class="fas fa-eye me-1"></i> View
                                    </a>
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
            <div class="card border-0 shadow-lg">
                <div class="card-body text-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 shadow"
                        style="width:90px;height:90px;font-size:2rem;background:#2b2738;color:#fff;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <h5 class="fw-bold">{{ $user->name }}</h5>
                    <p class="text-muted">{{ $user->email }}</p>
                    <span class="badge text-white px-3 py-2" style="background:#2b2738;">
                        {{ ucfirst($user->role) }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
