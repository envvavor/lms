@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-edit"></i> Edit Post</h4>
                <p class="text-muted mb-0">Course: {{ $post->course->name }}</p>
            </div>
            <div class="card-body">
                <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Post Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title', $post->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Content Type</label>
                        <input type="text" class="form-control" value="{{ ucfirst($post->type) }}" readonly>
                        <div class="form-text">
                            <small class="text-muted">Content type cannot be changed after creation</small>
                        </div>
                    </div>

                    @if($post->type === 'text')
                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" 
                                      id="content" name="content" rows="6">{{ old('content', $post->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @else
                        <div class="mb-3">
                            <label class="form-label">Current File</label>
                            <div class="border rounded p-3 bg-light">
                                @if($post->type === 'image')
                                    <img src="{{ Storage::url($post->file_path) }}" 
                                         alt="{{ $post->title }}" 
                                         class="img-fluid rounded" 
                                         style="max-height: 200px;">
                                @elseif($post->type === 'video')
                                    <video controls class="w-100" style="max-height: 200px;">
                                        <source src="{{ Storage::url($post->file_path) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @else
                                    <div class="text-center">
                                        <i class="fas fa-file fa-2x text-muted mb-2"></i>
                                        <p class="text-muted mb-0">{{ basename($post->file_path) }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="file" class="form-label">Replace File (Optional)</label>
                            <input type="file" class="form-control @error('file') is-invalid @enderror" 
                                   id="file" name="file">
                            <div class="form-text">
                                <small class="text-muted">
                                    <i class="fas fa-info-circle"></i> 
                                    Maximum file size: 10MB. Leave empty to keep current file.
                                </small>
                            </div>
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('courses.show', $post->course) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Course
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 