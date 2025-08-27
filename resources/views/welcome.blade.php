<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - LMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('logo-web.png') }}" type="image/x-icon"> 
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded-2xl shadow-lg text-center max-w-md">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Welcome to LMS</h1>
        <p class="text-gray-600 mb-6">Your Learning Management System</p>

        @auth
            <a href="{{ route('courses.index') }}" 
               class="inline-block px-6 py-3 bg-blue-600 text-white rounded-xl shadow hover:bg-blue-700 transition">
                <i class="fas fa-book mr-2"></i> dashboard
            </a>
        @else
            <a href="{{ route('login') }}" 
               class="inline-block px-6 py-3 bg-green-600 text-white rounded-xl shadow hover:bg-green-700 transition">
                <i class="fas fa-sign-in-alt mr-2"></i> Login
            </a>
            <a href="{{ route('register') }}" 
               class="inline-block px-6 py-3 bg-gray-200 text-gray-800 rounded-xl shadow hover:bg-gray-300 transition ml-4">
                <i class="fas fa-user-plus mr-2"></i> Register
            </a>
        @endauth
    </div>

</body>
</html>
