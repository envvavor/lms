<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Kami - Pelatihan Iklan Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            color: #1a1a1a;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .main-content {
            flex: 1;
        }
        
        .gallery-header {
            background: linear-gradient(120deg, #1a1a1a 0%, #2d2d2d 100%);
            color: white;
            padding: 4rem 0;
            margin-bottom: 2rem;
        }
        
        .gallery-container {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid #eaeaea;
            overflow: hidden;
            margin-top: -50px;
            position: relative;
            z-index: 10;
        }
        
        .gallery-controls {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            background: #fafafa;
        }
        
        .gallery-grid {
            padding: 2rem;
        }
        
        .gallery-item {
            overflow: hidden;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
            border: 1px solid #eaeaea;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: #ffffff;
            position: relative;
            height: 100%;
        }
        
        .gallery-item:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
            border-color: #f9a400;
        }
        
        .gallery-img-container {
            overflow: hidden;
            height: 220px;
            position: relative;
        }
        
        .gallery-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.5s ease;
        }
        
        .gallery-item:hover .gallery-img {
            transform: scale(1.08);
            filter: brightness(1.05);
        }
        
        .gallery-content {
            padding: 1.2rem;
        }
        
        .gallery-title {
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 0.5rem;
            color: #1a1a1a;
        }
        
        .gallery-desc {
            font-size: 0.85rem;
            color: #666;
            line-height: 1.5;
        }
        
        .gallery-meta {
            display: flex;
            justify-content: space-between;
            margin-top: 1rem;
            font-size: 0.75rem;
            color: #888;
        }
        
        .gallery-date {
            display: flex;
            align-items: center;
        }
        
        .gallery-likes {
            display: flex;
            align-items: center;
        }
        
        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 1rem;
            color: #ffffff;
            font-weight: 800;
        }
        
        .section-subtitle {
            color: rgba(255, 255, 255, 0.85);
            max-width: 600px;
            margin: 0 auto;
        }
        
        .accent-divider {
            height: 4px;
            width: 80px;
            background: #f9a400;
            margin: 1rem auto;
            border-radius: 2px;
        }
        
        .filter-btn {
            background: #f5f5f5;
            color: #555;
            border: 1px solid #e0e0e0;
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 500;
            transition: all 0.3s ease;
            margin: 0 5px 10px;
            font-size: 0.9rem;
        }
        
        .filter-btn:hover, .filter-btn.active {
            background: #f9a400;
            color: #1a1a1a;
            border-color: #f9a400;
        }
        
        .search-box {
            position: relative;
            margin-bottom: 10px;
        }
        
        .search-input {
            padding: 10px 15px 10px 40px;
            border-radius: 30px;
            border: 1px solid #e0e0e0;
            background: #f5f5f5;
            width: 250px;
            font-size: 0.9rem;
            transition: all 0.3s;
        }
        
        .search-input:focus {
            outline: none;
            border-color: #f9a400;
            background: white;
            width: 300px;
        }
        
        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        }
        
        .view-more-container {
            text-align: center;
            padding: 2rem 0;
            border-top: 1px solid #f0f0f0;
            background: #fafafa;
        }
        
        .view-more-btn {
            background: #1a1a1a;
            color: white;
            padding: 12px 30px;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid #1a1a1a;
            display: inline-flex;
            align-items: center;
        }
        
        .view-more-btn:hover {
            background: #f9a400;
            color: #1a1a1a;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border-color: #f9a400;
        }
        
        .btn-icon {
            margin-left: 8px;
            transition: transform 0.3s;
        }
        
        .view-more-btn:hover .btn-icon {
            transform: translateX(4px);
        }
        
        .gallery-stats {
            display: flex;
            justify-content: center;
            margin: 1.5rem 0;
            flex-wrap: wrap;
        }
        
        .stat-item {
            text-align: center;
            padding: 0 1.5rem;
            border-right: 1px solid #e0e0e0;
            margin: 0.5rem 0;
        }
        
        .stat-item:last-child {
            border-right: none;
        }
        
        .stat-number {
            font-size: 1.8rem;
            font-weight: 700;
            color: #f9a400;
            line-height: 1;
        }
        
        .stat-label {
            font-size: 0.85rem;
            color: #666;
        }
        
        @media (max-width: 768px) {
            .gallery-controls {
                flex-direction: column;
                align-items: stretch;
            }
            
            .search-box {
                width: 100%;
                margin-top: 1rem;
            }
            
            .search-input {
                width: 100%;
            }
            
            .search-input:focus {
                width: 100%;
            }
            
            .filter-buttons {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .stat-item {
                flex: 0 0 50%;
                border-right: none;
                border-bottom: 1px solid #f0f0f0;
                padding: 1rem;
            }
            
            .stat-item:nth-child(3), .stat-item:nth-child(4) {
                border-bottom: none;
            }
        }
    </style>
</head>
<body>
    <div class="main-content">
        <!-- Header Section -->
        <header class="gallery-header">
            <div class="max-w-7xl mx-auto px-4 md:px-8 text-center">
                <h1 class="text-4xl md:text-5xl font-extrabold section-title">Galeri Kami</h1>
                <div class="accent-divider"></div>
                <p class="section-subtitle text-lg">
                    Dokumentasi pelatihan, kegiatan, dan suasana belajar bersama peserta terbaik kami.
                </p>
                </div>
            </div>
        </header>
        
        <!-- Gallery Container -->
        <section class="max-w-7xl mx-auto px-4 md:px-8 pb-16">
            <div class="gallery-container">
                <div class="gallery-controls">
                    <div class="search-box">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" placeholder="Cari foto...">
                    </div>
                </div>
                
                <div class="gallery-grid">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        <!-- Gallery Item 1 -->
                        <div class="gallery-item">
                            <div class="gallery-img-container">
                                <img src="/images/1.png" alt="Sesi Pelatihan Intensif" class="gallery-img" />
                            </div>
                            <div class="gallery-content">
                                <div class="gallery-title">Sesi Pelatihan Intensif</div>
                                <div class="gallery-desc">Peserta sedang serius mengikuti materi pelatihan iklan digital.</div>
                                <div class="gallery-meta">
                                    <div class="gallery-date">
                                        <i class="far fa-calendar-alt mr-1"></i> 15 Mar 2025
                                    </div>
                                    <div class="gallery-likes">
                                        <i class="far fa-heart mr-1"></i> 42
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Gallery Item 2 -->
                        <div class="gallery-item">
                            <div class="gallery-img-container">
                                <img src="/images/2.png" alt="Diskusi Kelompok" class="gallery-img" />
                            </div>
                            <div class="gallery-content">
                                <div class="gallery-title">Diskusi Kelompok</div>
                                <div class="gallery-desc">Peserta berkolaborasi menyelesaikan studi kasus iklan digital.</div>
                                <div class="gallery-meta">
                                    <div class="gallery-date">
                                        <i class="far fa-calendar-alt mr-1"></i> 22 Mar 2025
                                    </div>
                                    <div class="gallery-likes">
                                        <i class="far fa-heart mr-1"></i> 38
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Gallery Item 3 -->
                        <div class="gallery-item">
                            <div class="gallery-img-container">
                                <img src="/images/3.png" alt="Presentasi Hasil" class="gallery-img" />
                            </div>
                            <div class="gallery-content">
                                <div class="gallery-title">Presentasi Hasil</div>
                                <div class="gallery-desc">Peserta mempresentasikan hasil kerja mereka kepada coach.</div>
                                <div class="gallery-meta">
                                    <div class="gallery-date">
                                        <i class="far fa-calendar-alt mr-1"></i> 28 Mar 2025
                                    </div>
                                    <div class="gallery-likes">
                                        <i class="far fa-heart mr-1"></i> 56
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Gallery Item 4 -->
                        <div class="gallery-item">
                            <div class="gallery-img-container">
                                <img src="/images/4.png" alt="Networking Session" class="gallery-img" />
                            </div>
                            <div class="gallery-content">
                                <div class="gallery-title">Networking Session</div>
                                <div class="gallery-desc">Peserta menjalin relasi setelah sesi pelatihan selesai.</div>
                                <div class="gallery-meta">
                                    <div class="gallery-date">
                                        <i class="far fa-calendar-alt mr-1"></i> 5 Apr 2025
                                    </div>
                                    <div class="gallery-likes">
                                        <i class="far fa-heart mr-1"></i> 47
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Gallery Item 5 -->
                        <div class="gallery-item">
                            <div class="gallery-img-container">
                                <img src="/images/13.png" alt="Coach Pendampingan" class="gallery-img" />
                            </div>
                            <div class="gallery-content">
                                <div class="gallery-title">Coach Pendampingan</div>
                                <div class="gallery-desc">Coach memberikan pendampingan one-on-one kepada peserta.</div>
                                <div class="gallery-meta">
                                    <div class="gallery-date">
                                        <i class="far fa-calendar-alt mr-1"></i> 12 Apr 2025
                                    </div>
                                    <div class="gallery-likes">
                                        <i class="far fa-heart mr-1"></i> 39
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Gallery Item 6 -->
                        <div class="gallery-item">
                            <div class="gallery-img-container">
                                <img src="/images/14.png" alt="Tools Demonstrasi" class="gallery-img" />
                            </div>
                            <div class="gallery-content">
                                <div class="gallery-title">Tools Demonstrasi</div>
                                <div class="gallery-desc">Demonstrasi tools iklan digital terkini untuk peserta.</div>
                                <div class="gallery-meta">
                                    <div class="gallery-date">
                                        <i class="far fa-calendar-alt mr-1"></i> 18 Apr 2025
                                    </div>
                                    <div class="gallery-likes">
                                        <i class="far fa-heart mr-1"></i> 43
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Gallery Item 7 -->
                        <div class="gallery-item">
                            <div class="gallery-img-container">
                                <img src="/images/15.png" alt="Kelulusan Peserta" class="gallery-img" />
                            </div>
                            <div class="gallery-content">
                                <div class="gallery-title">Kelulusan Peserta</div>
                                <div class="gallery-desc">Momen kebahagiaan setelah menyelesaikan pelatihan.</div>
                                <div class="gallery-meta">
                                    <div class="gallery-date">
                                        <i class="far fa-calendar-alt mr-1"></i> 25 Apr 2025
                                    </div>
                                    <div class="gallery-likes">
                                        <i class="far fa-heart mr-1"></i> 62
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Gallery Item 8 -->
                        <div class="gallery-item">
                            <div class="gallery-img-container">
                                <img src="/images/16.png" alt="Suasana Kelas" class="gallery-img" />
                            </div>
                            <div class="gallery-content">
                                <div class="gallery-title">Suasana Kelas</div>
                                <div class="gallery-desc">Fasilitas lengkap untuk kenyamanan belajar peserta.</div>
                                <div class="gallery-meta">
                                    <div class="gallery-date">
                                        <i class="far fa-calendar-alt mr-1"></i> 2 Mei 2025
                                    </div>
                                    <div class="gallery-likes">
                                        <i class="far fa-heart mr-1"></i> 51
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    <!-- Footer (Tidak Diubah) -->
    <footer class="bg-black py-10">
        <div class="max-w-7xl mx-auto px-8 md:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-center md:text-left mb-6 md:mb-0">
                    <div class="text-2xl font-extrabold text-[#f9a400] flex items-center justify-center md:justify-start">
                        <i class="fas fa-ad mr-2"></i>
                        ADS
                    </div>
                    <p class="text-gray-400 text-sm mt-2">© 2025 Pelatihan Iklan Digital. All rights reserved.</p>
                </div>
                <ul class="flex flex-wrap justify-center md:justify-end space-x-6 md:space-x-8 text-sm font-medium">
                    <li><a href="/" class="text-gray-300 hover:text-[#f9a400] transition flex items-center nav-link"><i class="fas fa-home mr-2 text-sm"></i> Beranda</a></li>
                    <li><a href="/tentang" class="text-gray-300 hover:text-[#f9a400] transition flex items-center nav-link"><i class="fas fa-info-circle mr-2 text-sm"></i> Tentang</a></li>
                    <li><a href="/kelas" class="text-gray-300 hover:text-[#f9a400] transition flex items-center nav-link"><i class="fas fa-chalkboard-teacher mr-2 text-sm"></i> Kelas</a></li>
                    <li><a href="/lokasi" class="text-gray-300 hover:text-[#f9a400] transition flex items-center nav-link"><i class="fas fa-map-marker-alt mr-2 text-sm"></i> Lokasi</a></li>
                    <li><a href="/galeri_kami" class="text-[#f9a400] font-bold flex items-center active-nav-link"><i class="fas fa-images mr-2 text-sm"></i> Galeri Kami</a></li>
                </ul>
            </div>
        </div>
    </footer>

    <script>
        // Simple filter functionality for demonstration
        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('.filter-btn');
            
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    
                    // Add active class to clicked button
                    this.classList.add('active');
                    
                    // Here you would typically filter the gallery items
                    // For this example, we're just showing a simple alert
                    console.log('Filtering by: ' + this.textContent);
                });
            });
            
            // View more button functionality
            const viewMoreBtn = document.querySelector('.view-more-btn');
            viewMoreBtn.addEventListener('click', function() {
                alert('Akan menampilkan lebih banyak galeri foto');
            });
        });
    </script>
</body>
</html>