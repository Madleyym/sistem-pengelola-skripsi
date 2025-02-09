<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dosen - SIPENSI Premium</title>

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
            --primary-color: #2563eb;
            --secondary-color: #1d4ed8;
            --background-color: #f8fafc;
            --card-background: #ffffff;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--background-color);
        }

        .dashboard-card {
            border-radius: 15px;
            background: var(--card-background);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border: none;
            transition: all 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .stats-card {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 15px;
            padding: 20px;
        }

        .card-header {
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 15px 15px 0 0 !important;
            border: none;
        }

        .table thead th {
            background: #f8fafc;
            padding: 12px;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 6px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top"
        style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color))">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SIPENSI</a>
            <div class="ms-auto d-flex align-items-center">
                <div class="dropdown me-3">
                    <a href="#" class="dropdown-toggle text-white text-decoration-none" data-bs-toggle="dropdown">
                        <i class="fas fa-bell"></i>
                        <span class="badge bg-danger rounded-circle ms-1">3</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Bimbingan baru</a></li>
                        <li><a class="dropdown-item" href="#">Deadline dekat</a></li>
                        <li><a class="dropdown-item" href="#">Jadwal sidang</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle text-white text-decoration-none" data-bs-toggle="dropdown">
                        <img src="/api/placeholder/40/40" class="rounded-circle border border-2 border-white"
                            alt="Profile">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
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

    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-white sidebar"
                style="margin-top: 56px; min-height: calc(100vh - 56px); padding-top: 20px; box-shadow: 0 0 20px rgba(0,0,0,0.05);">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-user-graduate me-2"></i>Mahasiswa Bimbingan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-calendar-alt me-2"></i>Jadwal Bimbingan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-file-alt me-2"></i>Dokumen Skripsi
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

            <!-- Main Content Area -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="margin-top: 76px;">
                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="dashboard-card stats-card animate__animated animate__fadeIn">
                            <h3 class="mb-0">12</h3>
                            <p class="mb-0">Mahasiswa Aktif</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dashboard-card stats-card animate__animated animate__fadeIn">
                            <h3 class="mb-0">5</h3>
                            <p class="mb-0">Jadwal Minggu Ini</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dashboard-card stats-card animate__animated animate__fadeIn">
                            <h3 class="mb-0">8</h3>
                            <p class="mb-0">Revisi Pending</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dashboard-card stats-card animate__animated animate__fadeIn">
                            <h3 class="mb-0">3</h3>
                            <p class="mb-0">Sidang Bulan Ini</p>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities & Schedule -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="card dashboard-card mb-4 animate__animated animate__fadeInLeft">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>Mahasiswa Bimbingan Aktif</span>
                                    <button class="btn btn-sm btn-light">Lihat Semua</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>NIM</th>
                                                <th>Judul Skripsi</th>
                                                <th>Progress</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Budi Santoso</td>
                                                <td>19001234</td>
                                                <td>Implementasi AI dalam IoT</td>
                                                <td>
                                                    <div class="progress" style="height: 8px;">
                                                        <div class="progress-bar" role="progressbar"
                                                            style="width: 75%"></div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-success">Aktif</span></td>
                                            </tr>
                                            <tr>
                                                <td>Ani Wijaya</td>
                                                <td>19001235</td>
                                                <td>Analisis Big Data</td>
                                                <td>
                                                    <div class="progress" style="height: 8px;">
                                                        <div class="progress-bar" role="progressbar"
                                                            style="width: 45%"></div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-warning">Revisi</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card dashboard-card mb-4 animate__animated animate__fadeInRight">
                            <div class="card-header">Jadwal Bimbingan</div>
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3 p-2 rounded-3 bg-light">
                                    <i class="fas fa-calendar-check text-primary me-2"></i>
                                    <div>
                                        <p class="mb-0 fw-semibold">Bimbingan BAB 3 - Budi</p>
                                        <small class="text-muted">Hari ini, 14:00</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-3 p-2 rounded-3 bg-light">
                                    <i class="fas fa-calendar text-warning me-2"></i>
                                    <div>
                                        <p class="mb-0 fw-semibold">Review Proposal - Ani</p>
                                        <small class="text-muted">Besok, 10:00</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center p-2 rounded-3 bg-light">
                                    <i class="fas fa-calendar text-info me-2"></i>
                                    <div>
                                        <p class="mb-0 fw-semibold">Sidang Skripsi - Deni</p>
                                        <small class="text-muted">25 Feb, 13:00</small>
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
