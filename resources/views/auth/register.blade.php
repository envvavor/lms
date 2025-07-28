@extends('layouts.app')

@section('title', 'Register - LMS Pro')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-lg">
            <div class="card-header text-center bg-primary text-white">
                <h4 class="mb-0">
                    <i class="fas fa-user-plus me-2"></i>
                    Create Account
                </h4>
                <p class="mb-0 opacity-75">Join LMS Pro today</p>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">
                            <i class="fas fa-user me-1"></i>
                            Full Name
                        </label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                               name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope me-1"></i>
                            Email Address
                        </label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">
                            <i class="fas fa-user-tag me-1"></i>
                            Role
                        </label>
                        <select id="role" class="form-select @error('role') is-invalid @enderror" name="role" required>
                            <option value="">Select your role</option>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Student</option>
                            <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Teacher</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock me-1"></i>
                            Password
                        </label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                               name="password" required autocomplete="new-password">
                        @error('password')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">
                            <i class="fas fa-lock me-1"></i>
                            Confirm Password
                        </label>
                        <input id="password_confirmation" type="password" class="form-control" 
                               name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-user-plus me-2"></i>
                            Create Account
                        </button>
                    </div>

                    <div class="text-center mt-3">
                        <p class="text-muted mb-0">
                            Already have an account? 
                            <a href="{{ route('login') }}" class="text-decoration-none">
                                <strong>Sign in here</strong>
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>

        <!-- Role Information -->
        <div class="card mt-4">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    Role Information
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="text-center mb-3">
                            <div class="badge bg-info mb-2">Student</div>
                            <p class="small text-muted mb-0">
                                Enroll in courses and view posts
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-center mb-3">
                            <div class="badge bg-warning mb-2">Teacher</div>
                            <p class="small text-muted mb-0">
                                Create courses and manage content
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
