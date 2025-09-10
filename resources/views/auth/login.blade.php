@extends('layouts.app')

@section('title', 'Login - Creativy LMS')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>

<style>
/* Bubble Animation */
.bubbles {
  position: absolute;
  width: 100%;
  height: 100%;
  overflow: hidden;
  top: 0;
  left: 0;
  z-index: 0;
}
.bubbles span {
  position: absolute;
  bottom: -150px;
  border-radius: 50%;
  background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.2), rgba(255,255,255,0.05));
  box-shadow: 0 0 20px rgba(255,255,255,0.1);
  backdrop-filter: blur(2px);
  mix-blend-mode: screen;
  animation: bubble 20s linear infinite;
}
.bubbles span:nth-child(1) {
  left: 25%;
  width: 120px; height: 120px;
  animation-duration: 25s;
}
.bubbles span:nth-child(2) {
  left: 10%;
  width: 40px; height: 40px;
  animation-duration: 12s;
  animation-delay: 2s;
}
.bubbles span:nth-child(3) {
  left: 70%;
  width: 70px; height: 70px;
  animation-duration: 15s;
}
.bubbles span:nth-child(4) {
  left: 40%;
  width: 100px; height: 100px;
  animation-duration: 18s;
  animation-delay: 3s;
}
.bubbles span:nth-child(5) {
  left: 65%;
  width: 50px; height: 50px;
  animation-duration: 20s;
  animation-delay: 1s;
}
.bubbles span:nth-child(6) {
  left: 75%;
  width: 180px; height: 180px;
  animation-duration: 30s;
}
.bubbles span:nth-child(7) {
  left: 35%;
  width: 220px; height: 220px;
  animation-duration: 40s;
}
.bubbles span:nth-child(8) {
  left: 50%;
  width: 60px; height: 60px;
  animation-duration: 10s;
  animation-delay: 5s;
}

@keyframes bubble {
  0% {
    transform: translateY(0) scale(1);
    opacity: 0;
  }
  30% {
    opacity: 0.5;
  }
  100% {
    transform: translateY(-1200px) scale(1.8);
    opacity: 0;
  }
}
</style>

<div class="min-h-screen flex items-center justify-center relative overflow-hidden p-4 bg-gradient-to-br from-[#2b2738] via-[#1e1b29] to-[#2b2738]">
    <!-- Bubble Background -->
    <div class="bubbles">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>

    <div class="w-full max-w-5xl bg-[#1e1b29]/60 backdrop-blur-xl rounded-2xl shadow-2xl overflow-hidden grid grid-cols-1 lg:grid-cols-2 relative z-10">
        
        <!-- Left Side -->
        <div class="relative hidden lg:flex flex-col justify-between p-6 bg-gradient-to-b from-[#2b2738] to-[#1e1b29] h-full">
            <div class="absolute inset-0 overflow-hidden rounded-xl">
                <img 
                    src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0" 
                    alt="Background" 
                    class="w-full h-full object-cover opacity-20"
                >
            </div>
            <div class="sidebar-header relative z-10">
                <a href="#" class="sidebar-brand text-white font-bold text-xl flex items-center space-x-2">
                    <img src="{{ asset('logo-web.png') }}" alt="" class="h-8 w-auto">
                    <span class="brand-text">Creativy LMS</span>
                </a>
            </div>
            <div class="relative z-10 bottom-10 left-8 text-white">
                <h2 class="text-2xl font-semibold">Welcome Back</h2>
                <p class="text-gray-400 mt-1">Log in to continue your journey</p>
            </div>
        </div>

        <!-- Right Side (Login Form) -->
        <div class="flex items-center justify-center p-8">
            <div class="w-full max-w-md space-y-6">
                <a href="{{ route('home') }}" class="text-white">
                  <i class="fas fa-arrow-left text-white"></i> Back To Home
                </a>
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
                           class="w-full px-4 py-3 rounded-lg bg-[#2b2738]/80 text-gray-200 placeholder-gray-500 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('email') border-red-500 @enderror">

                    <!-- Password -->
                    <input type="password" name="password" placeholder="Enter your password" required
                           class="w-full px-4 py-3 rounded-lg bg-[#2b2738]/80 text-gray-200 placeholder-gray-500 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('password') border-red-500 @enderror">

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
                    <a href="{{ route('google.login') }}"
                       class="flex items-center justify-center w-full py-3 bg-[#2b2738] text-white rounded-lg border border-gray-700 hover:bg-gray-700 transition">
                        <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" class="w-5 h-5 mr-2"> Google
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
