@extends('layouts.app')

@section('title', 'Register - Creativy LMS')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>

<div class="min-h-screen flex items-center justify-center bg-[#2b2738] p-4">
    <div class="w-full max-w-5xl bg-[#1e1b29] rounded-2xl shadow-2xl overflow-hidden grid grid-cols-1 lg:grid-cols-2">
        
        <!-- Left Side (Image + Branding) -->
        <div class="relative hidden lg:flex flex-col justify-between p-6 bg-gradient-to-b from-[#2b2738] to-[#1e1b29] h-full">
            <div class="absolute inset-0 overflow-hidden rounded-xl">
                <img 
                    src="https://images.unsplash.com/photo-1588702547923-7093a6c3ba33?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                    alt="Background" 
                    class="w-full h-full object-cover opacity-30"
                >
            </div>
            <div class="sidebar-header relative z-10">
                <a href="#" class="sidebar-brand text-white font-bold text-xl flex items-center space-x-2">
                    <img src="{{ asset('logo-web.png') }}" alt="" class="h-8 w-auto">
                    <span class="brand-text">Creativy LMS</span>
                </a>
            </div>
            <div class="relative z-10"></div>
            <div class="relative z-10 bottom-10 left-8 text-white">
                <h2 class="text-2xl font-semibold">Join Creativy LMS</h2>
                <p class="text-gray-400 mt-1">Create an account to get started</p>
            </div>
        </div>

        <!-- Right Side (Register Form) -->
        <div class="flex items-center justify-center p-8">
            <div class="w-full max-w-md space-y-6">
                <h2 class="text-2xl font-bold text-white">Create your account</h2>
                <p class="text-gray-400 text-sm">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-indigo-400 hover:underline">Log in</a>
                </p>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- Hidden role field -->
                    <input type="hidden" name="role" value="user">

                    <!-- Name -->
                    <div>
                        <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required
                               class="w-full px-4 py-3 rounded-lg bg-[#2b2738] text-gray-200 placeholder-gray-500 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required
                               class="w-full px-4 py-3 rounded-lg bg-[#2b2738] text-gray-200 placeholder-gray-500 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <input type="password" name="password" placeholder="Password" required
                               class="w-full px-4 py-3 rounded-lg bg-[#2b2738] text-gray-200 placeholder-gray-500 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <input type="password" name="password_confirmation" placeholder="Confirm Password" required
                               class="w-full px-4 py-3 rounded-lg bg-[#2b2738] text-gray-200 placeholder-gray-500 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @error('password_confirmation')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                            class="w-full py-3 bg-indigo-500 hover:bg-indigo-600 text-white font-semibold rounded-lg transition">
                        Create Account
                    </button>
                </form>

                <!-- Divider -->
                <div class="flex items-center space-x-2">
                    <hr class="flex-grow border-gray-700">
                    <span class="text-gray-500 text-sm">Or sign up with</span>
                    <hr class="flex-grow border-gray-700">
                </div>

                <!-- Social Buttons -->
                <div class="flex space-x-3">
                    <a href="{{ route('google.login') }}"
                       class="flex items-center justify-center w-full py-3 bg-[#2b2738] text-white rounded-lg border border-gray-700 hover:bg-gray-700 transition">
                        <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" class="w-5 h-5 mr-2"> Google
                    </a>
                </div>

                <!-- Info Box
                <div class="text-center text-gray-400 text-sm mt-4">
                    <p class="mb-1">All new accounts are registered as <span class="text-indigo-400">Student</span> by default.</p>
                    <p>Contact admin if you need teacher privileges.</p>
                </div> -->
            </div>
        </div>
    </div>
</div>
@endsection
