@extends('layouts.app')

@section('title', $course->name . ' - Course Details')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="m-3 sm:m-5 animate-slide-up">

    <!-- Page Header -->
    <div class="bg-[#2b2738] text-white rounded-2xl shadow-lg p-6 mb-6">
        <div class="row align-items-center">
            <div class="col-lg-8 col-md-12">
                <h1 class="text-2xl font-bold flex items-center gap-2">
                    <i class="fas fa-graduation-cap"></i>
                    {{ $course->name }}
                </h1>
                <p class="mt-2 opacity-80">
                    {{ $course->description ?: 'No description available' }}
                </p>
                <div class="d-flex flex-wrap align-items-center gap-2 mt-3">
                    <span class="badge bg-primary px-3 py-2 rounded-pill shadow">
                        <i class="fas fa-user me-1"></i>
                        {{ $course->user->name }}
                    </span>
                    <span class="badge bg-info px-3 py-2 rounded-pill shadow">
                        <i class="fas fa-users me-1"></i>
                        {{ $course->enrollments->count() }} students
                    </span>
                    <span class="badge bg-success px-3 py-2 rounded-pill shadow">
                        <i class="fas fa-file-alt me-1"></i>
                        {{ $course->posts->count() }} posts
                    </span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="col-lg-4 col-md-12 text-lg-end text-md-start mt-4 mt-lg-0">
                @auth
                    @if(Auth::user()->canManageCourse($course))
                        <div class="btn-group shadow-sm rounded-lg">
                            <a href="{{ route('posts.create', $course) }}" class="btn btn-light">
                                <i class="fas fa-plus me-2"></i> Add Post
                            </a>
                            <a href="{{ route('courses.edit', $course) }}" class="btn btn-outline-light">
                                <i class="fas fa-edit me-2"></i> Edit
                            </a>
                            <a href="{{ route('courses.enrollments', $course) }}" class="btn btn-outline-info">
                                <i class="fas fa-users me-2"></i> Manage
                            </a>
                        </div>
                    @elseif(Auth::user()->isUser())
                        @if(Auth::user()->enrolledCourses()->where('course_id', $course->id)->exists())
                            <!-- <form action="{{ route('enrollments.unenroll', $course) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger rounded-pill shadow-sm">
                                    <i class="fas fa-user-times me-2"></i> Unenroll
                                </button>
                            </form> -->
                        @else
                            <!-- <form action="{{ route('enrollments.enroll', $course) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success rounded-pill shadow-sm">
                                    <i class="fas fa-user-plus me-2"></i> Enroll
                                </button>
                            </form> -->
                        @endif
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <!-- Course Content -->
    <div class="row mt-3">
        <div class="col-lg-8 col-md-12">

            <!-- Posts Section -->
            <div class="card shadow-lg border-0 rounded-2xl mb-4">
                <div class="p-4 bg-[#2b2738] text-white rounded-t-2xl">
                    <h5 class="mb-0 flex items-center gap-2">
                        <i class="fas fa-file-alt"></i> Course Posts
                    </h5>
                </div>
                <div class="card-body bg-white rounded-b-2xl">
                    @if($course->posts->count() > 0)
                        @foreach($course->posts as $post)
                            <div class="p-3 mb-4 border rounded-xl shadow-sm bg-light">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        @php
                                            $icons = [
                                                'text' => 'fa-file-alt',
                                                'image' => 'fa-file-image',
                                                'video' => 'fa-file-video',
                                                'link' => 'fa-link',
                                                'other' => 'fa-paperclip'
                                            ];
                                            $icon = $icons[$post->type] ?? 'fa-file';
                                        @endphp

                                        <h5 class="fw-bold text-[#2b2738]">
                                            <i class="fas {{ $icon }} me-2 text-primary"></i>
                                            <a href="{{ route('posts.show', $post) }}" class="hover:text-blue-500">{{ $post->title }}</a>
                                        </h5>
                                        <small class="text-muted">
                                            <i class="fas fa-user me-1"></i>{{ $post->user->name }} • 
                                            <i class="fas fa-calendar me-1"></i>{{ $post->created_at->format('M d, Y H:i') }}
                                        </small>
                                    </div>
                                    @auth
                                        @if(Auth::user()->canManageCourse($course))
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="{{ route('posts.show', $post) }}"><i class="fas fa-eye me-2"></i> View</a></li>
                                                    <li><a class="dropdown-item" href="{{ route('posts.edit', $post) }}"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li>
                                                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                                                            @csrf @method('DELETE')
                                                            <button type="button" 
                                                                    class="dropdown-item text-danger btn-delete-post"
                                                                    data-post-title="{{ $post->title }}">
                                                                <i class="fas fa-trash me-2"></i> Delete
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                                <p class="text-muted mb-2">{{ Str::limit($post->content, 200) }}</p>
                                <!-- File Attachment -->
                                @php
                                    $filename = basename($post->file_path);
                                    $cleanName = explode("_", $filename, 2)[1] ?? $filename;
                                @endphp
                                @if($post->file_path)
                                    <div class="mb-3">
                                        @php
                                            $ext = pathinfo($post->file_path, PATHINFO_EXTENSION);
                                        @endphp

                                        @if(in_array($ext, ['jpg','jpeg','png','gif','webp']))
                                            <!-- Image preview -->
                                            <img src="{{ asset($post->file_path) }}" alt="Attachment"
                                                class="rounded-lg shadow max-h-64 object-cover">
                                        
                                        @elseif(in_array($ext, ['mp4','webm','ogg']))
                                            <!-- Video preview -->
                                            <video controls class="w-full rounded-lg shadow">
                                                <source src="{{ asset($post->file_path) }}" type="video/{{ $ext }}">
                                                Your browser does not support the video tag.
                                            </video>
                                        
                                        @elseif(in_array($ext, ['pdf', ]))
                                            <!-- PDF embed -->
                                            <!-- <iframe src="{{ asset('storage/' . $post->file_path) }}" class="w-full h-64 rounded-lg"></iframe> -->
                                            <!-- <a href="{{ asset('storage/' . $post->file_path) }}" target="_blank" 
                                            class="text-blue-600 underline text-sm">Open PDF</a> -->
                                            <!-- File Attachment Card -->
                                            <!-- File Attachment Card Responsive -->
                                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between w-full bg-white border border-gray-200 rounded-2xl shadow-sm p-4 mb-3 hover:shadow-md transition gap-3">

                                                <!-- File Info -->
                                                <div class="flex items-center space-x-3 w-full sm:w-auto">
                                                    <div class="flex items-center justify-center w-12 h-12 bg-blue-100 text-blue-600 rounded-xl shrink-0">
                                                        <i class="fas fa-paperclip text-lg"></i>
                                                    </div>
                                                    <div class="min-w-0">
                                                        <p class="text-gray-800 font-medium truncate">
                                                            {{ $cleanName }}
                                                        </p>
                                                        <p class="text-sm text-gray-500">Attachment File</p>
                                                    </div>
                                                </div>

                                                <!-- Download Button -->
                                                <div class="w-full sm:w-auto">
                                                    <a href="{{ asset($post->file_path) }}" target="_blank"
                                                    class="inline-flex justify-center items-center w-full sm:w-auto px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition">
                                                        <i class="fas fa-eye mr-2"></i> Open PDF
                                                    </a>
                                                </div>
                                            </div>
                                        @else
                                            <!-- File Attachment Card Responsive -->
                                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between w-full bg-white border border-gray-200 rounded-2xl shadow-sm p-4 mb-3 hover:shadow-md transition gap-3">

                                                <!-- File Info -->
                                                <div class="flex items-center space-x-3 w-full sm:w-auto">
                                                    <div class="flex items-center justify-center w-12 h-12 bg-blue-100 text-blue-600 rounded-xl shrink-0">
                                                        <i class="fas fa-paperclip text-lg"></i>
                                                    </div>
                                                    <div class="min-w-0">
                                                        <p class="text-gray-800 font-medium truncate">
                                                            {{ $cleanName }}
                                                        </p>
                                                        <p class="text-sm text-gray-500">Attachment File</p>
                                                    </div>
                                                </div>

                                                <!-- Download Button -->
                                                <div class="w-full sm:w-auto">
                                                    <a href="{{ asset($post->file_path) }}" target="_blank"
                                                    class="inline-flex justify-center items-center w-full sm:w-auto px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition">
                                                        <i class="fas fa-download mr-2"></i> Download
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                                @if ($post->link)
                                    <!-- <div class="mt-3">
                                        <strong>Link:</strong> 
                                        <a href="{{ $post->link }}" target="_blank" class="text-primary">
                                            {{ $post->link }}
                                        </a>
                                    </div> -->

                                    {{-- Embed YouTube --}}
                                    @if (Str::contains($post->link, 'youtube.com') || Str::contains($post->link, 'youtu.be'))
                                        @php
                                            // Ambil video ID dari berbagai bentuk URL (watch, live, youtu.be, embed)
                                            preg_match('/(?:youtu\.be\/|v=|live\/|embed\/)([^?&]+)/', $post->link, $matches);
                                            $youtubeId = $matches[1] ?? null;
                                        @endphp

                                        @if($youtubeId)
                                            <div class="relative w-full" style="padding-top: 56.25%;"> {{-- 16:9 ratio --}}
                                                <iframe 
                                                    class="absolute top-0 left-0 w-full h-full rounded-lg shadow"
                                                    src="https://www.youtube.com/embed/{{ $youtubeId }}" 
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen>
                                                </iframe>
                                            </div>
                                        @endif
                                    @endif

                                    {{-- Embed Google Drive --}}
                                    @if (Str::contains($post->link, 'drive.google.com'))
                                        @php
                                            preg_match('/\/d\/(.*?)(\/|$)/', $post->link, $matches);
                                            $driveId = $matches[1] ?? null;
                                        @endphp
                                        @if($driveId)
                                            <div class="relative w-full" style="padding-top: 56.25%;"> {{-- 16:9 ratio --}}
                                                <iframe class="absolute top-0 left-0 w-full h-full rounded-lg shadow"
                                                        src="https://drive.google.com/file/d/{{ $driveId }}/preview" 
                                                        allow="autoplay"></iframe>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                                <a href="{{ route('posts.show', $post) }}" class="btn btn-outline-dark btn-sm rounded-pill mt-3">
                                    <i class="fas fa-eye me-1"></i> View Full
                                </a>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-ban fa-2x mb-2"></i>
                            <h5>No Posts Yet</h5>
                            <p>This course doesn't have any posts yet.</p>
                            <br>
                            @auth
                                @if(Auth::user()->canManageCourse($course))
                                    <a href="{{ route('posts.create', $course) }}" class="btn btn-primary">
                                        <i class="fas fa-plus me-2"></i> Create First Post
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4 col-md-12 mt-4 mt-lg-0">
            <div class="card shadow-lg border-0 rounded-2xl mb-4">
                <div class="p-4 bg-[#2b2738] text-white rounded-t-2xl">
                    <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i> Course Info</h6>
                </div>
                <div class="card-body bg-white rounded-b-2xl">
                    <p><strong>Created by:</strong> <span class="text-muted">{{ $course->user->name }}</span></p>
                    <p><strong>Created on:</strong> <span class="text-muted">{{ $course->created_at->format('M d, Y') }}</span></p>
                    <p><strong>Last updated:</strong> <span class="text-muted">{{ $course->updated_at->format('M d, Y') }}</span></p>
                    <p><strong>Total posts:</strong> <span class="text-muted">{{ $course->posts->count() }}</span></p>
                    <p><strong>Enrolled students:</strong> <span class="text-muted">{{ $course->enrollments->count() }}</span></p>
                </div>
            </div>

            @auth
                @if(Auth::user()->canManageCourse($course))
                    <div class="card shadow-lg border-0 rounded-2xl">
                        <div class="p-4 bg-[#2b2738] text-white rounded-t-2xl">
                            <h6 class="mb-0"><i class="fas fa-tools me-2"></i> Quick Actions</h6>
                        </div>
                        <div class="card-body bg-white rounded-b-2xl">
                            <div class="d-grid gap-2">
                                <a href="{{ route('posts.create', $course) }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i> Add Post
                                </a>
                                <a href="{{ route('courses.enrollments', $course) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-users me-2"></i> Manage Students
                                </a>
                                <a href="{{ route('courses.edit', $course) }}" class="btn btn-outline-dark">
                                    <i class="fas fa-edit me-2"></i> Edit Course
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            @endauth
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-delete-post').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const form = btn.closest('form');
            const postTitle = btn.getAttribute('data-post-title') || 'this post';
            Swal.fire({
                title: 'Delete Post?',
                html: `Are you sure you want to delete <b>${postTitle}</b>?<br>This action cannot be undone.`,
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
});
</script>
@endsection
