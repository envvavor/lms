@extends('layouts.app')

@section('title', $post->title . ' - ' . $post->course->name)

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<div class="m-3 sm:m-5">
<div class="page-header mb-5">
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
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger"
                                    onclick="return confirm('Are you sure you want to delete this post?')">
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
                            <img src="{{ asset('storage/' . $post->file_path) }}" 
                                alt="Attachment"
                                class="img-fluid rounded shadow"
                                style="max-height:350px; object-fit:cover;">
                        
                        @elseif(in_array($ext, ['mp4','webm','ogg']))
                            <video controls class="w-100 rounded shadow" style="max-height:350px;">
                                <source src="{{ asset('storage/' . $post->file_path) }}" type="video/{{ $ext }}">
                                Your browser does not support the video tag.
                            </video>
                        
                        @elseif($ext === 'pdf')
                            <iframe src="{{ asset('storage/' . $post->file_path) }}" 
                                    class="w-100 rounded" style="height:400px;" frameborder="0"></iframe>
                            <a href="{{ asset('storage/' . $post->file_path) }}" target="_blank" 
                               class="btn btn-sm btn-dark mt-2">
                                <i class="fas fa-external-link-alt me-1"></i> Open PDF
                            </a>
                        
                        @else
                            <a href="{{ asset('storage/' . $post->file_path) }}" target="_blank"
                               class="btn btn-outline-dark">
                                <i class="fas fa-paperclip me-2"></i> Download Attachment
                            </a>
                        @endif
                    </div>
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
