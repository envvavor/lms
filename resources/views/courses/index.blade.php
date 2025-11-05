@extends('layouts.app')

@section('title', 'Courses - LMS Creativy')

@section('content')

<style>
@keyframes slideUp {
  from {
    transform: translateY(50px);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}
.animate-slideUp {
  animation: slideUp 0.6s ease-out forwards;
}

/* Accordion-style dropdown, integrated into card */
.course-card .dropdown-menu {
    position: static;
    width: 100%;
    overflow: hidden;
    max-height: 0;
    opacity: 0;
    padding: 0;
    transition: all 0.3s ease;
    background: transparent; /* match card */
    border: none;
    box-shadow: none;
}

.course-card .dropdown-menu.show {
    padding: 0.5rem 0;
    max-height: 600px; /* enough to expand */
    opacity: 1;
}

/* Course card specific dropdown styles */
.course-dropdown-toggle {
    cursor: pointer;
}

.course-dropdown-menu {
    position: absolute;
    top: 100%;
    right: 0;
    min-width: 200px;
    background: white;
    border-radius: 0.5rem;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    border: 1px solid #e2e8f0;
    padding: 0.5rem 0;
    margin-top: 0.5rem;
    display: none;
    z-index: 99999;
}

.course-dropdown-menu.show {
    display: block;
}

/* Ensure proper positioning and visibility */
.course-dropdown-menu {
    position: absolute !important;
    top: calc(100% + 0.5rem) !important;
    right: 0 !important;
    z-index: 99999 !important;
    background: white !important;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2) !important;
    border: 1px solid #e2e8f0 !important;
}

/* Ensure dropdown is not clipped by parent containers */
.course-dropdown-menu {
    overflow: visible !important;
    clip: auto !important;
    clip-path: none !important;
}

/* Force visibility and prevent clipping */
.course-dropdown-menu.show {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
    z-index: 99999 !important;
    pointer-events: auto !important;
}

/* Ensure parent containers don't clip the dropdown */
.relative {
    overflow: visible !important;
}

.group {
    overflow: visible !important;
}

/* Ensure course card doesn't clip dropdown */
.group.bg-gradient-to-br {
    overflow: visible !important;
}

/* Force dropdown to break out of any clipping containers */
.course-dropdown-menu {
    position: absolute !important;
    z-index: 99999 !important;
    overflow: visible !important;
    clip: auto !important;
    clip-path: none !important;
    transform: translate3d(0, 0, 0) !important;
    will-change: transform !important;
}

/* Mobile responsive adjustments */
@media (max-width: 768px) {
    .course-dropdown-menu {
        right: auto;
        left: 0;
        min-width: 180px;
    }
}

.course-dropdown-item {
    display: block;
    padding: 0.75rem 1rem;
    color: #374151;
    text-decoration: none;
    transition: all 0.2s ease;
    border-radius: 0.25rem;
    margin: 0 0.5rem;
}

.course-dropdown-item:hover {
    background-color: #f3f4f6;
    color: #111827;
}

.course-dropdown-item i {
    width: 16px;
    margin-right: 0.75rem;
    text-align: center;
}
</style>

<div class="m-3 sm:m-5 animate-slideUp"> 
<script src="https://cdn.tailwindcss.com"></script>
<!-- Page Header -->
<div class="bg-white shadow-sm border-b border-gray-200 px-6 py-6 rounded-lg mb-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-book-open text-gray-800"></i>
                Courses
            </h1>
            <p class="text-gray-500 mt-1">Explore and manage your learning journey</p>
        </div>
        <div class="mt-4 md:mt-0">
            @auth
                @if(Auth::user()->canCreateCourses())
                    <a href="{{ route('courses.create') }}" 
                       class="inline-flex items-center px-4 py-2 bg-[#2b2738] hover:bg-[#474354] text-white font-medium rounded-lg shadow-sm transition">
                        <i class="fas fa-plus mr-2"></i> Create New Course
                    </a>
                @endif
            @endauth
        </div>
    </div>
</div>


<!-- Statistics Cards -->
<!-- i make it only admin or teacher can see it -->
@auth
    @if (Auth::user()->canCreateCourses())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6 over">
            <div class="bg-[#2b2738] rounded-xl shadow p-6 text-center" style="border-left: 6px solid #ffa800;">
                <div class="text-3xl font-bold text-white">
                    {{ method_exists($courses, 'total') ? $courses->total() : $courses->count() }}
                </div>
                <p class="text-white text-sm">Total Courses</p>
            </div>

            <div class="bg-[#2b2738] rounded-xl shadow p-6 text-center text-white" style="border-left: 6px solid #ffa800;">
                <div class="text-3xl font-bold">{{ Auth::user()->enrolledCourses()->count() }}</div>
                <p class="text-sm">Enrolled Courses</p>
            </div>

            <div class="bg-[#2b2738] rounded-xl shadow p-6 text-center text-white" style="border-left: 6px solid #ffa800;">
                <div class="text-3xl font-bold">{{ Auth::user()->courses()->count() }}</div>
                <p class="text-sm">My Courses</p>
            </div>

            <div class="bg-[#2b2738] rounded-xl shadow p-6 text-center text-white" style="border-left: 6px solid #ffa800;">
                <!-- type shit -->
                @if (Auth::user()->isTeacher())
                    <div class="text-3xl font-bold">{{ Auth::user()->posts()->count() }}</div>
                @elseif (Auth::user()->isAdmin())
                    <div class="text-3xl font-bold">{{ \App\Models\Post::count() }}</div>
                @endif
                <!-- type shit -->
                @if (Auth::user()->isTeacher())
                    <p class="text-sm">My Posts</p>
                @elseif (Auth::user()->isAdmin())
                    <p class="text-sm">Total Posts</p>
                @endif
            </div>
        </div>
    @endif
@endauth

