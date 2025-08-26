@extends('layouts.app')

@section('title', 'Edit Post - ' . $post->title)

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<div class="m-3 sm:m-5">

    <!-- Breadcrumb -->
    <nav class="flex text-sm text-gray-600 mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-2">
            <li>
                <a href="{{ route('courses.index') }}" class="hover:text-blue-600 flex items-center">
                    <i class="fas fa-home mr-1"></i> Courses
                </a>
            </li>
            <li>
                <span class="mx-1">/</span>
                <a href="{{ route('courses.show', $post->course) }}" class="hover:text-blue-600">
                    {{ $post->course->name }}
                </a>
            </li>
            <li>
                <span class="mx-1">/</span>
                <a href="{{ route('posts.show', $post) }}" class="hover:text-blue-600">
                    {{ $post->title }}
                </a>
            </li>
            <li>
                <span class="mx-1">/</span>
                <span class="text-gray-400">Edit</span>
            </li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-edit text-blue-500"></i>
                Edit Post
            </h1>
            <p class="text-gray-500 mt-1">Update post: {{ $post->title }}</p>
        </div>
        <a href="{{ route('posts.show', $post) }}" 
           class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 border rounded-lg text-gray-700 border-gray-300 hover:bg-gray-100 transition">
            <i class="fas fa-arrow-left mr-2"></i> Back to Post
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Form -->
        <div class="lg:col-span-2">
            <div class="bg-white shadow rounded-2xl p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-4 flex items-center gap-2">
                    <i class="fas fa-file-alt text-blue-500"></i> Edit Post Details
                </h2>

                <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-heading mr-1"></i> Post Title
                        </label>
                        <input type="text" id="title" name="title"
                               class="p-2 w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror"
                               value="{{ old('title', $post->title) }}" required>
                        @error('title')
                            <p class="text-sm text-red-600 mt-1 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Content -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-align-left mr-1"></i> Content
                        </label>
                        <textarea id="content" name="content" rows="6"
                                  class="p-2 w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('content') border-red-500 @enderror"
                                  placeholder="Write something...">{{ old('content', $post->content) }}</textarea>
                        @error('content')
                            <p class="text-sm text-red-600 mt-1 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- File -->
                    <div>
                        <label for="file" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-file-upload mr-1"></i> File (optional)
                        </label>
                        <input type="file" id="file" name="file"
                               class="w-full text-gray-700 file:mr-4 file:py-2 file:px-4 
                                      file:rounded-lg file:border-0 
                                      file:text-sm file:font-semibold
                                      file:bg-blue-50 file:text-blue-600
                                      hover:file:bg-blue-100 
                                      @error('file') border-red-500 @enderror">
                        @error('file')
                            <p class="text-sm text-red-600 mt-1 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                        <p class="text-sm text-gray-500 mt-1">
                            <i class="fas fa-info-circle mr-1"></i> Leave empty to keep the current file.
                        </p>
                    </div>

                    <!-- Link -->
                    <div>
                        <label for="link" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-link mr-1"></i> YouTube/Drive Link
                        </label>
                        <input type="url" id="link" name="link"
                               class="p-2 w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('link', $post->link ?? '') }}" placeholder="https://...">
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-between items-center pt-4">
                        <a href="{{ route('posts.show', $post) }}" 
                           class="inline-flex items-center px-4 py-2 border rounded-lg text-gray-700 border-gray-300 hover:bg-gray-100 transition">
                            <i class="fas fa-times mr-2"></i> Cancel
                        </a>
                        <button type="submit"
                                class="inline-flex items-center px-5 py-2 bg-blue-600 text-white font-medium rounded-lg shadow hover:bg-blue-700 transition">
                            <i class="fas fa-save mr-2"></i> Update Post
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Post Info -->
            <div class="bg-white shadow rounded-2xl p-5">
                <h3 class="text-md font-semibold text-gray-700 mb-3 flex items-center gap-2">
                    <i class="fas fa-info-circle text-blue-500"></i> Current Post Info
                </h3>
                <p><strong>Title:</strong> <span class="text-gray-600">{{ $post->title }}</span></p>
                <p class="mt-2"><strong>Type:</strong> 
                    <span class="px-2 py-1 text-xs rounded-lg 
                        {{ $post->type === 'text' ? 'bg-blue-100 text-blue-600' : 
                           ($post->type === 'image' ? 'bg-green-100 text-green-600' :
                           ($post->type === 'video' ? 'bg-yellow-100 text-yellow-600' : 'bg-gray-100 text-gray-600')) }}">
                        {{ ucfirst($post->type) }}
                    </span>
                </p>
                <p class="mt-2"><strong>Course:</strong> <span class="text-gray-600">{{ $post->course->name }}</span></p>
                <p class="mt-2"><strong>Created:</strong> <span class="text-gray-600">{{ $post->created_at->format('M d, Y H:i') }}</span></p>
                @if($post->file_path)
                    <p class="mt-2"><strong>Current File:</strong> <span class="text-gray-600">{{ basename($post->file_path) }}</span></p>
                @endif
            </div>

            <!-- Preview -->
            @if($post->file_path)
                <div class="bg-white shadow rounded-2xl p-5">
                    <h3 class="text-md font-semibold text-gray-700 mb-3 flex items-center gap-2">
                        <i class="fas fa-file text-blue-500"></i> Current File Preview
                    </h3>
                    @if($post->type === 'image')
                        <img src="{{ Storage::url($post->file_path) }}" alt="{{ $post->title }}" class="rounded-lg w-full">
                    @elseif($post->type === 'video')
                        <video controls class="rounded-lg w-full max-h-64">
                            <source src="{{ Storage::url($post->file_path) }}" type="video/mp4">
                            Your browser does not support video.
                        </video>
                    @else
                        <p class="text-gray-500 text-sm">File available: <a href="{{ Storage::url($post->file_path) }}" target="_blank" class="text-blue-600 hover:underline">{{ basename($post->file_path) }}</a></p>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
