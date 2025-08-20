@extends('layouts.app')

@section('title', 'Login - LMS Pro')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>

<div class="min-h-screen flex items-center justify-center bg-[#2b2738] p-4">
    <div class="w-full max-w-5xl bg-[#1e1b29] rounded-2xl shadow-2xl overflow-hidden grid grid-cols-1 lg:grid-cols-2">
        
        <!-- Left Side (Image + Branding) -->
        <div class="relative hidden lg:flex flex-col justify-between p-6 bg-gradient-to-b from-[#2b2738] to-[#1e1b29] h-full">
            <div class="absolute inset-0 overflow-hidden rounded-xl">
                <img 
                    src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                    alt="Background" 
                    class="w-full h-full object-cover opacity-30"
                >
            </div>
            <div class="sidebar-header">
                <a href="{{ route('courses.index') }}" class="sidebar-brand">
                    <i class="fa-brands fa-google"></i>
                    <span class="brand-text">Creativy LMS</span>
                </a>
            </div>
            <div class="relative z-10"></div>
            <div class="relative z-10 bottom-10 left-8 text-white">
                <h2 class="text-2xl font-semibold">Welcome Back</h2>
                <p class="text-gray-400 mt-1">Log in to continue your journey</p>
            </div>
        </div>

        <!-- Right Side (Login Form) -->
        <div class="flex items-center justify-center p-8">
            <div class="w-full max-w-md space-y-6">
                <h2 class="text-2xl font-bold text-white">Log in to your account</h2>
                <p class="text-gray-400 text-sm">
                    Don’t have an account? 
                    <a href="{{ route('register') }}" class="text-indigo-400 hover:underline">Sign up</a>
                </p>

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="bg-red-500 text-white p-3 rounded-lg text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('status'))
                    <div class="bg-green-500 text-white p-3 rounded-lg text-sm">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf
                    
                    <!-- Email -->
                    <input type="email" name="email" placeholder="Email" required
                           class="w-full px-4 py-3 rounded-lg bg-[#2b2738] text-gray-200 placeholder-gray-500 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('email') border-red-500 @enderror">

                    @error('email')
                        <p class="text-red-400 text-sm">{{ $message }}</p>
                    @enderror

                    <!-- Password -->
                    <input type="password" name="password" placeholder="Enter your password" required
                           class="w-full px-4 py-3 rounded-lg bg-[#2b2738] text-gray-200 placeholder-gray-500 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('password') border-red-500 @enderror">

                    @error('password')
                        <p class="text-red-400 text-sm">{{ $message }}</p>
                    @enderror

                    <!-- Remember Me + Forgot Password -->
                    <div class="flex items-center justify-between text-sm text-gray-400">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="mr-2 rounded border-gray-600 bg-[#2b2738] focus:ring-indigo-500">
                            Remember me
                        </label>
                        <a href="{{ route('password.request') }}" class="text-indigo-400 hover:underline">Forgot password?</a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                            class="w-full py-3 bg-indigo-500 hover:bg-indigo-600 text-white font-semibold rounded-lg transition">
                        Log in
                    </button>
                </form>

                <!-- Divider -->
                <div class="flex items-center space-x-2">
                    <hr class="flex-grow border-gray-700">
                    <span class="text-gray-500 text-sm">Or log in with</span>
                    <hr class="flex-grow border-gray-700">
                </div>

                <!-- Social Buttons -->
                <div class="flex space-x-3">
                    <a href="#"
                       class="flex items-center justify-center w-full py-3 bg-[#2b2738] text-white rounded-lg border border-gray-700 hover:bg-gray-700 transition">
                        <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" class="w-5 h-5 mr-2"> Google
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