<!-- Courses Grid -->
@if($courses->count() > 0)
    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($courses as $course)
            <div class="group bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 flex flex-col border border-gray-100">
                <!-- Card Header with Gradient Background -->
                <div class="relative bg-gradient-to-br from-[#2b2738] to-[#2f2c3b] px-6 py-4 overflow-hidden rounded-2xl">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <h5 class="text-xl font-bold text-white mb-1 flex items-center gap-3">
                                <div class="p-2 bg-white/20 rounded-lg backdrop-blur-sm">
                                    <i class="fas fa-graduation-cap text-white"></i>
                                </div>
                                {{ $course->name }}
                            </h5>
                            <div class="text-indigo-100 text-sm font-medium">
                                <i class="fas fa-user mr-1"></i> {{ $course->user->name }}
                            </div>
                        </div>
                        <div class="relative">
                            <button class="text-white/80 hover:text-white p-3 rounded-full hover:bg-white/20 transition-colors duration-200 course-dropdown-toggle" type="button">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>

                            <!-- Course dropdown menu -->
                            <ul class="course-dropdown-menu">
                                <li>
                                    <a class="course-dropdown-item" 
                                    href="{{ route('courses.show', $course) }}">
                                        <i class="fas fa-eye text-indigo-600"></i> View Course
                                    </a>
                                </li>
                                @auth
                                    @if(Auth::user()->canManageCourse($course))
                                        <li>
                                            <a class="course-dropdown-item" 
                                            href="{{ route('courses.edit', $course) }}">
                                                <i class="fas fa-edit text-yellow-500"></i> Edit Course
                                            </a>
                                        </li>
                                        <li>
                                            <a class="course-dropdown-item" 
                                            href="{{ route('courses.enrollments', $course) }}">
                                                <i class="fas fa-users text-green-500"></i> Enrollments
                                            </a>
                                        </li>
                                        <li class="border-t border-gray-100 my-1"></li>
                                        <li>
                                            <form action="{{ route('courses.destroy', $course) }}" method="POST" class="delete-course-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="w-full text-left course-dropdown-item text-red-600 hover:bg-red-50 course-delete-btn"
                                                        data-course-name="{{ $course->name }}">
                                                    <i class="fas fa-trash text-red-600"></i> Delete Course
                                                </button>
                                            </form>
                                        </li>
                                    @elseif(Auth::user()->isUser())
                                        @if(Auth::user()->enrolledCourses()->where('course_id', $course->id)->exists())
                                                <form action="{{ route('enrollments.unenroll', $course) }}" method="POST" class="flex-1 unenroll-form">
                                                @csrf
                                                <button type="button"
                                                        class="w-full text-left course-dropdown-item text-red-600 hover:bg-red-50 unenroll-btn"
                                                        data-course-name="{{ $course->name }}">
                                                    <i class="fas fa-user-times text-red-600"></i> Unenroll
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('enrollments.enroll', $course) }}" method="POST" class="flex-1 enroll-form">
                                                @csrf
                                                <button type="button"
                                                        class="w-full px-4 py-2.5 text-sm bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white rounded-xl font-medium transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl enroll-btn"
                                                        data-course-name="{{ $course->name }}">
                                                    <i class="fas fa-user-plus mr-2"></i> Enroll Now
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                @endauth
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-6 flex-1 flex flex-col">
                    <p class="text-gray-600 mb-6 leading-relaxed line-clamp-3">{{ Str::limit($course->description, 120) }}</p>

                    <!-- Stats Grid -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-gray-50 rounded-lg p-3 text-center border border-gray-100">
                            <div class="text-2xl font-bold text-indigo-600">{{ $course->posts->count() }}</div>
                            <div class="text-xs text-gray-500 font-medium">
                                <i class="fas fa-file-alt mr-1"></i> Posts
                            </div>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-3 text-center border border-gray-100">
                            <div class="text-2xl font-bold text-green-600">{{ $course->enrollments->count() }}</div>
                            <div class="text-xs text-gray-500 font-medium">
                                <i class="fas fa-users mr-1"></i> Students
                            </div>
                        </div>
                    </div>

                    <!-- Course Info
                    <div class="mt-auto">
                        <div class="flex items-center justify-between text-sm text-gray-500 bg-gray-50 rounded-lg px-3 py-2 border border-gray-100">
                            <span class="flex items-center">
                                <i class="fas fa-calendar mr-2 text-indigo-500"></i> 
                                {{ $course->created_at->format('M d, Y') }}
                            </span>
                            <div class="w-2 h-2 bg-indigo-300 rounded-full"></div>
                        </div>
                    </div> -->
                    @if (Auth::user()->isUser())
                        <div class="">
                            <h5 class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                                <!-- <i class="fas fa-chart-line text-black"></i> Course Progress -->
                                course progress
                            </h5>
                            <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden mt-1">
                                <div class="bg-gradient-to-r from-orange-500 to-orange-600 h-3 rounded-full transition-all duration-500"
                                    style="width: {{ $course->progress ?? 0 }}%"></div>
                            </div>
                            <p class="text-xs text-gray-600 mt-1">
                                You’ve viewed {{ $course->progress ?? 0 }}% of the course content.
                            </p>
                        </div>
                    @endif
                </div>

                <!-- Card Footer -->
                <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-100">
                    <div class="flex justify-between items-center gap-3">
                        <a href="{{ route('courses.show', $course) }}" 
                           class="flex-1 text-center px-4 py-2.5 text-sm bg-[#2b2738] hover:bg-[#33303d] text-white rounded-xl font-medium transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <i class="fas fa-eye mr-2"></i> View Course
                        </a>
                        @auth
                            @if(Auth::user()->isUser())
                                @if(Auth::user()->enrolledCourses()->where('course_id', $course->id)->exists())
                                    <!-- <form action="{{ route('enrollments.unenroll', $course) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit" 
                                                class="w-full px-4 py-2.5 text-sm border-2 border-red-200 text-red-600 rounded-xl hover:bg-red-50 hover:border-red-300 font-medium transition-all duration-200 transform hover:scale-105">
                                            <i class="fas fa-user-times mr-2"></i> Unenroll
                                        </button>
                                    </form> -->
                                @else
                                    <form action="{{ route('enrollments.enroll', $course) }}" method="POST" class="flex-1 enroll-form">
                                        @csrf
                                        <button type="button"
                                                class="w-full px-4 py-2.5 text-sm bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white rounded-xl font-medium transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl enroll-btn"
                                                data-course-name="{{ $course->name }}">
                                            <i class="fas fa-user-plus mr-2"></i> Enroll Now
                                        </button>
                                    </form>
                                @endif
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="text-center py-20 bg-gradient-to-br from-white to-indigo-50 rounded-2xl shadow-lg mt-8 border border-indigo-100">
        <div class="max-w-md mx-auto">
            <div class="w-20 h-20 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-book-open text-3xl text-indigo-600"></i>
            </div>
            @auth
                @if(Auth::user()->isUser())
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">You Havent Joined Any Courses</h3>
                    <p class="text-gray-600 mb-8 leading-relaxed">Search Courses List If You Want To Join Any Courses</p>
                    <a href="{{ route('courses.all') }}" 
                       class="inline-flex items-center px-6 py-3 bg-[#2b2738] hover:bg-indigo-700 text-white font-semibold rounded-xl transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        <i class="fas fa-eye mr-3"></i> Search Courses List
                    </a>
                @elseif(Auth::user()->canCreateCourses())
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">No Courses Created Yet</h3>
                    <p class="text-gray-600 mb-8 leading-relaxed">You haven't created any courses yet.<br>Start by creating your first course!</p>
                    <a href="{{ route('courses.create') }}" 
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-xl transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        <i class="fas fa-plus mr-3"></i> Create Your First Course
                    </a>
                @endif
            @endauth
        </div>
    </div>
