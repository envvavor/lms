@extends('layouts.app')

@section('title', 'Create User - LMS Pro')

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
                        Create User
                    </li>
                </ol>
            </nav>
            
            <h1 class="page-title">
                <i class="fas fa-user-plus me-2"></i>
                Create New User
            </h1>
            <p class="page-subtitle">
                Add a new user to the system
            </p>
        </div>
        <div class="col-lg-4 col-md-12 text-lg-end text-md-start mt-3 mt-lg-0">
            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>
                Back to Users
            </a>
        </div>
    </div>
</div>

<!-- Create Form -->
<div class="row">
    <div class="col-lg-8 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-user-plus me-2"></i>
                    User Information
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">
                                    <i class="fas fa-user me-1"></i>
                                    Full Name
                                </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}" required 
                                       placeholder="Enter full name...">
                                @error('name')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope me-1"></i>
                                    Email Address
                                </label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" required 
                                       placeholder="Enter email address...">
                                @error('email')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock me-1"></i>
                                    Password
                                </label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       id="password" name="password" required 
                                       placeholder="Enter password...">
                                @error('password')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">
                                    <i class="fas fa-lock me-1"></i>
                                    Confirm Password
                                </label>
                                <input type="password" class="form-control" 
                                       id="password_confirmation" name="password_confirmation" required 
                                       placeholder="Confirm password...">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">
                            <i class="fas fa-tag me-1"></i>
                            User Role
                        </label>
                        <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                            <option value="">Select user role</option>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>
                                <i class="fas fa-user-graduate me-1"></i>
                                Student (User)
                            </option>
                            <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>
                                <i class="fas fa-chalkboard-teacher me-1"></i>
                                Teacher
                            </option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                                <i class="fas fa-user-shield me-1"></i>
                                Administrator
                            </option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-2"></i>
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>
                            Create User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-12 mt-4 mt-lg-0">
        <!-- Role Information -->
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    Role Information
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <h6 class="text-primary">
                        <i class="fas fa-user-graduate me-1"></i>
                        Student (User)
                    </h6>
                    <p class="text-muted small mb-0">
                        Can view courses they are enrolled in and access course posts.
                    </p>
                </div>
                <div class="mb-3">
                    <h6 class="text-warning">
                        <i class="fas fa-chalkboard-teacher me-1"></i>
                        Teacher
                    </h6>
                    <p class="text-muted small mb-0">
                        Can create courses, manage posts, and handle enrollments for their courses.
                    </p>
                </div>
                <div class="mb-0">
                    <h6 class="text-danger">
                        <i class="fas fa-user-shield me-1"></i>
                        Administrator
                    </h6>
                    <p class="text-muted small mb-0">
                        Full system access including user management and all courses.
                    </p>
                </div>
            </div>
        </div>

        <!-- Password Requirements -->
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-shield-alt me-2"></i>
                    Password Requirements
                </h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <i class="fas fa-check text-success me-2"></i>
                        Minimum 8 characters
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check text-success me-2"></i>
                        Must be confirmed
                    </li>
                    <li class="mb-0">
                        <i class="fas fa-check text-success me-2"></i>
                        Secure and unique
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection 