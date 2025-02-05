<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SIPENSI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #6366f1;
            --secondary-color: #8b5cf6;
            --accent-color: #a78bfa;
            --background-color: #f5f5ff;
            --card-background: #ffffff;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --border-radius: 20px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--background-color);
            padding-top: 70px;
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)) !important;
            color: white !important;
        }

        .sidebar {
            background: var(--card-background);
            width: 250px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding-top: 70px;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .card {
            border-radius: var(--border-radius);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .nav-link {
            color: var(--text-primary);
            padding: 10px 20px;
            border-radius: 5px;
            margin: 5px 15px;
        }

        .nav-link:hover {
            background: var(--background-color);
            color: var(--primary-color);
        }

        .nav-link.active {
            background: var(--primary-color);
            color: white;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }

        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .progress-bar {
            background-color: var(--primary-color);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <button class="btn btn-link text-light d-lg-none me-3" id="sidebar-toggle">
                <i class="fas fa-bars"></i>
            </button>
            <a class="navbar-brand" href="#">SIPENSI</a>
            <div class="ms-auto d-flex align-items-center">
                <div class="dropdown me-3">
                    <button class="btn btn-link text-light position-relative" type="button" id="notificationDropdown" data-bs-toggle="dropdown">
                        <i class="fas fa-bell"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            3
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                        <li><a class="dropdown-item" href="#">Bimbingan Baru</a></li>
                        <li><a class="dropdown-item" href="#">Deadline Dekat</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="btn btn-link p-0" type="button" id="userDropdown" data-bs-toggle="dropdown">
                        <img src="https://via.placeholder.com/40" alt="Profile" class="profile-img">
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Pengaturan</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="nav flex-column">
            <a href="#" class="nav-link active">
                <i class="fas fa-home me-2"></i>Dashboard
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-file-alt me-2"></i>Skripsi Saya
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-calendar me-2"></i>Jadwal Bimbingan
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-folder me-2"></i>Dokumen
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <!-- Progress Card -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Progress Skripsi</h5>
                            <h6 class="card-subtitle mb-3 text-muted">Analisis Media Sosial</h6>
                            <div class="progress mb-3">
                                <div class="progress-bar" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Pengumpulan Data</span>
                                <span class="text-primary fw-bold">65%</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Advisor Card -->
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="https://via.placeholder.com/100" alt="Advisor" class="rounded-circle mb-3">
                            <h5 class="card-title">Dr. John Doe</h5>
                            <p class="card-text text-muted">Pembimbing Utama</p>
                            <button class="btn btn-primary w-100">Mulai Konsultasi</button>
                        </div>
                    </div>
                </div>

                <!-- Schedules -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Jadwal Dekat</h5>
                            <div class="list-group">
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>Bimbingan Bab 2</span>
                                    <span class="badge bg-warning">2 hari lagi</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>Review Metodologi</span>
                                    <span class="badge bg-danger">Besok</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Documents -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Status Dokumen</h5>
                            <div class="list-group">
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>Proposal Skripsi</span>
                                    <span class="badge bg-success">Disetujui</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>Bab 1</span>
                                    <span class="badge bg-warning">Revisi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar on mobile
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebar-toggle');
            
            if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
                sidebar.classList.remove('show');
            }
        });

        // Current date and time display
        const currentDate = new Date('2025-02-04T17:19:19Z');
        document.querySelector('.navbar-brand').innerHTML += ` - ${currentDate.toLocaleDateString()}`;
    </script>
</body>

</html>