@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-plus"></i> Create New Post</h4>
                <p class="text-muted mb-0">Course: {{ $course->name }}</p>
            </div>
            <div class="card-body">
                <form action="{{ route('posts.store', $course) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Post Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Content Type</label>
                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                            <option value="">Select content type</option>
                            <option value="text" {{ old('type') == 'text' ? 'selected' : '' }}>Text</option>
                            <option value="image" {{ old('type') == 'image' ? 'selected' : '' }}>Image</option>
                            <option value="file" {{ old('type') == 'file' ? 'selected' : '' }}>File</option>
                            <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>Video</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3" id="content-field" style="display: none;">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                  id="content" name="content" rows="6">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3" id="file-field" style="display: none;">
                        <label for="file" class="form-label">File</label>
                        <input type="file" class="form-control @error('file') is-invalid @enderror" 
                               id="file" name="file">
                        <div class="form-text">
                            <small class="text-muted">
                                <i class="fas fa-info-circle"></i> 
                                Maximum file size: 10MB. 
                                Supported formats: Images (jpg, png, gif), Documents (pdf, doc, docx), Videos (mp4, avi, mov)
                            </small>
                        </div>
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('courses.show', $course) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Course
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Create Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('type');
    const contentField = document.getElementById('content-field');
    const fileField = document.getElementById('file-field');

    function toggleFields() {
        const selectedType = typeSelect.value;
        
        if (selectedType === 'text') {
            contentField.style.display = 'block';
            fileField.style.display = 'none';
        } else if (['image', 'file', 'video'].includes(selectedType)) {
            contentField.style.display = 'none';
            fileField.style.display = 'block';
        } else {
            contentField.style.display = 'none';
            fileField.style.display = 'none';
        }
    }

    typeSelect.addEventListener('change', toggleFields);
    
    // Initialize on page load
    toggleFields();
});
</script>
@endsection 