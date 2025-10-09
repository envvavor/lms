@extends('layouts.app')

@section('title', 'Manage Enrollments - ' . $course->name)

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="m-3 sm:m-5">
    <!-- Page Header -->
    <div class="bg-[#2b2738] text-white rounded-2xl shadow-lg p-6 mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold flex items-center gap-2">
                    <i class="fas fa-users"></i>
                    Manage Enrollments
                </h1>
                <p class="text-sm opacity-80">Course: {{ $course->name }}</p>
                <div class="flex flex-wrap gap-2 mt-3">
                    <span class="bg-primary/80 text-white px-3 py-1 rounded-full text-sm flex items-center gap-1">
                        <i class="fas fa-users"></i> {{ $enrollments->count() }} enrolled
                    </span>
                    <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm flex items-center gap-1">
                        <i class="fas fa-user-plus"></i> {{ $availableUsers->count() }} available
                    </span>
                </div>
            </div>
            <a href="{{ route('courses.show', $course) }}" 
               class="bg-transparent border border-white/30 text-white px-4 py-2 rounded-xl hover:bg-white hover:text-[#2b2738] transition">
                <i class="fas fa-arrow-left"></i> Back to Course
            </a>
        </div>
    </div>

    <!-- Add User to Course -->
    <div class="bg-white rounded-2xl shadow p-6 mb-6">
        <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
            <i class="fas fa-user-plus text-primary"></i> Add User to Course
        </h2>
        @if($availableUsers->count() > 0)
            <form action="{{ route('enrollments.add', $course) }}" method="POST" class="grid md:grid-cols-3 gap-4">
                @csrf
                <div class="md:col-span-2">
                    <label for="user_id" class="text-sm font-medium">Select User</label>
                    <select name="user_id" id="user_id" required 
                        class="w-full mt-1 rounded-xl border-gray-300 shadow-sm focus:ring-2 focus:ring-primary p-2">
                        <option value="">Choose a user to enroll...</option>
                        @foreach($availableUsers as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->name }} ({{ $user->email }}) - {{ ucfirst($user->role) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-primary text-white px-4 py-2 rounded-xl shadow hover:bg-primary/90 transition">
                        <i class="fas fa-plus"></i> Add to Course
                    </button>
                </div>
            </form>
        @else
            <div class="text-center py-6">
                <i class="fas fa-check-circle text-green-500 text-4xl mb-2"></i>
                <h5 class="text-green-600 font-semibold">All Users Enrolled</h5>
                <p class="text-gray-500">All available users are already enrolled in this course.</p>
            </div>
        @endif
    </div>

    <!-- Enrolled Students -->
    @if($enrollments->count() > 0)
        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
                <i class="fas fa-user-graduate text-primary"></i> Enrolled Students ({{ $enrollments->count() }})
            </h2>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100 text-gray-600">
                        <tr>
                            <th class="px-4 py-2 text-left">Student</th>
                            <th class="px-4 py-2 text-left">Email</th>
                            <th class="px-4 py-2 text-left">Role</th>
                            <th class="px-4 py-2 text-left">Enrolled Date</th>
                            <th class="px-4 py-2 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach($enrollments as $enrollment)
                            <tr>
                                <td class="px-4 py-3 flex items-center gap-3">
                                    <div class="w-10 h-10 flex items-center justify-center rounded-full bg-primary text-white font-bold">
                                        {{ strtoupper(substr($enrollment->user->name, 0, 1)) }}
                                    </div>
                                    <span class="font-medium">{{ $enrollment->user->name }}</span>
                                </td>
                                <td class="px-4 py-3">{{ $enrollment->user->email }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold 
                                        {{ $enrollment->user->role === 'teacher' ? 'bg-yellow-200 text-yellow-800' : ($enrollment->user->role === 'admin' ? 'bg-red-200 text-red-800' : 'bg-blue-200 text-blue-800') }}">
                                        <i class="fas fa-{{ $enrollment->user->role === 'teacher' ? 'chalkboard-teacher' : ($enrollment->user->role === 'admin' ? 'crown' : 'user-graduate') }}"></i>
                                        {{ ucfirst($enrollment->user->role) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-gray-600">
                                    <i class="fas fa-calendar-alt mr-1"></i>
                                    {{ $enrollment->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <form action="{{ route('enrollments.remove', ['course' => $course, 'enrollmentId' => $enrollment->id]) }}" 
                                          method="POST" class="inline remove-enrollment-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition text-xs btn-remove-enrollment"
                                            data-user-name="{{ $enrollment->user->name }}">
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
    @else
        <div class="bg-gray-50 text-center rounded-2xl py-10">
            <i class="fas fa-users text-4xl text-gray-400 mb-3"></i>
            <h3 class="text-lg font-semibold">No Enrollments Yet</h3>
            <p class="text-gray-500">No students have enrolled in this course yet.</p>
            @if($availableUsers->count() > 0)
                <p class="text-gray-500">Use the form above to add students.</p>
            @endif
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-remove-enrollment').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const form = btn.closest('form');
            const userName = btn.getAttribute('data-user-name') || 'this user';
            Swal.fire({
                title: 'Remove Enrollment?',
                html: `Are you sure you want to remove <b>${userName}</b> from this course?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, remove',
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
