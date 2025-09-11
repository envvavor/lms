<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelas - Creativy LMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('logo-web.png') }}" type="image/x-icon"> 
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
        }
        .class-card {
            transition: all 0.3s ease;
            border-radius: 16px;
            overflow: hidden;
            background: white;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }
        .class-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.12);
        }
        .checkbox-custom {
            appearance: none;
            -webkit-appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #d1d5db;
            border-radius: 5px;
            outline: none;
            cursor: pointer;
            position: relative;
            margin-right: 12px;
            flex-shrink: 0;
        }
        .checkbox-custom:checked {
            background-color: #10b981;
            border-color: #10b981;
        }
        .checkbox-custom:checked::before {
            content: "✓";
            position: absolute;
            color: white;
            font-size: 14px;
            font-weight: bold;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .class-badge {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
        }
        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #e5e7eb, transparent);
            margin: 1rem 0;
        }
        .time-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        .instructor-badge {
            background-color: #fef3c7;
            color: #92400e;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        .detail-button {
            background: linear-gradient(to right, #3b82f6, #2563eb);
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-block;
        }
        .detail-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(37, 99, 235, 0.25);
        }
        .section-title {
            position: relative;
            display: inline-block;
            padding-bottom: 0.5rem;
        }
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: linear-gradient(to right, #f9a400, #ff6b00);
            border-radius: 2px;
        }
        .card-header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            padding: 1rem;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
        }
    </style>
</head>
<body class="min-h-screen">


    <!-- Kelas Section -->
    <section class="max-w-6xl mx-auto px-4 md:px-8 py-16">
        <div class="bg-gradient-to-br from-gray-800 via-gray-900 to-black rounded-3xl p-8 md:p-12 shadow-2xl">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-4 section-title mx-auto">Kelas</h2>
                <p class="text-gray-300 text-lg max-w-3xl mx-auto mt-6">Daftar kelas pelatihan terbaru yang akan segera dimulai. Segera daftar sebelum kehabisan seat!</p>
            </div>
            <!-- Container untuk kartu kelas -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($courses as $course)
                    <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition"
                        data-aos="fade-up"
                        data-aos-delay="{{ $loop->index * 100 }}"
                        data-aos-duration="1000">
                        
                        <h3 class="text-lg font-semibold text-black mb-2">{{ $course->name }}</h3>
                        <p class="text-gray-600 text-sm mb-4">
                            {{ Str::limit($course->description, 100) }}
                        </p>
                        <a href="{{ route('courses.show', $course) }}" 
                        class="inline-block text-sm text-white bg-yellow-500 px-4 py-2 rounded-lg hover:bg-yellow-700">
                        View Class
                        </a>
                    </div>
                @empty
                    <p class="text-center text-gray-500 col-span-3">No classes available yet.</p>
                @endforelse

            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer class="bg-black py-8 mt-12 border-t border-gray-700">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-center md:text-left mb-4 md:mb-0">
                    <div class="text-2xl font-extrabold text-[#f9a400] flex justify-center md:justify-start items-center">
                        <img src="/images/logo-white.png" alt="" class="max-h-5 sm:max-h-8 mr-2">
                    </div>
                    <p class="text-gray-400 text-sm mt-1">© 2025 Creativy LMS. All rights reserved.</p>
                </div>
                <ul class="flex flex-wrap justify-center md:justify-end space-x-6 md:space-x-8 text-sm font-medium">
                    <li><a href="/" class="text-gray-300 hover:text-[#f9a400] transition flex items-center"><i class="fas fa-home mr-1 text-sm"></i> Beranda</a></li>
                    <li><a href="/tentang" class="text-gray-300 hover:text-[#f9a400] transition flex items-center"><i class="fas fa-info-circle mr-1 text-sm"></i> Tentang</a></li>
                    <li><a href="/kelas" class="text-[#f9a400] font-bold flex items-center"><i class="fas fa-chalkboard-teacher mr-1 text-sm"></i> Kelas</a></li>
                    <li><a href="/lokasi" class="text-gray-300 hover:text-[#f9a400] transition flex items-center"><i class="fas fa-map-marker-alt mr-1 text-sm"></i> Lokasi</a></li>
                    <li><a href="/galeri_kami" class="text-gray-300 hover:text-[#d68d00] transition flex items-center"><i class="fas fa-images mr-1 text-sm"></i> Galeri Kami</a></li>
                </ul>
            </div>
        </div>
    </footer>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
    AOS.init();
    </script>

</body>
</html>