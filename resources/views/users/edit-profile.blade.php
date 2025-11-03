@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>

<div class="container mx-auto mt-5 p-6 bg-white rounded shadow-md max-w-lg">
    <h2 class="text-2xl font-bold mb-4">Edit Your Profile</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-3">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('name')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('email')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">New Password (optional)</label>
            <input type="password" name="password" 
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('password')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation" 
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('profile') }}" class="text-gray-600 hover:underline">Cancel</a>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
