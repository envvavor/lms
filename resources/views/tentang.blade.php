<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Pelatihan Iklan Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .main-content {
            flex: 1;
        }
        
        .hero-section {
            background: linear-gradient(120deg, #1a1a1a 0%, #2d2d2d 100%);
            color: white;
            padding: 5rem 0 4rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23f9a400' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.3;
        }
        
        .hero-content {
            position: relative;
            z-index: 10;
        }
        
        .stat-card {
            transition: all 0.3s ease;
            border-radius: 20px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            position: relative;
            height: 100%;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(to right, #f9a400, #ff6b00);
            border-radius: 4px 4px 0 0;
        }
        
        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }
        
        .about-section {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
            margin-top: -50px;
        }
        
        .about-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: radial-gradient(circle, rgba(249, 164, 0, 0.05) 0%, transparent 70%);
            z-index: 0;
        }
        
        .highlight-text {
            background: linear-gradient(135deg, #f9a400, #ff6b00);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
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
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(to right, #f9a400, #ff6b00);
            border-radius: 2px;
        }
        
        .icon-container {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #fff3cd, #ffedab);
            border-radius: 16px;
            margin-bottom: 1rem;
        }
        
        .stat-number {
            background: linear-gradient(135deg, #1e293b, #334155);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 800;
        }
        
        .about-image {
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
            transition: all 0.5s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .about-image:hover {
            transform: scale(1.03);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }
        
        .accent-divider {
            height: 4px;
            width: 80px;
            background: #f9a400;
            margin: 1rem auto;
            border-radius: 2px;
        }
        
        .value-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid #f0f0f0;
        }
        
        .value-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border-color: #f9a400;
        }
        
        .value-icon {
            background: linear-gradient(135deg, #fff3cd, #ffedab);
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }
        
        .team-member {
            text-align: center;
            padding: 1.5rem;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        
        .team-member:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
        
        .team-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 1rem;
            border: 4px solid #f0f0f0;
        }
        
        .client-section {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 3rem 2rem;
            margin: 3rem 0;
        }
        
        .client-logo {
            height: 80px;
            width: auto;
            object-fit: contain;
            transition: all 0.3s ease;
            filter: grayscale(100%);
            opacity: 0.7;
        }
        
        .client-logo:hover {
            filter: grayscale(0%);
            opacity: 1;
            transform: scale(1.05);
        }
        
        .client-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 2rem;
            align-items: center;
            justify-items: center;
        }
        
        @media (max-width: 768px) {
            .hero-section {
                padding: 3rem 0 2rem;
            }
            
            .about-section {
                margin-top: -30px;
            }
            
            .icon-container {
                width: 50px;
                height: 50px;
            }
            
            .client-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
            }
            
            .client-logo {
                height: 60px;
            }
        }
    </style>
</head>
<body>
    <div class="main-content">
        
        <!-- Statistik Section -->
        <section class="max-w-6xl mx-auto px-4 md:px-8 py-12">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-4 section-title mx-auto">Pencapaian Kami</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">Berikut adalah statistik peserta yang telah bergabung dan sukses dengan program pelatihan kami</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="stat-card p-6 text-center">
                    <div class="icon-container mx-auto">
                        <svg class="w-6 h-6 text-[#f9a400]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="text-4xl md:text-5xl font-extrabold stat-number mb-2">500+</div>
                    <div class="text-gray-700 text-base font-medium">Peserta Belajar<br><span class="text-[#f9a400] font-semibold">Facebook Ads</span></div>
                </div>
                
                <div class="stat-card p-6 text-center">
                    <div class="icon-container mx-auto">
                        <svg class="w-6 h-6 text-[#f9a400]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                        </svg>
                    </div>
                    <div class="text-4xl md:text-5xl font-extrabold stat-number mb-2">400+</div>
                    <div class="text-gray-700 text-base font-medium">Peserta Belajar<br><span class="text-[#f9a400] font-semibold">Instagram Ads</span></div>
                </div>
                
                <div class="stat-card p-6 text-center">
                    <div class="icon-container mx-auto">
                        <svg class="w-6 h-6 text-[#f9a400]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/>
                        </svg>
                    </div>
                    <div class="text-4xl md:text-5xl font-extrabold stat-number mb-2">350+</div>
                    <div class="text-gray-700 text-base font-medium">Peserta Belajar<br><span class="text-[#f9a400] font-semibold">Customer Service</span></div>
                </div>
                
                <div class="stat-card p-6 text-center">
                    <div class="icon-container mx-auto">
                        <svg class="w-6 h-6 text-[#f9a400]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                        </svg>
                    </div>
                    <div class="text-4xl md:text-5xl font-extrabold stat-number mb-2">200+</div>
                    <div class="text-gray-700 text-base font-medium">Peserta Belajar<br><span class="text-[#f9a400] font-semibold">Shopee Ads</span></div>
                </div>
            </div>
        </section>

        <!-- Tentang Kami Section -->
        <section class="max-w-6xl mx-auto px-4 md:px-8 py-12">
            <div class="about-section p-8 md:p-12 flex flex-col md:flex-row items-center gap-10">
                <div class="flex-1 space-y-6 relative z-10">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="icon-container">
                            <svg class="w-6 h-6 text-[#f9a400]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800">Tentang Kami</h2>
                    </div>
                    <p class="text-gray-700 text-lg leading-relaxed">
                        Kami adalah lembaga pelatihan digital yang berfokus pada pengembangan skill pemasaran online, khususnya <span class="highlight-text">Facebook Ads</span>, <span class="highlight-text">Instagram Ads</span>, <span class="highlight-text">Customer Service</span>, dan <span class="highlight-text">Shopee Ads</span>.
                    </p>
                    <p class="text-gray-600 text-base leading-relaxed">
                        Dengan pengalaman bertahun-tahun dan instruktur profesional, kami siap membantu Anda meningkatkan penjualan dan membangun brand secara efektif di era digital. Metode pembelajaran kami dirancang praktis dan aplikatif, langsung dapat diterapkan untuk bisnis Anda.
                    </p>
                    
                    <div class="pt-4">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-gray-600">Kurikulum berbasis industri dengan studi kasus nyata</p>
                        </div>
                        
                        <div class="flex items-start space-x-4 mt-3">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-gray-600">Instruktur praktisi dengan pengalaman lebih dari 5 tahun</p>
                        </div>
                        
                        <div class="flex items-start space-x-4 mt-3">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-gray-600">Support pasca pelatihan dan komunitas alumni</p>
                        </div>
                    </div>
                </div>
                <div class="flex-1 flex justify-center relative z-10">
                    <div class="relative">
                        <img src="/images/megafon.png" alt="Tentang Kami" class="about-image w-full max-w-md">
                        <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-[#f9a400] rounded-2xl opacity-20 -z-10"></div>
                        <div class="absolute -top-4 -left-4 w-16 h-16 bg-[#ff6b00] rounded-xl opacity-20 -z-10"></div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Nilai-Nilai Kami Section -->
        <section class="max-w-6xl mx-auto px-4 md:px-8 py-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-4 section-title mx-auto">Nilai-Nilai Kami</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">Prinsip-prinsip yang menjadi pedoman dalam setiap program pelatihan kami</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="value-card">
                    <div class="value-icon mx-auto">
                        <svg class="w-8 h-8 text-[#f9a400]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-center mb-3">Inovasi Terus Menerus</h3>
                    <p class="text-gray-600 text-center">Selalu mengupdate materi sesuai perkembangan terbaru di dunia pemasaran digital</p>
                </div>
                
                <div class="value-card">
                    <div class="value-icon mx-auto">
                        <svg class="w-8 h-8 text-[#f9a400]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-center mb-3">Komunitas Kolaboratif</h3>
                    <p class="text-gray-600 text-center">Membangun jaringan profesional yang saling mendukung dan berkolaborasi</p>
                </div>
                
                <div class="value-card">
                    <div class="value-icon mx-auto">
                        <svg class="w-8 h-8 text-[#f9a400]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-center mb-3">Pembelajaran Praktis</h3>
                    <p class="text-gray-600 text-center">Fokus pada praktik langsung dan studi kasus nyata dari industri</p>
                </div>
            </div>
        </section>
    </div>

     <!-- Client Logo Section -->
        <section class="max-w-6xl mx-auto px-4 md:px-8 py-8">
            <div class="client-section">
                <div class="text-center mb-10">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-4 section-title mx-auto">Klien Kami</h2>
                    <p class="text-gray-600 text-lg max-w-2xl mx-auto">Perusahaan-perusahaan ternama yang telah mempercayai pelatihan kami</p>
                </div>
                
                <div class="client-grid">
                    <div class="flex justify-center">
                        <img src="/images/5.png"alt="Indosat" class="client-logo">
                    </div>
                    <div class="flex justify-center">
                        <img src="/images/6.png" alt="Pertamina" class="client-logo">
                    </div>
                    <div class="flex justify-center">
                        <img src="/images/9.png"alt="Nathin" class="client-logo">
                    </div>
                    <div class="flex justify-center">
                        <img src="/images/8.png" alt="Banni" class="client-logo">
                    </div>
                    <div class="flex justify-center">
                        <img src="/images/11.png" alt="Banni" class="client-logo">
                    </div>
                    <div class="flex justify-center">
                        <img src="/images/12.png" alt="Banni" class="client-logo">
                    </div>
                </div>
            </div>
        </section>
    
    <!-- Footer (Tidak Diubah) -->
    <footer class="bg-black py-8 mt-12 border-t border-gray-700">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-center md:text-left mb-4 md:mb-0">
                    <div class="text-2xl font-extrabold text-[#f9a400] flex items-center">
                        <i class="fas fa-ad mr-2"></i>
                        ADS
                    </div>
                    <p class="text-gray-400 text-sm mt-1">© 2025 Pelatihan Iklan Digital. All rights reserved.</p>
                </div>
                <ul class="flex flex-wrap justify-center md:justify-end space-x-6 md:space-x-8 text-sm font-medium">
                    <li><a href="/" class="text-gray-300 hover:text-[#f9a400] transition flex items-center"><i class="fas fa-home mr-1 text-sm"></i> Beranda</a></li>
                    <li><a href="/tentang" class="text-[#f9a400] font-bold flex items-cente"><i class="fas fa-info-circle mr-1 text-sm"></i> Tentang</a></li>
                    <li><a href="/kelas" class="text-gray-300 hover:text-[#f9a400] transition flex items-center nav-link"><i class="fas fa-chalkboard-teacher mr-2 text-sm"></i> Kelas</a></li>
                    <li><a href="/lokasi" class="text-gray-300 hover:text-[#f9a400] transition flex items-center"><i class="fas fa-map-marker-alt mr-1 text-sm"></i> Lokasi</a></li>
                    <li><a href="/galeri_kami" class="text-gray-300 hover:text-[#d68d00] transition flex items-center"><i class="fas fa-images mr-1 text-sm"></i> Galeri Kami</a></li>
                </ul>
            </div>
        </div>
    </footer>
</body>
</html>