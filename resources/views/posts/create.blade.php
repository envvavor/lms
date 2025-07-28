@extends('layouts.app')

@section('title', 'Create Post - ' . $course->name)

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
                        <a href="{{ route('courses.show', $course) }}" class="text-decoration-none">
                            {{ $course->name }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Create Post
                    </li>
                </ol>
            </nav>
            
            <h1 class="page-title">
                <i class="fas fa-plus me-2"></i>
                Create New Post
            </h1>
            <p class="page-subtitle">
                Add a new post to course: {{ $course->name }}
            </p>
        </div>
        <div class="col-lg-4 col-md-12 text-lg-end text-md-start mt-3 mt-lg-0">
            <a href="{{ route('courses.show', $course) }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>
                Back to Course
            </a>
        </div>
    </div>
</div>

<!-- Create Form -->
<div class="row">
    <div class="col-lg-8 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-plus me-2"></i>
                    Post Details
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('posts.store', $course) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">
                            <i class="fas fa-heading me-1"></i>
                            Post Title
                        </label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title') }}" required 
                               placeholder="Enter post title...">
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
                            <option value="text" {{ old('type') == 'text' ? 'selected' : '' }}>Text</option>
                            <option value="image" {{ old('type') == 'image' ? 'selected' : '' }}>Image</option>
                            <option value="file" {{ old('type') == 'file' ? 'selected' : '' }}>File</option>
                            <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>Video</option>
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
                                  placeholder="Enter post content...">{{ old('content') }}</textarea>
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
                            Upload a file to accompany your post. Supported formats: images, videos, documents.
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('courses.show', $course) }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-2"></i>
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>
                            Create Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-12 mt-4 mt-lg-0">
        <!-- Course Info -->
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    Course Information
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Course:</strong><br>
                    <span class="text-muted">{{ $course->name }}</span>
                </div>
                <div class="mb-3">
                    <strong>Description:</strong><br>
                    <span class="text-muted">{{ $course->description ?: 'No description' }}</span>
                </div>
                <div class="mb-3">
                    <strong>Created by:</strong><br>
                    <span class="text-muted">{{ $course->user->name }}</span>
                </div>
                <div class="mb-3">
                    <strong>Total posts:</strong><br>
                    <span class="text-muted">{{ $course->posts->count() }}</span>
                </div>
            </div>
        </div>
        
        <!-- Post Type Guide -->
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-question-circle me-2"></i>
                    Post Type Guide
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="d-flex align-items-center mb-2">
                        <span class="badge bg-primary me-2">Text</span>
                        <small class="text-muted">Simple text content</small>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <span class="badge bg-success me-2">Image</span>
                        <small class="text-muted">Image files (JPG, PNG, GIF)</small>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <span class="badge bg-info me-2">File</span>
                        <small class="text-muted">Documents (PDF, DOC, etc.)</small>
                    </div>
                    <div class="d-flex align-items-center">
                        <span class="badge bg-warning me-2">Video</span>
                        <small class="text-muted">Video files (MP4, AVI, etc.)</small>
                    </div>
                </div>
                
                <div class="alert alert-info">
                    <i class="fas fa-lightbulb me-2"></i>
                    <strong>Tip:</strong> You can combine text content with file uploads for richer posts.
                </div>
            </div>
        </div>
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
</style>

<script>
// Dynamic form behavior based on post type
document.getElementById('type').addEventListener('change', function() {
    const type = this.value;
    const contentField = document.getElementById('content');
    const fileField = document.getElementById('file');
    
    if (type === 'text') {
        contentField.required = true;
        fileField.required = false;
        contentField.placeholder = 'Enter your text content...';
    } else if (type === 'image' || type === 'video' || type === 'file') {
        contentField.required = false;
        fileField.required = true;
        contentField.placeholder = 'Add optional description...';
    }
});
</script>
@endsection 