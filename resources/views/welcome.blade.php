<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creativy LMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('logo-web.png') }}" type="image/x-icon"> 
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-indigo-600 to-blue-500 text-white py-20">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Welcome to <span class="text-yellow-300">Creativy LMS</span></h1>
            <p class="text-lg md:text-xl mb-8">Your modern Learning Management System for courses, materials, and collaboration.</p>
            
            @auth
                <a href="{{ route('courses.index') }}" 
                   class="inline-block px-8 py-3 bg-yellow-400 text-gray-900 font-semibold rounded-xl shadow hover:bg-yellow-300 transition">
                    <i class="fas fa-book mr-2"></i> Go to Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" 
                   class="inline-block px-8 py-3 bg-white text-indigo-600 font-semibold rounded-xl shadow hover:bg-gray-100 transition">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </a>
                <a href="{{ route('register') }}" 
                   class="inline-block px-8 py-3 bg-yellow-400 text-gray-900 font-semibold rounded-xl shadow hover:bg-yellow-300 transition ml-4">
                    <i class="fas fa-user-plus mr-2"></i> Register
                </a>
            @endauth
        </div>
    </section>

    <!-- Classes Section -->
    <section class="py-16">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-2xl font-bold text-center mb-10">Available Classes</h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @forelse($courses as $course)
                    <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition">
                        <h3 class="text-lg font-semibold text-indigo-600 mb-2">{{ $course->name }}</h3>
                        <p class="text-gray-600 text-sm mb-4">
                            {{ Str::limit($course->description, 100) }}
                        </p>
                        <a href="{{ route('courses.show', $course) }}" 
                           class="inline-block text-sm text-white bg-indigo-600 px-4 py-2 rounded-lg hover:bg-indigo-700">
                           View Class
                        </a>
                    </div>
                @empty
                    <p class="text-center text-gray-500 col-span-3">No classes available yet.</p>
                @endforelse
            </div>
        </div>
    </section>

    <footer class="bg-gray-100 py-6 text-center">
        <a href="https://lms.sekolahadvertiser.com/privacy-policy"
           class="text-blue-600 hover:text-blue-800 hover:underline">
           Privacy Policy
        </a>
    </footer>


    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
</body>

</html>
