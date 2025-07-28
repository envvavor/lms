@extends('layouts.app')

@section('title', $course->name)

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1><i class="fas fa-book"></i> {{ $course->name }}</h1>
                @if($course->description)
                    <p class="text-muted">{{ $course->description }}</p>
                @endif
                <p class="text-muted">
                    <i class="fas fa-user"></i> Created by {{ $course->user->name }}
                    @if(Auth::user()->canManageCourse($course))
                        <span class="badge bg-primary">You own this course</span>
                    @endif
                </p>
            </div>
            <div>
                @if(Auth::user()->canManageCourse($course))
                    <a href="{{ route('posts.create', $course) }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add Post
                    </a>
                    <a href="{{ route('courses.edit', $course) }}" class="btn btn-outline-secondary">
                        <i class="fas fa-edit"></i> Edit Course
                    </a>
                    <a href="{{ route('courses.enrollments', $course) }}" class="btn btn-outline-info">
                        <i class="fas fa-users"></i> Manage Enrollments
                    </a>
                @elseif(Auth::user()->isUser())
                    @php
                        $isEnrolled = $course->enrollments()->where('user_id', Auth::id())->exists();
                    @endphp
                    @if($isEnrolled)
                        <form action="{{ route('enrollments.unenroll', $course) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-warning">
                                <i class="fas fa-sign-out-alt"></i> Unenroll
                            </button>
                        </form>
                    @else
                        <form action="{{ route('enrollments.enroll', $course) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-success">
                                <i class="fas fa-sign-in-alt"></i> Enroll
                            </button>
                        </form>
                    @endif
                @endif
            </div>
        </div>

        @if($course->posts->count() > 0)
            <div class="row">
                @foreach($course->posts as $post)
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    @switch($post->type)
                                        @case('text')
                                            <i class="fas fa-file-alt text-primary"></i>
                                            @break
                                        @case('image')
                                            <i class="fas fa-image text-success"></i>
                                            @break
                                        @case('file')
                                            <i class="fas fa-file text-warning"></i>
                                            @break
                                        @case('video')
                                            <i class="fas fa-video text-danger"></i>
                                            @break
                                    @endswitch
                                    {{ $post->title }}
                                </h5>
                                <div class="btn-group">
                                    @if(Auth::user()->canManageCourse($course))
                                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                @switch($post->type)
                                    @case('text')
                                        <div class="post-content">
                                            {!! nl2br(e($post->content)) !!}
                                        </div>
                                        @break
                                    
                                    @case('image')
                                        <div class="text-center">
                                            <img src="{{ Storage::url($post->file_path) }}" 
                                                 alt="{{ $post->title }}" 
                                                 class="img-fluid rounded" 
                                                 style="max-height: 300px;">
                                        </div>
                                        @break
                                    
                                    @case('file')
                                        <div class="text-center">
                                            <i class="fas fa-file fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">{{ basename($post->file_path) }}</p>
                                            <a href="{{ Storage::url($post->file_path) }}" 
                                               class="btn btn-primary" 
                                               download>
                                                <i class="fas fa-download"></i> Download File
                                            </a>
                                        </div>
                                        @break
                                    
                                    @case('video')
                                        <div class="text-center">
                                            <video controls class="w-100" style="max-height: 300px;">
                                                <source src="{{ Storage::url($post->file_path) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                        @break
                                @endswitch
                            </div>
                            <div class="card-footer text-muted">
                                <small>
                                    <i class="fas fa-user"></i> {{ $post->user->name }} • 
                                    <i class="fas fa-clock"></i> {{ $post->created_at->diffForHumans() }}
                                </small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                <h3 class="text-muted">No posts yet</h3>
                @if(Auth::user()->canManageCourse($course))
                    <p class="text-muted">Add your first post to this course!</p>
                    <a href="{{ route('posts.create', $course) }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add Your First Post
                    </a>
                @else
                    <p class="text-muted">This course doesn't have any posts yet.</p>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection 