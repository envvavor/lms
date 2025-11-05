@extends('layouts.app')

@section('title', 'All Courses')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<div class="m-3 sm:m-5">

<div class="bg-white shadow-sm border-b border-gray-200 px-6 py-6 rounded-lg mb-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-book-open text-gray-800"></i>
                All Courses Available
            </h1>
            <p class="text-gray-500 mt-1">Join Our Class To Explore your learning journey</p>
        </div>
    </div>
</div>
<div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3 ">
        @foreach($courses as $course)
            <div class="group bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 flex flex-col border border-gray-100">
                <!-- Card Header with Gradient Background -->
                <div class="relative bg-gradient-to-br from-[#2b2738] to-[#2f2c3b] px-6 py-4 overflow-hidden rounded-2xl">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <h5 class="text-xl font-bold text-white mb-1 flex items-center gap-3">
                                <div class="p-2 bg-white/20 rounded-lg backdrop-blur-sm">
                                    <i class="fas fa-graduation-cap text-white"></i>
                                </div>
                                {{ $course->name }}
                            </h5>
                            <div class="text-indigo-100 text-sm font-medium">
                                <i class="fas fa-user mr-1"></i> {{ $course->user->name }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-6 flex-1 flex flex-col">
                    <p class="text-gray-600 mb-6 leading-relaxed line-clamp-3">{{ Str::limit($course->description, 120) }}</p>

                    <!-- Stats Grid -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-gray-50 rounded-lg p-3 text-center border border-gray-100">
                            <div class="text-2xl font-bold text-indigo-600">{{ $course->posts->count() }}</div>
                            <div class="text-xs text-gray-500 font-medium">
                                <i class="fas fa-file-alt mr-1"></i> Posts
                            </div>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-3 text-center border border-gray-100">
                            <div class="text-2xl font-bold text-green-600">{{ $course->enrollments->count() }}</div>
                            <div class="text-xs text-gray-500 font-medium">
                                <i class="fas fa-users mr-1"></i> Students
                            </div>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-3 text-center border border-gray-100 col-span-2">
                            <div class="text-2xl font-bold text-yellow-600">
                                @if($course->price > 0)
                                    Rp. {{ number_format($course->price, 2) }}
                                @else
                                    Free
                                @endif
                            </div>
                            <div class="text-xs text-gray-500 font-medium">
                                <i class="fas fa-tag mr-1"></i> Price
                            </div>
                        </div>
                    </div>

                    <!-- Course Info -->
                    <div class="mt-auto">
                        <div class="flex items-center justify-between text-sm text-gray-500 bg-gray-50 rounded-lg px-3 py-2 border border-gray-100">
                            <span class="flex items-center">
                                <i class="fas fa-calendar mr-2 text-indigo-500"></i> 
                                <p class="mr-1">Created at</p>
                                {{ $course->created_at->format('d M, Y') }}
                            </span>
                            <div class="w-2 h-2 bg-indigo-300 rounded-full"></div>
                        </div>
                    </div>
                </div>

                <!-- Card Footer -->
                <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-100">
                    <div class="flex justify-between items-center gap-3">
                        <!-- <a href="{{ route('courses.show', $course) }}" 
                           class="flex-1 text-center px-4 py-2.5 text-sm bg-[#2b2738] hover:bg-[#33303d] text-white rounded-xl font-medium transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <i class="fas fa-eye mr-2"></i> View Course
                        </a> -->
                        @auth
                            @if(Auth::user()->isUser())
                                @if(Auth::user()->enrolledCourses()->where('course_id', $course->id)->exists())
                                    <!-- <form action="{{ route('enrollments.unenroll', $course) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit" 
                                                class="w-full px-4 py-2.5 text-sm border-2 border-red-200 text-red-600 rounded-xl hover:bg-red-50 hover:border-red-300 font-medium transition-all duration-200 transform hover:scale-105">
                                            <i class="fas fa-user-times mr-2"></i> Unenroll
                                        </button>
                                    </form> -->
                                    <button type="" 
                                            class="w-full px-4 py-2.5 text-sm border-2 border-green-200 text-green-500 rounded-xl  font-medium hover:cursor-not-allowed">
                                        <i class="fas fa-thumb mr-2"></i> You Are Already Joined
                                    </button>
                                @else
                                    <form action="{{ route('enrollments.enroll', $course) }}" method="POST" class="flex-1 enroll-form">
                                        @csrf
                                        <!-- If you want to perform a server-side enroll, change this anchor to a submit button. -->
                                        <a href="https://api.whatsapp.com/send?phone=6281353025302&text={{ rawurlencode('Permisi kak saya mau masuk ke kelas '. $course->name . ', mohon dibimbing') }}" target="_blank"
                                           class="w-full inline-flex justify-center items-center px-4 py-2.5 text-sm bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white rounded-xl font-medium transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                            <i class="fas fa-user-plus mr-2"></i>
                                            Join Now
                                        </a>
                                    </form>
                                @endif
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
