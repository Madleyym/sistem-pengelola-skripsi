<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SIPENSI - Sistem Informasi Penelitian Skripsi untuk memudahkan mahasiswa dalam mengelola dan memantau progress skripsi">
    <title>SIPENSI - Sistem Informasi Penelitian Skripsi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- AOS Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4f46e5;
            --secondary-color: #818cf8;
            --accent-color: #c7d2fe;
            --text-primary: #1e293b;
            --text-secondary: #475569;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f8fafc;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 1rem 2rem;
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color);
        }

        .nav-link {
            font-weight: 500;
            color: var(--text-secondary);
            transition: all 0.3s ease;
            margin: 0 0.5rem;
        }

        .nav-link:hover {
            color: var(--primary-color);
        }

        .hero-section {
            padding: 6rem 2rem;
            background: linear-gradient(135deg, #fff 0%, #f1f5f9 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .logo {
            max-width: 150px;
            margin-bottom: 2rem;
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
        }

        .title {
            color: var(--text-primary);
            font-weight: 800;
            margin-bottom: 1.5rem;
            font-size: 3.5rem;
            line-height: 1.2;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .subtitle {
            color: var(--text-secondary);
            font-weight: 400;
            margin-bottom: 2.5rem;
            font-size: 1.25rem;
            line-height: 1.8;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .features-section {
            padding: 6rem 0;
            background: white;
        }

        .feature-card {
            padding: 2rem;
            text-align: center;
            transition: all 0.4s ease;
            border-radius: 20px;
            background: white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            height: 100%;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border-color: var(--accent-color);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            background: var(--accent-color);
            width: 80px;
            height: 80px;
            line-height: 80px;
            border-radius: 50%;
            margin: 0 auto 1.5rem;
        }

        .feature-card h3 {
            color: var(--text-primary);
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }

        .feature-card p {
            color: var(--text-secondary);
            font-size: 1rem;
            line-height: 1.6;
        }

        .btn-custom-primary {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border: none;
            padding: 15px 40px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            border-radius: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.9rem;
        }

        .btn-custom-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.3);
            color: white;
        }

        .btn-custom-outline {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            padding: 15px 40px;
            font-weight: 600;
            transition: all 0.3s ease;
            border-radius: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.9rem;
            background: transparent;
        }

        .btn-custom-outline:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.2);
        }

        .stats-section {
            padding: 4rem 0;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            margin: 4rem 0;
        }

        .stat-item {
            text-align: center;
            padding: 2rem;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .testimonial-section {
            padding: 6rem 0;
            background: #f8fafc;
        }

        .testimonial-card {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            margin: 1rem;
        }

        .testimonial-text {
            font-size: 1.1rem;
            color: var(--text-secondary);
            font-style: italic;
            margin-bottom: 1.5rem;
        }

        .testimonial-author {
            font-weight: 600;
            color: var(--text-primary);
        }

        .footer {
            background: #1e293b;
            color: white;
            padding: 4rem 0 2rem;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer h4 {
            color: white;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 0.8rem;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-links a:hover {
            color: white;
            padding-left: 5px;
        }

        .social-icons {
            margin-top: 2rem;
        }

        .social-icons a {
            color: white;
            font-size: 1.5rem;
            margin-right: 1rem;
            transition: all 0.3s ease;
        }

        .social-icons a:hover {
            color: var(--accent-color);
            transform: translateY(-3px);
        }

        @media (max-width: 768px) {
            .title {
                font-size: 2.5rem;
            }

            .hero-section {
                padding: 4rem 1rem;
            }

            .btn-custom-primary,
            .btn-custom-outline {
                display: block;
                margin: 1rem auto;
                max-width: 250px;
            }

            .stat-item {
                margin-bottom: 2rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">SIPENSI</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonials">Testimoni</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Kontak</a>
                    </li>
                    @if (Route::has('login'))
                    @auth
                    <li class="nav-item">
                        <a href="{{ url('/dashboard') }}" class="btn btn-custom-primary ms-3">Dashboard</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-custom-outline ms-3">Login</a>
                    </li>
                    @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content text-center">
                <img src="/images/logo.png" alt="SIPENSI Logo" class="logo" data-aos="fade-down">
                <h1 class="title" data-aos="fade-up">Wujudkan Skripsi Impian Anda</h1>
                <p class="subtitle" data-aos="fade-up" data-aos-delay="100">
                    Platform modern dan terintegrasi yang memudahkan proses penelitian skripsi Anda. Dengan SIPENSI, kelola dan pantau progress skripsi menjadi lebih efisien dan terstruktur.
                </p>
                <div data-aos="fade-up" data-aos-delay="200">
                    @if (Route::has('login'))
                    @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-custom-primary btn-lg">
                        <i class="fas fa-tachometer-alt me-2"></i>Masuk ke Dashboard
                    </a>
                    @else
                    <a href="{{ route('login') }}" class="btn btn-custom-primary btn-lg me-3">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-custom-outline btn-lg">
                        <i class="fas fa-user-plus me-2"></i>Register
                    </a>
                    @endif
                    @endauth
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4" data-aos="fade-up">
                    <div class="stat-item">
                        <div class="stat-number">5000+</div>
                        <div class="stat-label">Mahasiswa Aktif</div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-item">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">Dosen Pembimbing</div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-item">
                        <div class="stat-number">98%</div>
                        <div class="stat-label">Tingkat Kepuasan</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4" data-aos="fade-up">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <h3>Manajemen Progres</h3>
                        <p>Pantau dan kelola kemajuan skripsi dengan mudah melalui dashboard interaktif dan timeline yang terstruktur.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-comments"></i>
                        </div>
                        <h3>Konsultasi Online</h3>
                        <p>Diskusi dengan dosen pembimbing kapan saja dan di mana saja melalui fitur chat real-time dan video conference terintegrasi.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h3>Jadwal Bimbingan</h3>
                        <p>Atur jadwal bimbingan dengan sistem kalendar pintar dan dapatkan pengingat otomatis untuk setiap sesi konsultasi.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <h3>Repositori Digital</h3>
                        <p>Simpan dan kelola semua dokumen skripsi Anda dalam satu tempat dengan sistem pengarsipan yang aman dan terorganisir.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3>Analisis & Laporan</h3>
                        <p>Dapatkan insight mendalam tentang progress skripsi Anda melalui grafik dan laporan yang informatif.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="500">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-bell"></i>
                        </div>
                        <h3>Notifikasi Pintar</h3>
                        <p>Terima pengingat dan pemberitahuan penting terkait deadline, jadwal bimbingan, dan update progress skripsi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section id="testimonials" class="testimonial-section">
        <div class="container">
            <h2 class="text-center mb-5" data-aos="fade-up">Apa Kata Mereka?</h2>
            <div class="row">
                <div class="col-md-4" data-aos="fade-up">
                    <div class="testimonial-card">
                        <div class="testimonial-text">
                            "SIPENSI sangat membantu saya dalam mengelola progress skripsi. Interface yang mudah digunakan dan fitur yang lengkap membuat proses pengerjaan skripsi menjadi lebih terstruktur."
                        </div>
                        <div class="testimonial-author">
                            - Ahmad Fahmi, Mahasiswa Teknik Informatika
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="testimonial-card">
                        <div class="testimonial-text">
                            "Sebagai dosen pembimbing, SIPENSI memudahkan saya dalam memantau dan memberikan feedback untuk mahasiswa bimbingan. Sangat efisien!"
                        </div>
                        <div class="testimonial-author">
                            - Dr. Sarah Wijaya, Dosen Fakultas Ekonomi
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="testimonial-card">
                        <div class="testimonial-text">
                            "Fitur konsultasi online dan sistem notifikasi sangat membantu, terutama selama masa pandemi. Proses bimbingan jadi lebih fleksibel dan efektif."
                        </div>
                        <div class="testimonial-author">
                            - Linda Kusuma, Mahasiswa Psikologi
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h2 class="mb-4" data-aos="fade-up">Hubungi Kami</h2>
                    <p class="mb-5" data-aos="fade-up">Punya pertanyaan? Tim support kami siap membantu Anda.</p>
                    <div class="row" data-aos="fade-up">
                        <div class="col-md-4 mb-4">
                            <div class="feature-icon mb-3">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <h5>Email</h5>
                            <p>support@sipensi.ac.id</p>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="feature-icon mb-3">
                                <i class="fas fa-phone"></i>
                            </div>
                            <h5>Telepon</h5>
                            <p>+62 21 1234 5678</p>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="feature-icon mb-3">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <h5>Lokasi</h5>
                            <p>Gedung Rektorat Lt. 3<br>Kampus Pusat</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h4>Tentang SIPENSI</h4>
                    <p>Sistem Informasi Penelitian Skripsi (SIPENSI) adalah platform modern yang dirancang untuk memudahkan proses pengerjaan dan monitoring skripsi mahasiswa.</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <h4>Link Cepat</h4>
                    <ul class="footer-links">
                        <li><a href="#features">Fitur</a></li>
                        <li><a href="#testimonials">Testimoni</a></li>
                        <li><a href="#contact">Kontak</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h4>Newsletter</h4>
                    <p>Berlangganan newsletter kami untuk mendapatkan update terbaru.</p>
                    <form class="mt-3">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Email Anda">
                            <button class="btn btn-custom-primary" type="submit">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
            <hr class="mt-4 mb-3" style="border-color: rgba(255,255,255,0.1);">
            <div class="text-center">
                <p>&copy; {{ date('Y') }} SIPENSI - Sistem Informasi Penelitian Skripsi. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>

</html>