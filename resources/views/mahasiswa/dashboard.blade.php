<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SIPENSI Premium</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style>
        :root {
            --primary-color: #6366f1;
            --secondary-color: #8b5cf6;
            --accent-color: #a78bfa;
            --background-color: #f4f4ff;
            --card-background: #ffffff;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
        }

        * {
            transition: all 0.3s ease;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--background-color);
            color: var(--text-primary);
        }

        .glass-morphism {
            backdrop-filter: blur(15px);
            background: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.125);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1);
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)) !important;
            color: white !important;
        }

        .navbar-brand {
            color: white !important;
            font-weight: 700;
        }

        .sidebar {
            background: var(--card-background);
            border-right: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 10px 50px rgba(0, 0, 0, 0.05);
        }

        .dashboard-card {
            border-radius: 20px;
            background: var(--card-background);
            box-shadow:
                0 15px 35px rgba(0, 0, 0, 0.05),
                0 5px 15px rgba(0, 0, 0, 0.03);
            border: none;
            overflow: hidden;
        }

        .dashboard-card:hover {
            transform: translateY(-10px);
            box-shadow:
                0 25px 50px rgba(0, 0, 0, 0.1),
                0 10px 20px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            color: white;
            font-weight: 600;
            padding: 15px;
            border: none;
        }

        .sidebar .nav-link {
            color: var(--text-secondary);
            transition: all 0.3s ease;
            border-radius: 10px;
            margin: 5px 0;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white !important;
            transform: translateX(5px);
        }

        .progress {
            background-color: rgba(99, 102, 241, 0.2);
            height: 12px;
            border-radius: 20px;
        }

        .progress-bar {
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border-radius: 20px;
        }

        .btn-custom {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            color: white;
            font-weight: 600;
            transition: all 0.4s ease;
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
        }

        .btn-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(99, 102, 241, 0.4);
        }

        .badge {
            font-weight: 500;
            padding: 5px 10px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SIPENSI</a>
            <div class="ms-auto d-flex align-items-center">
                <div class="dropdown me-3">
                    <a href="#" class="dropdown-toggle text-white text-decoration-none" data-bs-toggle="dropdown">
                        <i class="fas fa-bell"></i>
                        <span class="badge bg-danger rounded-circle ms-1">3</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end glass-morphism">
                        <li><a class="dropdown-item" href="#">Bimbingan baru</a></li>
                        <li><a class="dropdown-item" href="#">Deadline dekat</a></li>
                        <li><a class="dropdown-item" href="#">Dokumen diperbarui</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                        <img src="/api/placeholder/50/50" class="rounded-circle border border-2 border-white"
                            alt="Profile">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end glass-morphism">
                        <li><a class="dropdown-item" href="#">Profil</a></li>
                        <li><a class="dropdown-item" href="#">Pengaturan</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a class="dropdown-item" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Dashboard -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar pt-5 mt-4">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-book me-2"></i>Skripsi Saya
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-calendar-alt me-2"></i>Jadwal Bimbingan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-file-alt me-2"></i>Dokumen
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-comments me-2"></i>Konsultasi
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5 mt-4">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card dashboard-card mb-4 animate__animated animate__fadeIn">
                            <div class="card-header">Progress Skripsi</div>
                            <div class="card-body">
                                <h5 class="card-title fw-bold">Analisis Pengaruh Media Sosial</h5>
                                <div class="progress mt-3">
                                    <div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="65"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <small class="text-secondary">Tahap: Pengumpulan Data</small>
                                    <small class="text-primary fw-bold">65%</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card dashboard-card mb-4 animate__animated animate__fadeInLeft">
                                    <div class="card-header">Jadwal Dekat</div>
                                    <div class="card-body">
                                        <ul class="list-unstyled">
                                            <li class="mb-3 p-2 rounded-3 bg-light">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="fw-semibold">Bimbingan BAB 2</span>
                                                    <small class="badge bg-danger">3 hari lagi</small>
                                                </div>
                                            </li>
                                            <li class="p-2 rounded-3 bg-light">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="fw-semibold">Seminar Proposal</span>
                                                    <small class="badge bg-warning">2 minggu lagi</small>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card dashboard-card mb-4 animate__animated animate__fadeInRight">
                                    <div class="card-header">Status Dokumen</div>
                                    <div class="card-body">
                                        <div
                                            class="d-flex justify-content-between align-items-center mb-3 p-2 rounded-3 bg-light">
                                            <span>Proposal</span>
                                            <span class="badge bg-success">Disetujui</span>
                                        </div>
                                        <div
                                            class="d-flex justify-content-between align-items-center mb-3 p-2 rounded-3 bg-light">
                                            <span>BAB 1</span>
                                            <span class="badge bg-warning">Revisi</span>
                                        </div>
                                        <div
                                            class="d-flex justify-content-between align-items-center p-2 rounded-3 bg-light">
                                            <span>BAB 2</span>
                                            <span class="badge bg-secondary">Proses</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card dashboard-card mb-4 animate__animated animate__fadeInRight">
                            <div class="card-header">Dosen Pembimbing</div>
                            <div class="card-body text-center">
                                <img src="/api/placeholder/120/120"
                                    class="rounded-circle mb-3 border border-3 border-primary" alt="Dosen Pembimbing">
                                <h6 class="mb-1 fw-bold">Dr. Sarah Wijaya, M.Si</h6>
                                <small class="text-secondary">Pembimbing Utama</small>
                                <div class="mt-3">
                                    <a href="#" class="btn btn-custom btn-sm w-100">Konsultasi</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
