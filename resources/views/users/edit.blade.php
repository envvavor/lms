@extends('layouts.app')

@section('title', 'Edit User - ' . $user->name)

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
                    <li class="breadcrumb-item">
                        <a href="{{ route('users.show', $user) }}" class="text-decoration-none">
                            {{ $user->name }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Edit User
                    </li>
                </ol>
            </nav>
            
            <h1 class="page-title">
                <i class="fas fa-edit me-2"></i>
                Edit User: {{ $user->name }}
            </h1>
            <p class="page-subtitle">
                Update user information and role
            </p>
        </div>
        <div class="col-lg-4 col-md-12 text-lg-end text-md-start mt-3 mt-lg-0">
            <a href="{{ route('users.show', $user) }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>
                Back to User
            </a>
        </div>
    </div>
</div>

<!-- Edit Form -->
<div class="row">
    <div class="col-lg-8 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-edit me-2"></i>
                    User Information
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">
                                    <i class="fas fa-user me-1"></i>
                                    Full Name
                                </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name', $user->name) }}" required 
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
                                       id="email" name="email" value="{{ old('email', $user->email) }}" required 
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
                                    New Password
                                    <small class="text-muted">(leave blank to keep current)</small>
                                </label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       id="password" name="password" 
                                       placeholder="Enter new password...">
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
                                    Confirm New Password
                                </label>
                                <input type="password" class="form-control" 
                                       id="password_confirmation" name="password_confirmation" 
                                       placeholder="Confirm new password...">
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
                            <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>
                                <i class="fas fa-user-graduate me-1"></i>
                                Student (User)
                            </option>
                            <option value="teacher" {{ old('role', $user->role) == 'teacher' ? 'selected' : '' }}>
                                <i class="fas fa-chalkboard-teacher me-1"></i>
                                Teacher
                            </option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
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
                        <a href="{{ route('users.show', $user) }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-2"></i>
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>
                            Update User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-12 mt-4 mt-lg-0">
        <!-- Current User Info -->
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    Current User Info
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
                    <strong>Current Role:</strong><br>
                    <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : ($user->role === 'teacher' ? 'warning' : 'info') }}">
                        <i class="fas fa-{{ $user->role === 'admin' ? 'user-shield' : ($user->role === 'teacher' ? 'chalkboard-teacher' : 'user-graduate') }} me-1"></i>
                        {{ ucfirst($user->role) }}
                    </span>
                </div>
                
                <div class="mb-3">
                    <strong>Joined:</strong><br>
                    <span class="text-muted">{{ $user->created_at->format('F d, Y') }}</span>
                </div>
                
                <div class="mb-3">
                    <strong>Last Updated:</strong><br>
                    <span class="text-muted">{{ $user->updated_at->format('F d, Y') }}</span>
                </div>
                
                <div class="mb-0">
                    <strong>User ID:</strong><br>
                    <span class="text-muted">#{{ $user->id }}</span>
                </div>
            </div>
        </div>

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

        <!-- Password Guidelines -->
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-shield-alt me-2"></i>
                    Password Guidelines
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
                        <i class="fas fa-info text-info me-2"></i>
                        Leave blank to keep current
                    </li>
                </ul>
            </div>
        </div>
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