@extends('layouts.app')

@section('title', $post->title . ' - ' . $post->course->name)

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col-lg-8 col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('courses.index') }}" class="text-decoration-none">
                            <i class="fas fa-home me-1"></i>
                            Courses
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('courses.show', $post->course) }}" class="text-decoration-none">
                            {{ $post->course->name }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $post->title }}
                    </li>
                </ol>
            </nav>
            
            <h1 class="page-title">
                <i class="fas fa-{{ $post->type === 'text' ? 'file-text' : ($post->type === 'image' ? 'image' : ($post->type === 'video' ? 'video' : 'file')) }} me-2"></i>
                {{ $post->title }}
            </h1>
            
            <div class="d-flex flex-wrap align-items-center gap-2 gap-md-3">
                <span class="badge bg-{{ $post->type === 'text' ? 'primary' : ($post->type === 'image' ? 'success' : ($post->type === 'video' ? 'warning' : 'info')) }}">
                    <i class="fas fa-{{ $post->type === 'text' ? 'file-text' : ($post->type === 'image' ? 'image' : ($post->type === 'video' ? 'video' : 'file')) }} me-1"></i>
                    {{ ucfirst($post->type) }}
                </span>
                <span class="badge bg-secondary">
                    <i class="fas fa-user me-1"></i>
                    {{ $post->user->name }}
                </span>
                <span class="badge bg-info">
                    <i class="fas fa-calendar me-1"></i>
                    {{ $post->created_at->format('M d, Y H:i') }}
                </span>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 text-lg-end text-md-start mt-3 mt-lg-0">
            @auth
                @if(Auth::user()->canManageCourse($post->course))
                    <div class="btn-group" role="group">
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-outline-primary">
                            <i class="fas fa-edit me-2"></i>
                            Edit Post
                        </a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger" 
                                    onclick="return confirm('Are you sure you want to delete this post?')">
                                <i class="fas fa-trash me-2"></i>
                                Delete
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
        <div class="card">
            <div class="card-body">
                @if($post->content)
                    <div class="post-content mb-4">
                        <h5 class="mb-3">
                            <i class="fas fa-align-left me-2"></i>
                            Content
                        </h5>
                        <div class="content-text">
                            {!! nl2br(e($post->content)) !!}
                        </div>
                    </div>
                @endif

                @if($post->file_path)
                    <div class="file-content">
                        <h5 class="mb-3">
                            <i class="fas fa-{{ $post->type === 'image' ? 'image' : ($post->type === 'video' ? 'video' : 'file') }} me-2"></i>
                            {{ $post->type === 'image' ? 'Image' : ($post->type === 'video' ? 'Video' : 'File') }}
                        </h5>
                        
                        @if($post->type === 'image')
                            <div class="text-center">
                                <img src="{{ Storage::url($post->file_path) }}" 
                                     alt="{{ $post->title }}" 
                                     class="img-fluid rounded shadow-sm" 
                                     style="max-height: 500px;">
                            </div>
                        @elseif($post->type === 'video')
                            <div class="text-center">
                                <video controls class="w-100 rounded shadow-sm" style="max-height: 500px;">
                                    <source src="{{ Storage::url($post->file_path) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        @else
                            <div class="file-preview">
                                <div class="d-flex align-items-center p-4 bg-light rounded">
                                    <div class="file-icon me-4">
                                        <i class="fas fa-file-pdf fa-3x text-primary"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">{{ basename($post->file_path) }}</h6>
                                        <p class="text-muted mb-2">File attachment</p>
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i>
                                            Uploaded on {{ $post->created_at->format('M d, Y H:i') }}
                                        </small>
                                    </div>
                                    <div class="ms-3">
                                        <a href="{{ Storage::url($post->file_path) }}" 
                                           class="btn btn-primary" 
                                           target="_blank"
                                           download>
                                            <i class="fas fa-download me-2"></i>
                                            Download
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-12 mt-4 mt-lg-0">
        <!-- Post Information -->
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    Post Information
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Course:</strong><br>
                    <a href="{{ route('courses.show', $post->course) }}" class="text-decoration-none">
                        {{ $post->course->name }}
                    </a>
                </div>
                <div class="mb-3">
                    <strong>Author:</strong><br>
                    <span class="text-muted">{{ $post->user->name }}</span>
                </div>
                <div class="mb-3">
                    <strong>Created:</strong><br>
                    <span class="text-muted">{{ $post->created_at->format('M d, Y H:i') }}</span>
                </div>
                <div class="mb-3">
                    <strong>Last updated:</strong><br>
                    <span class="text-muted">{{ $post->updated_at->format('M d, Y H:i') }}</span>
                </div>
                <div class="mb-3">
                    <strong>Type:</strong><br>
                    <span class="badge bg-{{ $post->type === 'text' ? 'primary' : ($post->type === 'image' ? 'success' : ($post->type === 'video' ? 'warning' : 'info')) }}">
                        {{ ucfirst($post->type) }}
                    </span>
                </div>
                @if($post->file_path)
                    <div class="mb-3">
                        <strong>File:</strong><br>
                        <span class="text-muted">{{ basename($post->file_path) }}</span>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Quick Actions -->
        @auth
            @if(Auth::user()->canManageCourse($post->course))
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-tools me-2"></i>
                            Quick Actions
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-outline-primary">
                                <i class="fas fa-edit me-2"></i>
                                Edit Post
                            </a>
                            <a href="{{ route('courses.show', $post->course) }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Back to Course
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-arrow-left me-2"></i>
                            Navigation
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('courses.show', $post->course) }}" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Back to Course
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        @endauth
    </div>
</div>

<style>
.post-content {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 0.5rem;
    border-left: 4px solid var(--primary-color);
}

.content-text {
    line-height: 1.6;
    font-size: 1.1rem;
}

.file-preview {
    background: white;
    border: 1px solid var(--border-color);
    border-radius: 0.5rem;
}

.breadcrumb {
    background: transparent;
    padding: 0;
    margin-bottom: 1rem;
}

.breadcrumb-item a {
    color: var(--primary-color);
}

.breadcrumb-item.active {
    color: var(--text-secondary);
}
</style>
@endsection 