@extends('layouts.app')

@section('title', $post->title . ' - ' . $post->course->name)

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="m-3 sm:m-5">
<div class="page-header mb-4 sm:mb-2">
    <div class="row align-items-center">
        <div class="col-lg-8 col-md-12">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('courses.index') }}" class="text-decoration-none text-dark">
                            <i class="fas fa-home me-1"></i> Courses
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('courses.show', $post->course) }}" class="text-decoration-none text-dark">
                            {{ $post->course->name }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-dark" aria-current="page">
                        {{ $post->title }}
                    </li>
                </ol>
            </nav>

            <!-- Title -->
            <h1 class="page-title fw-bold text-dark mb-2">
                <i class="fas fa-{{ $post->type === 'text' ? 'file-alt' : ($post->type === 'image' ? 'image' : ($post->type === 'video' ? 'video' : 'paperclip')) }} me-2 text-primary"></i>
                {{ $post->title }}
            </h1>

            <!-- Meta -->
            <div class="d-flex flex-wrap align-items-center gap-2">
                <span class="badge rounded-pill" style="background:#2b2738; color:#fff;">
                    {{ ucfirst($post->type) }}
                </span>
                <span class="badge bg-light text-dark border">
                    <i class="fas fa-user me-1"></i> {{ $post->user->name }}
                </span>
                <span class="badge bg-light text-dark border">
                    <i class="fas fa-calendar me-1"></i> {{ $post->created_at->format('M d, Y H:i') }}
                </span>
            </div>
        </div>

        <!-- Action buttons -->
        <div class="col-lg-4 col-md-12 text-lg-end text-md-start mt-3 mt-lg-0">
            @auth
                @if(Auth::user()->canManageCourse($post->course))
                    <div class="btn-group" role="group">
                        <a href="{{ route('posts.edit', $post) }}" class="btn">
                            <i class="fas fa-edit me-2"></i>Edit
                        </a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline delete-post-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-outline-danger btn-delete-post"
                                    data-post-title="{{ $post->title }}">
                                <i class="fas fa-trash me-2"></i>Delete
                            </button>
                        </form>
                    </div>
                @endif
            @endauth
        </div>
    </div>
</div>

<!-- Post Content -->
<div class="row">
    <div class="col-lg-8 col-md-12">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                @if($post->content)
                    <div class="post-content mb-4">
                        <h5 class="fw-bold mb-3 text-dark">
                            <i class="fas fa-align-left me-2 text-primary"></i> Content
                        </h5>
                        <div class="content-text text-dark">
                            {!! nl2br(e($post->content)) !!}
                        </div>
                    </div>
                @endif

                <!-- File Attachment -->
                @if($post->file_path)
                    <div class="mb-3">
                        @php
                            $ext = strtolower(pathinfo($post->file_path, PATHINFO_EXTENSION));
                        @endphp

                        @if(in_array($ext, ['jpg','jpeg','png','gif','webp']))
                            <img src="{{ asset($post->file_path) }}" 
                                alt="Attachment"
                                class="img-fluid rounded shadow"
                                style="max-height:350px; object-fit:cover;">
                        
                        @elseif(in_array($ext, ['mp4','webm','ogg']))
                            <video controls class="w-100 rounded shadow" style="max-height:350px;">
                                <source src="{{ asset($post->file_path) }}" type="video/{{ $ext }}">
                                Your browser does not support the video tag.
                            </video>
                        
                        @elseif($ext === 'pdf')
                            <iframe src="{{ asset($post->file_path) }}" 
                                    class="w-100 rounded" style="height:400px;" frameborder="0"></iframe>
                            <a href="{{ asset($post->file_path) }}" target="_blank" 
                               class="btn btn-sm btn-dark mt-2">
                                <i class="fas fa-external-link-alt me-1"></i> Open PDF
                            </a>
                        
                        @else
                            <!-- File Attachment Card Responsive -->
                            @php
                                $filename = basename($post->file_path);
                                $cleanName = explode("_", $filename, 2)[1] ?? $filename;
                            @endphp
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
                            // Ambil video ID dari berbagai format URL (watch, live, youtu.be, embed)
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
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4 col-md-12 mt-4 mt-lg-0">
        <div class="card shadow-sm border-0 mb-4">
            <div class="bg-[#2b2738] p-4 text-white fw-bold">
                <i class="fas fa-info-circle me-2"></i> Post Information
            </div>
            <div class="card-body">
                <p><strong>Course:</strong> <br>
                    <a href="{{ route('courses.show', $post->course) }}" class="text-dark fw-semibold">
                        {{ $post->course->name }}
                    </a>
                </p>
                <p><strong>Author:</strong><br><span class="text-muted">{{ $post->user->name }}</span></p>
                <p><strong>Created:</strong><br><span class="text-muted">{{ $post->created_at->format('M d, Y H:i') }}</span></p>
                <p><strong>Updated:</strong><br><span class="text-muted">{{ $post->updated_at->format('M d, Y H:i') }}</span></p>
                @if($post->file_path)
                    <p><strong>File:</strong><br><span class="text-muted">{{ basename($post->file_path) }}</span></p>
                @endif
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="bg-[#2b2738] p-4 text-white fw-bold">
                <i class="fas fa-arrow-left me-2"></i> Navigation
            </div>
            <div class="card-body">
                <a href="{{ route('courses.show', $post->course) }}" class="btn btn-dark w-100">
                    <i class="fas fa-arrow-left me-2"></i> Back to Course
                </a>
            </div>
        </div>
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
<style>
.page-title { color:#2b2738; }
.post-content {
    background: #fff;
    border: 1px solid #ddd;
    padding: 1.5rem;
    border-radius: 0.5rem;
    border-left: 4px solid #2b2738;
}
.content-text {
    line-height: 1.6;
    font-size: 1.05rem;
    color:#2b2738;
}
</style>
@endsection
