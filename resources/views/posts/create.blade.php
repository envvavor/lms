@extends('layouts.app')

@section('title', 'Create Post - ' . $course->name)

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
            <li><span class="mx-1">/</span>
                <a href="{{ route('courses.show', $course) }}" class="hover:text-blue-600">
                    {{ $course->name }}
                </a>
            </li>
            <li><span class="mx-1">/</span>
                <span class="text-gray-400">Create Post</span>
            </li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-plus text-blue-500"></i>
                Create New Post
            </h1>
            <p class="text-gray-500 mt-1">Add a new post to course: {{ $course->name }}</p>
        </div>
        <a href="{{ route('courses.show', $course) }}" 
           class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 border rounded-lg text-gray-700 border-gray-300 hover:bg-gray-100 transition">
            <i class="fas fa-arrow-left mr-2"></i> Back to Course
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Form -->
        <div class="lg:col-span-2">
            <div class="bg-white shadow rounded-2xl p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-4 flex items-center gap-2">
                    <i class="fas fa-file-alt text-blue-500"></i> Post Details
                </h2>

                <form id="createPostForm" action="{{ route('posts.store', $course) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-heading mr-1"></i> Post Title
                        </label>
                        <input type="text" id="title" name="title"
                               class="p-2 w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror"
                               value="{{ old('title') }}" required placeholder="Enter post title...">
                        @error('title')
                            <p class="text-sm text-red-600 mt-1 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Content -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-align-left mr-1"></i> Content (optional)
                        </label>
                        <textarea id="content" name="content" rows="6"
                                  class="p-2 w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('content') border-red-500 @enderror"
                                  placeholder="Write something...">{{ old('content') }}</textarea>
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
                            <i class="fas fa-info-circle mr-1"></i> Supported formats: images, videos, documents.
                        </p>
                    </div>

                    <!-- Link -->
                    <div>
                        <label for="link" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-link mr-1"></i> YouTube/Drive Link
                        </label>
                        <input type="url" name="link" id="link"
                               class="p-2 w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('link') }}" placeholder="https://...">
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-between items-center pt-4">
                        <a href="{{ route('courses.show', $course) }}" 
                           class="inline-flex items-center px-4 py-2 border rounded-lg text-gray-700 border-gray-300 hover:bg-gray-100 transition">
                            <i class="fas fa-times mr-2"></i> Cancel
                        </a>
                        <button id="submitBtn" type="submit"
                                class="inline-flex items-center px-5 py-2 bg-blue-600 text-white font-medium rounded-lg shadow hover:bg-blue-700 transition">
                            <i class="fas fa-save mr-2"></i> Create Post
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <div class="bg-white shadow rounded-2xl p-5">
                <h3 class="text-md font-semibold text-gray-700 mb-3 flex items-center gap-2">
                    <i class="fas fa-info-circle text-blue-500"></i> Course Information
                </h3>
                <p><strong>Course:</strong> <span class="text-gray-600">{{ $course->name }}</span></p>
                <p class="mt-2"><strong>Description:</strong> <span class="text-gray-600">{{ $course->description ?: 'No description' }}</span></p>
                <p class="mt-2"><strong>Created by:</strong> <span class="text-gray-600">{{ $course->user->name }}</span></p>
                <p class="mt-2"><strong>Total posts:</strong> <span class="text-gray-600">{{ $course->posts->count() }}</span></p>
            </div>
            <div class="bg-white shadow rounded-2xl p-5">
                <h3 class="text-md font-semibold text-gray-700 mb-3 flex items-center gap-2">
                    <i class="fas fa-lightbulb text-blue-500"></i> Tip
                </h3>
                <p class="text-sm text-gray-600">
                    You can write text content, upload a file, or combine both for richer posts.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Fullscreen Loading -->
<div id="loadingOverlay" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-2xl shadow-lg flex flex-col items-center">
        <svg class="animate-spin h-10 w-10 text-blue-600 mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
        </svg>
        <p class="text-gray-700 font-medium">Creating post, please wait...</p>
    </div>
</div>

<script>
    const form = document.getElementById('createPostForm');
    const btn = document.getElementById('submitBtn');
    const overlay = document.getElementById('loadingOverlay');

    form.addEventListener('submit', function() {
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Processing...';
        overlay.classList.remove('hidden');
    });
</script>
@endsection
