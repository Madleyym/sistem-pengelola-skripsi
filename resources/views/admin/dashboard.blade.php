<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - SIPENSI Premium</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1d4ed8;
            --accent-color: #3b82f6;
            --background-color: #f8fafc;
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
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05), 0 5px 15px rgba(0, 0, 0, 0.03);
            border: none;
            overflow: hidden;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1), 0 10px 20px rgba(0, 0, 0, 0.05);
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

        .stats-card {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 15px;
            padding: 20px;
        }

        .btn-custom {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            color: white;
            font-weight: 600;
            transition: all 0.4s ease;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(37, 99, 235, 0.3);
        }

        .table-responsive {
            border-radius: 15px;
            overflow: hidden;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SIPENSI ADMIN</a>
            <div class="ms-auto d-flex align-items-center">
                <div class="dropdown me-3">
                    <a href="#" class="dropdown-toggle text-white text-decoration-none" data-bs-toggle="dropdown">
                        <i class="fas fa-bell"></i>
                        <span class="badge bg-danger rounded-circle ms-1">3</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end glass-morphism">
                        <li><a class="dropdown-item" href="#">Pengajuan Skripsi Baru</a></li>
                        <li><a class="dropdown-item" href="#">Seminar Proposal Terjadwal</a></li>
                        <li><a class="dropdown-item" href="#">Sidang Skripsi Mendatang</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle text-white text-decoration-none" data-bs-toggle="dropdown">
                        Admin
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end glass-morphism">
                        <li><a class="dropdown-item" href="#">Pengaturan</a></li>
                        <li><a class="dropdown-item" href="#">Log Sistem</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
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
                                <i class="fas fa-users me-2"></i>Mahasiswa
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-chalkboard-teacher me-2"></i>Dosen
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-book me-2"></i>Seminar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-graduation-cap me-2"></i>Skripsi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-cog me-2"></i>Pengaturan
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5 mt-4">
                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="dashboard-card stats-card animate__animated animate__fadeIn">
                            <h3 class="mb-0">3</h3>
                            <p class="mb-0">Total Mahasiswa</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dashboard-card stats-card animate__animated animate__fadeIn">
                            <h3 class="mb-0">3</h3>
                            <p class="mb-0">Total Dosen</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dashboard-card stats-card animate__animated animate__fadeIn">
                            <h3 class="mb-0">2</h3>
                            <p class="mb-0">Skripsi Aktif</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dashboard-card stats-card animate__animated animate__fadeIn">
                            <h3 class="mb-0">2</h3>
                            <p class="mb-0">Jurusan</p>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="card dashboard-card mb-4 animate__animated animate__fadeInLeft">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <span>Aktivitas Skripsi Terbaru</span>
                                <button class="btn btn-sm btn-light">Lihat Semua</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Mahasiswa</th>
                                                <th>Judul Skripsi</th>
                                                <th>Status</th>
                                                <th>Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>John Doe</td>
                                                <td>Sample Skripsi 1</td>
                                                <td><span class="badge bg-warning">Pengajuan</span></td>
                                                <td>2023-01-01</td>
                                            </tr>
                                            <tr>
                                                <td>Jane Smith</td>
                                                <td>Sample Skripsi 2</td>
                                                <td><span class="badge bg-warning">Pengajuan</span></td>
                                                <td>2023-02-01</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card dashboard-card mb-4 animate__animated animate__fadeInRight">
                            <div class="card-header">Jadwal Mendatang</div>
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3 p-2 rounded-3 bg-light">
                                    <i class="fas fa-presentation text-primary me-2"></i>
                                    <div>
                                        <p class="mb-0 fw-semibold">Seminar Proposal</p>
                                        <small class="text-muted">7 hari lagi - Ruang 101</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-3 p-2 rounded-3 bg-light">
                                    <i class="fas fa-user-graduate text-success me-2"></i>
                                    <div>
                                        <p class="mb-0 fw-semibold">Sidang Skripsi</p>
                                        <small class="text-muted">14 hari lagi - Ruang 202</small>
                                    </div>
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