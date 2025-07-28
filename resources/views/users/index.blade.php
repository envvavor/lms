@extends('layouts.app')

@section('title', 'User Management - LMS Pro')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col-lg-8 col-md-12">
            <h1 class="page-title">
                <i class="fas fa-users me-2"></i>
                User Management
            </h1>
            <p class="page-subtitle">
                Manage all users in the system
            </p>
            <div class="d-flex flex-wrap align-items-center gap-2 gap-md-3">
                <span class="badge bg-primary">
                    <i class="fas fa-users me-1"></i>
                    {{ $users->total() }} total users
                </span>
                <span class="badge bg-success">
                    <i class="fas fa-user-check me-1"></i>
                    {{ $users->where('role', 'user')->count() }} students
                </span>
                <span class="badge bg-warning">
                    <i class="fas fa-chalkboard-teacher me-1"></i>
                    {{ $users->where('role', 'teacher')->count() }} teachers
                </span>
                <span class="badge bg-danger">
                    <i class="fas fa-user-shield me-1"></i>
                    {{ $users->where('role', 'admin')->count() }} admins
                </span>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 text-lg-end text-md-start mt-3 mt-lg-0">
            <a href="{{ route('users.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>
                Add New User
            </a>
        </div>
    </div>
</div>

<!-- Users List -->
@if($users->count() > 0)
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fas fa-list me-2"></i>
                All Users
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>
                                <i class="fas fa-user me-1"></i>
                                User
                            </th>
                            <th>
                                <i class="fas fa-envelope me-1"></i>
                                Email
                            </th>
                            <th>
                                <i class="fas fa-tag me-1"></i>
                                Role
                            </th>
                            <th>
                                <i class="fas fa-book me-1"></i>
                                Courses Created
                            </th>
                            <th>
                                <i class="fas fa-graduation-cap me-1"></i>
                                Enrolled Courses
                            </th>
                            <th>
                                <i class="fas fa-calendar me-1"></i>
                                Joined
                            </th>
                            <th>
                                <i class="fas fa-cogs me-1"></i>
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-3">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <strong>{{ $user->name }}</strong>
                                            @if($user->id === Auth::id())
                                                <span class="badge bg-info ms-2">You</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted">{{ $user->email }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : ($user->role === 'teacher' ? 'warning' : 'info') }}">
                                        <i class="fas fa-{{ $user->role === 'admin' ? 'user-shield' : ($user->role === 'teacher' ? 'chalkboard-teacher' : 'user-graduate') }} me-1"></i>
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-primary">
                                        {{ $user->courses->count() }} courses
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-success">
                                        {{ $user->enrollments->count() }} enrollments
                                    </span>
                                </td>
                                <td>
                                    <span class="text-muted">
                                        {{ $user->created_at->format('M d, Y') }}
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('users.show', $user) }}">
                                                    <i class="fas fa-eye me-2"></i>
                                                    View Details
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('users.edit', $user) }}">
                                                    <i class="fas fa-edit me-2"></i>
                                                    Edit User
                                                </a>
                                            </li>
                                            @if($user->id !== Auth::id())
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger" 
                                                                onclick="return confirm('Are you sure you want to delete {{ $user->name }}? This action cannot be undone.')">
                                                            <i class="fas fa-trash me-2"></i>
                                                            Delete User
                                                        </button>
                                                    </form>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if(method_exists($users, 'hasPages') && $users->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
@else
    <div class="card">
        <div class="card-body">
            <div class="empty-state">
                <i class="fas fa-users"></i>
                <h4>No Users Found</h4>
                <p class="text-muted">There are no users in the system yet.</p>
                <a href="{{ route('users.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>
                    Add First User
                </a>
            </div>
        </div>
    </div>
@endif
@endsection

<style>
    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 1.1rem;
    }
</style> 