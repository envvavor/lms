@extends('layouts.app')

@section('title', 'Edit Post - ' . $post->title)

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
                    <li class="breadcrumb-item">
                        <a href="{{ route('posts.show', $post) }}" class="text-decoration-none">
                            {{ $post->title }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Edit
                    </li>
                </ol>
            </nav>
            
            <h1 class="page-title">
                <i class="fas fa-edit me-2"></i>
                Edit Post
            </h1>
            <p class="page-subtitle">
                Update post: {{ $post->title }}
            </p>
        </div>
        <div class="col-lg-4 col-md-12 text-lg-end text-md-start mt-3 mt-lg-0">
            <a href="{{ route('posts.show', $post) }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>
                Back to Post
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
                    Edit Post Details
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">
                            <i class="fas fa-heading me-1"></i>
                            Post Title
                        </label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title', $post->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">
                            <i class="fas fa-tag me-1"></i>
                            Post Type
                        </label>
                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                            <option value="">Select post type</option>
                            <option value="text" {{ old('type', $post->type) == 'text' ? 'selected' : '' }}>Text</option>
                            <option value="image" {{ old('type', $post->type) == 'image' ? 'selected' : '' }}>Image</option>
                            <option value="file" {{ old('type', $post->type) == 'file' ? 'selected' : '' }}>File</option>
                            <option value="video" {{ old('type', $post->type) == 'video' ? 'selected' : '' }}>Video</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">
                            <i class="fas fa-align-left me-1"></i>
                            Content
                        </label>
                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                  id="content" name="content" rows="6" 
                                  placeholder="Enter post content...">{{ old('content', $post->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="file" class="form-label">
                            <i class="fas fa-file-upload me-1"></i>
                            File (Optional)
                        </label>
                        <input type="file" class="form-control @error('file') is-invalid @enderror" 
                               id="file" name="file">
                        @error('file')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-text">
                            <i class="fas fa-info-circle me-1"></i>
                            Leave empty to keep the current file. Upload a new file to replace the existing one.
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('posts.show', $post) }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-2"></i>
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>
                            Update Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-12 mt-4 mt-lg-0">
        <!-- Current Post Info -->
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    Current Post Info
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Title:</strong><br>
                    <span class="text-muted">{{ $post->title }}</span>
                </div>
                <div class="mb-3">
                    <strong>Type:</strong><br>
                    <span class="badge bg-{{ $post->type === 'text' ? 'primary' : ($post->type === 'image' ? 'success' : ($post->type === 'video' ? 'warning' : 'info')) }}">
                        {{ ucfirst($post->type) }}
                    </span>
                </div>
                <div class="mb-3">
                    <strong>Course:</strong><br>
                    <span class="text-muted">{{ $post->course->name }}</span>
                </div>
                <div class="mb-3">
                    <strong>Created:</strong><br>
                    <span class="text-muted">{{ $post->created_at->format('M d, Y H:i') }}</span>
                </div>
                @if($post->file_path)
                    <div class="mb-3">
                        <strong>Current File:</strong><br>
                        <span class="text-muted">{{ basename($post->file_path) }}</span>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- File Preview -->
        @if($post->file_path)
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-file me-2"></i>
                        Current File
                    </h6>
                </div>
                <div class="card-body">
                    @if($post->type === 'image')
                        <img src="{{ Storage::url($post->file_path) }}" 
                             alt="{{ $post->title }}" 
                             class="img-fluid rounded mb-3">
                    @elseif($post->type === 'video')
                        <video controls class="w-100 rounded mb-3" style="max-height: 200px;">
                            <source src="{{ Storage::url($post->file_path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @else
                        <div class="d-flex align-items-center p-3 bg-light rounded">
                            <div class="file-icon me-3">
                                <i class="fas fa-file-pdf fa-2x text-primary"></i>
                            </div>
                            <div>
                                <strong>{{ basename($post->file_path) }}</strong>
                                <br>
                                <small class="text-muted">Current file</small>
                            </div>
                        </div>
                    @endif
                    
                    <div class="mt-3">
                        <a href="{{ Storage::url($post->file_path) }}" 
                           class="btn btn-sm btn-outline-primary" 
                           target="_blank">
                            <i class="fas fa-download me-1"></i>
                            Download Current File
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
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

.file-icon {
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>
@endsection 