@extends('layouts.app')

@section('title', 'Create Course')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<div class="max-w-2xl mx-auto p-6">
    <div class="bg-white shadow rounded-2xl p-6">
        <h2 class="text-xl font-semibold mb-4 flex items-center gap-2">
            <i class="fas fa-plus text-indigo-500"></i>
            Create New Course
        </h2>

        <form id="create-course-form" action="{{ route('courses.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Course Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Course Name</label>
                <input type="text" id="name" name="name"
                       value="{{ old('name') }}"
                       class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('name') border-red-500 @enderror"
                       required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" rows="4"
                          class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Price (Rp.)</label>
                <input type="number" id="price" name="price"
                       value="{{ old('price') }}"
                       class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('price') border-red-500 @enderror"
                       min="0" required>
                @error('price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex justify-between items-center">
                <a href="{{ route('courses.index') }}"
                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-700 bg-white hover:bg-gray-50">
                    <i class="fas fa-arrow-left mr-2"></i> Back
                </a>

                <button type="submit" id="submit-btn"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="animate-spin h-4 w-4 mr-2 text-white hidden" id="btn-spinner" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 00-8 8h4z"></path>
                    </svg>
                    <i class="fas fa-save mr-2"></i>
                    Create Course
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Fullscreen Loading Overlay -->
<div id="loading-overlay" class="fixed inset-0 bg-white/70 hidden items-center justify-center z-50">
    <div class="flex flex-col items-center">
        <svg class="animate-spin h-10 w-10 text-indigo-600 mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 00-8 8h4z"></path>
        </svg>
        <p class="text-sm text-gray-600">Creating course...</p>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('create-course-form').addEventListener('submit', function () {
    // Show overlay
    document.getElementById('loading-overlay').classList.remove('hidden');
    document.getElementById('loading-overlay').classList.add('flex');

    // Disable button + show spinner
    let btn = document.getElementById('submit-btn');
    btn.disabled = true;
    document.getElementById('btn-spinner').classList.remove('hidden');
});
</script>
@endpush