@endif
<!-- Pagination -->
@if(method_exists($courses, 'hasPages') && $courses->hasPages())
    <div class="mt-6 flex justify-center">
        {{ $courses->links() }}
    </div>
@endif

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggles = document.querySelectorAll('.course-dropdown-toggle');

    toggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            const menu = this.closest('.relative').querySelector('.course-dropdown-menu');

            // Close all other dropdowns first
            document.querySelectorAll('.course-dropdown-menu').forEach(m => {
                if (m !== menu) {
                    m.classList.remove('show');
                }
            });

            // Toggle this dropdown
            if (menu) {
                menu.classList.toggle('show');
            }
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.course-dropdown-toggle') && !e.target.closest('.course-dropdown-menu')) {
            document.querySelectorAll('.course-dropdown-menu').forEach(menu => {
                menu.classList.remove('show');
            });
        }
    });

    // Close dropdowns when pressing Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.course-dropdown-menu').forEach(menu => {
                menu.classList.remove('show');
            });
        }
    });

    // SweetAlert2 for course delete
    document.querySelectorAll('.course-delete-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const form = btn.closest('form');
            const courseName = btn.getAttribute('data-course-name') || 'this course';
            Swal.fire({
                title: 'Delete Course?',
                html: `Are you sure you want to delete <b>${courseName}</b>?<br>This action cannot be undone.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
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

    // SweetAlert2 for unenroll
    document.querySelectorAll('.unenroll-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const form = btn.closest('form');
            const courseName = btn.getAttribute('data-course-name') || 'this course';
            Swal.fire({
                title: 'Unenroll from Course?',
                html: `Are you sure you want to unenroll from <b>${courseName}</b>?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, unenroll',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // SweetAlert2 for enroll
    document.querySelectorAll('.enroll-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const form = btn.closest('form');
            const courseName = btn.getAttribute('data-course-name') || 'this course';
            Swal.fire({
                title: 'Enroll in Course?',
                html: `Do you want to enroll in <b>${courseName}</b>?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, enroll',
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

</div>
@endsection