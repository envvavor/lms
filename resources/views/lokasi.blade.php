<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lokasi Workshop - Pelatihan Iklan Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f9f5e9 0%, #e6ddc0 100%);
            min-height: 100vh;
        }
        
        .location-card {
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
            background: linear-gradient(to bottom, #ffffff 0%, #f8f8f8 100%);
            display: flex;
            flex-direction: row;
            height: 400px;
            max-width: 1000px;
            margin: 0 auto;
        }
        
        .location-card:hover {
            transform: translateY(-8px) scale(1.01);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        
        .city-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: linear-gradient(45deg, #d68d00, #ffaa00);
            color: white;
            font-weight: 700;
            padding: 10px 20px;
            border-radius: 25px;
            box-shadow: 0 6px 15px rgba(214, 141, 0, 0.35);
            z-index: 10;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
        }
        
        .map-container {
            position: relative;
            overflow: hidden;
            width: 60%;
            border-radius: 0 15px 15px 0;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .location-card:hover .map-container {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
        
        .map-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
            border-radius: 0 15px 15px 0;
        }
        
        .info-container {
            width: 40%;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        
        .whatsapp-btn {
            background: linear-gradient(45deg, #25D366, #128C7E);
            color: white;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 6px 15px rgba(37, 211, 102, 0.35);
            padding: 14px;
            border-radius: 14px;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .whatsapp-btn:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(37, 211, 102, 0.45);
            background: linear-gradient(45deg, #128C7E, #25D366);
        }
        
        .nav-link {
            position: relative;
            padding-bottom: 5px;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: #d68d00;
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        .active-nav-link {
            color: #d68d00;
            font-weight: 600;
        }
        
        .active-nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: #d68d00;
        }
        
        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 2.5rem;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -12px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 5px;
            background: linear-gradient(90deg, #d68d00, #ffaa00);
            border-radius: 3px;
        }
        
        .footer-gradient {
            background: linear-gradient(to right, #000000, #1a1a1a);
        }
        
        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.5rem;
        }
        
        .info-icon {
            color: #d68d00;
            font-size: 1.2rem;
            margin-right: 12px;
            margin-top: 3px;
            min-width: 20px;
        }
        
        .location-header {
            margin-bottom: 2rem;
        }
        
        .location-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 0.5rem;
        }
        
        .location-description {
            color: #666;
            font-size: 1.05rem;
            line-height: 1.5;
        }

        @media (max-width: 900px) {
            .location-card {
                flex-direction: column;
                height: auto;
                max-width: 500px;
            }
            
            .map-container, .info-container {
                width: 100%;
            }
            
            .map-container {
                height: 300px;
                border-radius: 0 0 15px 15px;
            }
            
            .map-container iframe {
                border-radius: 0 0 15px 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Lokasi Section -->
    <section class="w-full py-12 px-4 md:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold text-[#333] mb-4 section-title">Lokasi Workshop Kami</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">Bantul Karang, Ringinharjo, Kec. Bantul, Kabupaten Bantul, Daerah Istimewa Yogyakarta</p>
            </div>
            
            <!-- Single Location Card - Horizontal Layout -->
            <div class="relative location-card">
                
                <div class="info-container">
                    <div>
                        <div class="location-header">
                            <h3 class="location-name">Creativy</h3>
                            <p class="location-description">Workshop kami yang nyaman</p>
                        </div>
                        
                        <div class="address-info">
                            <div class="info-item">
                                <i class="fas fa-map-marker-alt info-icon"></i>
                                <span>Jl. Kh Wahid Hasyim No.108 B, Taskombang, Palbapang, Kec. Bantul, Kabupaten Bantul, Daerah Istimewa Yogyakarta 55713</span>
                            </div>
                            <div class="info-item">
                                <i class="far fa-clock info-icon"></i>
                                <span>Senin-Sabtu, 08.00 - 16.00 WIB</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-phone info-icon"></i>
                                <span>+62 813 5302 5302</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.97857813895!2d110.32061927481968!3d-7.897306492125578!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7aff937aafd091%3A0x9ca989b65d7f41e!2sCreativy%20-%20Pelatihan%20Bisnis%20Online%20Digital%20Marketing!5e0!3m2!1sid!2sid!4v1756865138123!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            
            <!-- Additional Info Section -->
            <div class="mt-16 bg-white rounded-2xl p-8 shadow-lg">
                <h3 class="text-2xl font-bold text-center mb-8 text-[#333]">Fasilitas Workshop Kami</h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="text-center p-4 rounded-xl bg-amber-50">
                        <i class="fas fa-tools text-3xl text-amber-600 mb-3"></i>
                        <h4 class="font-semibold mb-2">Peralatan Lengkap</h4>
                        <p class="text-sm text-gray-600">Semua peralatan yang diperlukan tersedia di workshop</p>
                    </div>
                    <div class="text-center p-4 rounded-xl bg-amber-50">
                        <i class="fas fa-users text-3xl text-amber-600 mb-3"></i>
                        <h4 class="font-semibold mb-2">Instruktur Berpengalaman</h4>
                        <p class="text-sm text-gray-600">Didampingi oleh instruktur yang ahli di bidangnya</p>
                    </div>
                    <div class="text-center p-4 rounded-xl bg-amber-50">
                        <i class="fas fa-coffee text-3xl text-amber-600 mb-3"></i>
                        <h4 class="font-semibold mb-2">Area Istirahat</h4>
                        <p class="text-sm text-gray-600">Area nyaman untuk beristirahat dan networking</p>
                    </div>
                    <div class="text-center p-4 rounded-xl bg-amber-50">
                        <i class="fas fa-wifi text-3xl text-amber-600 mb-3"></i>
                        <h4 class="font-semibold mb-2">WiFi Gratis</h4>
                        <p class="text-sm text-gray-600">Akses internet cepat selama workshop</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="footer-gradient py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-center md:text-left mb-4 md:mb-0">
                    <div class="text-2xl font-extrabold text-[#d68d00] flex items-center justify-center md:justify-start">
                        <i class="fas fa-ad mr-2"></i>
                        ADS
                    </div>
                    <p class="text-gray-400 text-sm mt-1">© 2025 Pelatihan Iklan Digital. All rights reserved.</p>
                </div>
                <ul class="flex flex-wrap justify-center md:justify-end space-x-4 md:space-x-6 text-sm font-medium">
                    <li><a href="/" class="text-gray-300 hover:text-[#d68d00] transition flex items-center"><i class="fas fa-home mr-1 text-sm"></i> Beranda</a></li>
                    <li><a href="/tentang" class="text-gray-300 hover:text-[#d68d00] transition flex items-center"><i class="fas fa-info-circle mr-1 text-sm"></i> Tentang</a></li>
                    <li><a href="/kelas" class="text-gray-300 hover:text-[#d68d00] transition flex items-center"><i class="fas fa-chalkboard-teacher mr-1 text-sm"></i> Kelas</a></li>
                    <li><a href="/lokasi" class="text-[#d68d00] font-bold flex items-center"><i class="fas fa-map-marker-alt mr-1 text-sm"></i> Lokasi</a></li>
                    <li><a href="/galeri_kami" class="text-gray-300 hover:text-[#d68d00] transition flex items-center"><i class="fas fa-images mr-1 text-sm"></i> Galeri Kami</a></li>
                </ul>
            </div>
        </div>
    </footer>
</body>
</html>