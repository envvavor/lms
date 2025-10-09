<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creativy LMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="{{ asset('logo-web.png') }}" type="image/x-icon">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }
        .hero-bg {
            background: linear-gradient(180deg, #f9f5e9 0%, #ffffff 100%);
        }
        .stat-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .cta-button {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(249, 164, 0, 0.2);
        }
        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(249, 164, 0, 0.3);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-white to-gray-100 text-gray-900 min-h-screen">

    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-black/90 backdrop-blur shadow-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-4">
            <div class="px-4 py-2 rounded-xl font-extrabold text-lg tracking-wider shadow flex items-center">
                <img src="/images/logo-white.png" alt="" class="max-h-5 sm:max-h-8 mr-2">
            </div>
            <!-- Desktop Menu -->
            <ul class="hidden md:flex space-x-8 font-medium">
                <li><a href="/" class="text-[#f9a400] transition py-2">Beranda</a></li>
                <li><a href="/tentang" class="text-white hover:text-[#f9a400] transition py-2">Tentang</a></li>
                <li><a href="/kelas" class="text-white hover:text-[#f9a400] transition py-2">Kelas</a></li>
                <li><a href="/lokasi" class="text-white hover:text-[#f9a400] transition py-2">Lokasi</a></li>
                <li><a href="/galeri_kami" class="text-white hover:text-[#f9a400] transition py-2">Galeri Kami</a></li>
            </ul>
            @auth
                <a href="{{route('courses.index') }}" class="cta-button bg-[#f9a400] hover:bg-[#e59400] text-white px-5 py-2 rounded-xl font-semibold shadow transition hidden md:inline-block">Dashboard</a>
            @else
                <a href="{{route('login') }}" class="cta-button bg-[#f9a400] hover:bg-[#e59400] text-white px-5 py-2 rounded-xl font-semibold shadow transition hidden md:inline-block">Login</a>
            @endauth
            <!-- Hamburger Button -->
            <button id="menu-btn" class="md:hidden text-white text-2xl focus:outline-none">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden hidden bg-black/95 px-6 pb-4 transition-all duration-300 ease-in-out">
            <ul class="flex flex-col space-y-3 font-medium">
                <li><a href="/" class="text-white hover:text-[#f9a400] transition block py-2">Beranda</a></li>
                <li><a href="/tentang" class="text-white hover:text-[#f9a400] transition block py-2">Tentang</a></li>
                <li><a href="/kelas" class="text-white hover:text-[#f9a400] transition block py-2">Kelas</a></li>
                <li><a href="/lokasi" class="text-white hover:text-[#f9a400] transition block py-2">Lokasi</a></li>
                <li><a href="/galeri_kami" class="text-white hover:text-[#f9a400] transition block py-2">Galeri Kami</a></li>
                <li>
                    @auth
                        <a href="{{ route('courses.index') }}" class="cta-button bg-[#f9a400] hover:bg-[#e59400] text-white px-5 py-2 rounded-xl font-semibold shadow transition block text-center mt-4">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="cta-button bg-[#f9a400] hover:bg-[#e59400] text-white px-5 py-2 rounded-xl font-semibold shadow transition block text-center mt-4">Login</a>
                    @endauth
                </li>
            </ul>
        </div>
        <script>
            // Mobile menu toggle
            const btn = document.getElementById('menu-btn');
            const menu = document.getElementById('mobile-menu');
            btn.onclick = () => {
                menu.classList.toggle('hidden');
            };
            
            // Close menu when clicking outside
            document.addEventListener('click', (e) => {
                if (!menu.classList.contains('hidden') && !btn.contains(e.target) && !menu.contains(e.target)) {
                    menu.classList.add('hidden');
                }
            });
        </script>
    </nav>

    <!-- Hero Section -->
    <section class="hero-bg">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center px-6 py-16 md:py-24">
            <div  data-aos="fade-right" data-aos-duration="1000" class="order-2 md:order-1">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight mb-6 text-black">
                    Kuasai Seni <span class="text-[#f9a400]">Iklan Digital</span> dengan Ahli Di <span class="text-[#f9a400]">Creativy LMS</span>
                </h1>
                <p class="text-gray-700 text-lg mb-8 leading-relaxed">
                    Pelajari strategi terbaru Facebook Ads, Instagram Ads, Customer Service, dan Shopee Ads langsung dari praktisi berpengalaman. Tingkatkan ROI bisnis Anda dengan teknik yang terbukti efektif.
                </p>

            </div>
            <div data-aos="zoom-in" data-aos-duration="1000" class="order-1 md:order-2 flex justify-center">
                <div class="relative">
                    <div class="absolute -inset-4 bg-[#f9a400] rounded-2xl rotate-3 opacity-20 shadow-xl border-white"></div>
                    <img src="/images/7.png" alt="Pelatihan Iklan Digital" class="relative w-full max-w-md rounded-2xl shadow-xl">
                </div>
            </div>
        </div>
    </section>

    <!-- Statistik Section -->
    <section class="max-w-7xl mx-auto px-4 md:px-8 py-16">
        <div data-aos="fade-up" data-aos-duration="1000" class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Telah Dipercaya oleh Ratusan Peserta</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Bergabunglah dengan komunitas pembelajar yang telah sukses mengimplementasikan strategi iklan digital</p>
        </div>
        
        <div data-aos="fade-up" data-aos-duration="1500" class="bg-gray-800 rounded-3xl p-6 md:p-10 shadow-inner">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="stat-card bg-white/95 rounded-2xl p-8 text-center shadow hover:shadow-xl border border-gray-300">
                    <div class="text-4xl md:text-5xl font-extrabold text-black mb-2 tracking-tight">500+</div>
                    <div class="text-gray-700 text-base md:text-lg font-medium">Peserta Belajar<br><span class="text-[#f9a400] font-semibold">Facebook Ads</span></div>
                </div>
                <div class="stat-card bg-white/95 rounded-2xl p-8 text-center shadow hover:shadow-xl border border-gray-300">
                    <div class="text-4xl md:text-5xl font-extrabold text-black mb-2 tracking-tight">400+</div>
                    <div class="text-gray-700 text-base md:text-lg font-medium">Peserta Belajar<br><span class="text-[#f9a400] font-semibold">Instagram Ads</span></div>
                </div>
                <div class="stat-card bg-white/95 rounded-2xl p-8 text-center shadow hover:shadow-xl border border-gray-300">
                    <div class="text-4xl md:text-5xl font-extrabold text-black mb-2 tracking-tight">350+</div>
                    <div class="text-gray-700 text-base md:text-lg font-medium">Peserta Belajar<br><span class="text-[#f9a400] font-semibold">Customer Service</span></div>
                </div>
                <div class="stat-card bg-white/95 rounded-2xl p-8 text-center shadow hover:shadow-xl border border-gray-300">
                    <div class="text-4xl md:text-5xl font-extrabold text-black mb-2 tracking-tight">200+</div>
                    <div class="text-gray-700 text-base md:text-lg font-medium">Peserta Belajar<br><span class="text-[#f9a400] font-semibold">Shopee Ads</span></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="max-w-7xl mx-auto px-4 md:px-8 py-16">
        <div data-aos="fade-up" data-aos-duration="100" class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Keunggulan Pelatihan Kami</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Alasan mengapa ratusan peserta memilih program pelatihan kami</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div data-aos="fade-up" data-aos-duration="100" class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition">
                <div class="w-14 h-14 bg-[#f9a400]/20 rounded-xl flex items-center justify-center mb-4">
                    <i class="fas fa-chalkboard-teacher text-2xl text-[#f9a400]"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Instruktur Berpengalaman</h3>
                <p class="text-gray-600">Diajar oleh praktisi yang telah berkecimpung di industri digital marketing selama bertahun-tahun</p>
            </div>
            
            <div data-aos="fade-up" data-aos-duration="200" class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition">
                <div class="w-14 h-14 bg-[#f9a400]/20 rounded-xl flex items-center justify-center mb-4">
                    <i class="fas fa-hands-helping text-2xl text-[#f9a400]"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Pendampingan Langsung</h3>
                <p class="text-gray-600">Pendampingan hingga bisa dengan konsultasi pasca pelatihan untuk memastikan keberhasilan</p>
            </div>
            
            <div data-aos="fade-up" data-aos-duration="300" class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition">
                <div class="w-14 h-14 bg-[#f9a400]/20 rounded-xl flex items-center justify-center mb-4">
                    <i class="fas fa-book-open text-2xl text-[#f9a400]"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Materi Terupdate</h3>
                <p class="text-gray-600">Kurikulum selalu disesuaikan dengan perkembangan terbaru platform iklan dan algoritma</p>
            </div>
            
            <div data-aos="fade-up" data-aos-duration="400" class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition">
                <div class="w-14 h-14 bg-[#f9a400]/20 rounded-xl flex items-center justify-center mb-4">
                    <i class="fas fa-laptop-code text-2xl text-[#f9a400]"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Praktik Langsung</h3>
                <p class="text-gray-600">Belajar dengan studi kasus nyata dan praktik langsung mengelola kampanye iklan</p>
            </div>
            
            <div data-aos="fade-up" data-aos-duration="500" class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition">
                <div class="w-14 h-14 bg-[#f9a400]/20 rounded-xl flex items-center justify-center mb-4">
                    <i class="fas fa-users text-2xl text-[#f9a400]"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Komunitas Eksklusif</h3>
                <p class="text-gray-600">Akses ke grup komunitas untuk berjejaring dan berbagi pengalaman dengan sesama peserta</p>
            </div>
            
            <div data-aos="fade-up" data-aos-duration="600" class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition">
                <div class="w-14 h-14 bg-[#f9a400]/20 rounded-xl flex items-center justify-center mb-4">
                    <i class="fas fa-certificate text-2xl text-[#f9a400]"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Sertifikat Penyelesaian</h3>
                <p class="text-gray-600">Dapatkan sertifikat yang dapat meningkatkan kredibilitas Anda di dunia digital marketing</p>
            </div>
        </div>
    </section>
    <footer class="bg-black text-white text-center p-4">
        <a href="https://creativy-class.biz.id/privacy-policy">Privacy policy</a>
    </footer>
    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    
</body>

</html>