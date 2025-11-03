@extends('layouts.app')

@section('title', $user->name . ' - User Details')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
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
                    <div class="flex flex-col items-center justify-center">
                        <h5 class="fw-bold">{{ $user->name }}</h5>
                        <p class="text-muted">{{ $user->email }}</p>
                        <span class="badge text-white px-3 py-2" style="background:#2b2738;">
                            {{ ucfirst($user->role) }}
                        </span>
                        <a href="javascript:void(0)" onclick="editProfile()"  class="badge px-3 py-2 mt-2 text-white bg-orange-600" style="text-decoration:none; margin-left:10px;">
                            <i class="fas fa-pen me-1"></i> Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<script>
function editProfile() {
    // Hitung lebar layar agar popup responsif
    let width = '400px';
    if (window.innerWidth < 640) { // HP
        width = '90%';
    } else if (window.innerWidth < 1024) { // Tablet
        width = '70%';
    } else { // Desktop besar
        width = '400px';
    }

    Swal.fire({
        title: 'Edit Your Profile',
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        },
        html: `
            <form id="editProfileForm" method="POST" action="{{ route('profile.update') }}" class="px-2">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <input type="text" name="name" value="{{ $user->name }}" 
                           placeholder="Name" class="swal2-input w-full" required>
                </div>
                <div class="mb-3">
                    <input type="email" name="email" value="{{ $user->email }}" 
                           placeholder="Email" class="swal2-input w-full" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" placeholder="New Password (optional)" 
                           class="swal2-input w-full">
                </div>
                <div class="mb-3">
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" 
                           class="swal2-input w-full">
                </div>
            </form>
        `,
        width: width,
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: 'Save',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#4f46e5', // ungu
        cancelButtonColor: '#9ca3af',
        backdrop: `
            rgba(0,0,0,0.4)
        `,
        preConfirm: () => {
            document.getElementById('editProfileForm').submit();
        }
    });
}
</script>

<style>
.swal2-popup {
    font-size: 0.9rem !important;
    border-radius: 14px !important;
    padding: 1.5rem !important;
}
.swal2-input {
    margin: 0 !important;
    width: 100% !important;
    font-size: 0.9rem !important;
}
.swal2-actions {
    gap: 10px !important;
}
</style>

@endsection
