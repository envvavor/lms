@extends('layouts.app')

@section('title', 'User Management - LMS Pro')

@section('content')
<div class="m-3 sm:m-5">
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Page Header -->
    <div class="bg-[#2b2738] text-white rounded-2xl shadow-lg p-6 mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold flex items-center gap-2">
                    <i class="fas fa-users"></i>
                    User Management
                </h1>
                <p class="text-gray-300 mt-1 text-sm sm:text-base">Manage all users in the system</p>

                <!-- Badges -->
                <div class="flex flex-wrap gap-2 mt-4 text-xs sm:text-sm">
                    <span class="px-3 py-1 rounded-full bg-indigo-500">
                        <i class="fas fa-users mr-1"></i>
                        {{ $users->total() }} total users
                    </span>
                    <span class="px-3 py-1 rounded-full bg-green-500">
                        <i class="fas fa-user-check mr-1"></i>
                        {{ $users->where('role', 'user')->count() }} students
                    </span>
                    <span class="px-3 py-1 rounded-full bg-yellow-500 text-white">
                        <i class="fas fa-chalkboard-teacher mr-1"></i>
                        {{ $users->where('role', 'teacher')->count() }} teachers
                    </span>
                    <span class="px-3 py-1 rounded-full bg-red-500">
                        <i class="fas fa-user-shield mr-1"></i>
                        {{ $users->where('role', 'admin')->count() }} admins
                    </span>
                </div>
            </div>
            <div>
                <a href="{{ route('users.create') }}" 
                   class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-xl text-white font-medium shadow-md transition text-sm sm:text-base">
                    <i class="fas fa-plus"></i>
                    Add New User
                </a>
            </div>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="bg-white p-4 rounded-2xl shadow mb-6">
        <form method="GET" action="{{ route('users.index') }}" class="flex flex-col md:flex-row gap-3 items-center justify-between">
            <div class="flex items-center gap-2 w-full md:w-1/2">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Search by name or email..."
                       class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none text-sm">
            </div>
            <div class="flex items-center gap-2">
                <select name="role" class="px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 text-sm">
                    <option value="">All Roles</option>
                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>Students</option>
                    <option value="teacher" {{ request('role') == 'teacher' ? 'selected' : '' }}>Teachers</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admins</option>
                </select>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm">
                    <i class="fas fa-search"></i>
                </button>
                @if(request('search') || request('role'))
                    <a href="{{ route('users.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Users Table -->
    @if($users->count() > 0)
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
            <div class="px-4 sm:px-6 py-4 border-b border-gray-200 flex items-center gap-2">
                <i class="fas fa-list text-indigo-600"></i>
                <h5 class="font-semibold text-sm sm:text-base">All Users</h5>
            </div>

            <!-- Responsive Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm sm:text-base">
                    <thead class="bg-[#2b2738] text-white">
                        <tr>
                            <th class="px-4 sm:px-6 py-3">User</th>
                            <th class="px-4 sm:px-6 py-3">Email</th>
                            <th class="px-4 sm:px-6 py-3">Role</th>
                            <th class="px-4 sm:px-6 py-3 md:table-cell">Courses Created</th>
                            <th class="px-4 sm:px-6 py-3 md:table-cell">Enrollments</th>
                            <th class="px-4 sm:px-6 py-3">Joined</th>
                            <th class="px-4 sm:px-6 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($users as $user)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 sm:px-6 py-4 flex items-center gap-3">
                                    @php
                                        $avatarColors = ['bg-indigo-500','bg-green-500','bg-red-500','bg-yellow-500','bg-pink-500','bg-purple-500'];
                                        $colorIndex = $user->id % count($avatarColors);
                                        $avatarBg = $avatarColors[$colorIndex];
                                    @endphp
                                    <div class="w-10 h-10 sm:w-12 sm:h-12 flex-shrink-0 flex items-center justify-center rounded-full text-white font-bold {{ $avatarBg }}">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <span class="font-semibold text-gray-800 text-sm sm:text-base">{{ $user->name }}</span>
                                        @if($user->id === Auth::id())
                                            <span class="ml-2 text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full">You</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 sm:px-6 py-4 text-gray-500 truncate max-w-[120px] sm:max-w-[200px]">{{ $user->email }}</td>
                                <td class="px-4 sm:px-6 py-4">
                                    <span class="px-2 py-1 sm:px-3 sm:py-1 rounded-full text-xs sm:text-sm font-medium
                                        {{ $user->role === 'admin' ? ' text-red-600' : ($user->role === 'teacher' ? ' text-yellow-700' : ' text-blue-600') }}">
                                        <i class="fas fa-{{ $user->role === 'admin' ? 'user-shield' : ($user->role === 'teacher' ? 'chalkboard-teacher' : 'user-graduate') }}"></i>
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="px-4 sm:px-6 py-4 md:table-cell text-center">
                                    <span class="px-2 py-1 text-s bg-indigo-100 text-indigo-600 rounded-full">
                                        {{ $user->courses->count() }}
                                    </span>
                                </td>
                                <td class="px-4 sm:px-6 py-4 md:table-cell text-center">
                                    <span class="px-2 py-1 text-s bg-green-100 text-green-600 rounded-full">
                                        {{ $user->enrollments->count() }}
                                    </span>
                                </td>
                                <td class="px-4 sm:px-6 py-4 text-gray-500 text-xs sm:text-sm">
                                    {{ $user->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-4 sm:px-6 py-4 text-center space-x-1 sm:space-x-2">
                                    <a href="{{ route('users.show', $user) }}" 
                                       class="inline-flex items-center px-2 sm:px-3 py-1 text-xs rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('users.edit', $user) }}" 
                                       class="inline-flex items-center px-2 sm:px-3 py-1 text-xs rounded-lg bg-yellow-100 text-yellow-700 hover:bg-yellow-200">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if($user->id !== Auth::id())
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block delete-user-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" 
                                                class="inline-flex items-center px-2 sm:px-3 py-1 text-xs rounded-lg bg-red-100 text-red-600 hover:bg-red-200 delete-user-btn"
                                                data-user-name="{{ $user->name }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if(method_exists($users, 'hasPages') && $users->hasPages())
                <div class="px-4 sm:px-6 py-4 border-t border-gray-200 flex justify-center">
                    {{ $users->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    @else
        <div class="bg-white shadow-md rounded-2xl p-8 text-center">
            <i class="fas fa-users text-4xl text-gray-400 mb-4"></i>
            <h4 class="text-lg font-semibold">No Users Found</h4>
            <p class="text-gray-500 mb-4">There are no users in the system yet.</p>
            <!-- <a href="{{ route('users.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-xl text-white font-medium shadow-md transition">
                <i class="fas fa-plus"></i> Add First User
            </a> -->
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-user-btn');
        
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const userName = this.dataset.userName;
                const form = this.closest('form');
                
                Swal.fire({
                    title: 'Delete User?',
                    html: `Are you sure you want to delete <strong>${userName}</strong>?<br>This action cannot be undone.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#EF4444',
                    cancelButtonColor: '#6B7280',
                    confirmButtonText: 'Yes, delete',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection
