  
  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>@yield('title', 'SIPENSI') - Sistem Informasi Penelitian Skripsi</title>
  
      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
      @vite(['resources/css/app.css'])
      <!-- Custom CSS -->
      <style>
          :root {
              --primary-color: #4F46E5;
              --primary-dark: #4338CA;
              --secondary-color: #6B7280;
              --success-color: #059669;
              --danger-color: #DC2626;
              --warning-color: #D97706;
              --info-color: #2563EB;
          }
  
          body {
              font-family: 'Inter', sans-serif;
              background-color: #F3F4F6;
              padding-top: 60px;
          }
  
          /* Navbar Styling */
          .navbar {
              box-shadow: 0 2px 4px rgba(0,0,0,.08);
              background: linear-gradient(to right, var(--primary-color), var(--primary-dark));
              padding: 0.75rem 1rem;
          }
  
          .navbar-brand {
              font-weight: 700;
              font-size: 1.25rem;
              color: white !important;
          }
  
          .navbar-dark .navbar-nav .nav-link {
              color: rgba(255,255,255,.9);
              font-weight: 500;
              padding: 0.5rem 1rem;
              transition: all 0.2s;
          }
  
          .navbar-dark .navbar-nav .nav-link:hover {
              color: white;
              background-color: rgba(255,255,255,.1);
              border-radius: 0.375rem;
          }
  
          /* Sidebar Styling */
          .sidebar {
              position: fixed;
              top: 60px;
              bottom: 0;
              left: 0;
              z-index: 100;
              padding: 0;
              box-shadow: 0 4px 6px -1px rgba(0,0,0,.1);
              background-color: white;
              transition: all 0.3s ease;
          }
  
          .sidebar-sticky {
              position: relative;
              top: 0;
              height: calc(100vh - 60px);
              padding: 1rem 0;
              overflow-x: hidden;
              overflow-y: auto;
          }
  
          .sidebar .nav-link {
              padding: 0.75rem 1.5rem;
              color: var(--secondary-color);
              display: flex;
              align-items: center;
              gap: 0.75rem;
              transition: all 0.2s;
              border-left: 3px solid transparent;
              font-size: 0.875rem;
          }
  
          .sidebar .nav-link:hover {
              color: var(--primary-color);
              background-color: #F3F4F6;
          }
  
          .sidebar .nav-link.active {
              color: var(--primary-color);
              background-color: #EEF2FF;
              border-left-color: var(--primary-color);
              font-weight: 600;
          }
  
          .sidebar .nav-link i {
              font-size: 1rem;
              width: 1.25rem;
              text-align: center;
          }
  
          /* Main Content Area */
          main {
              background-color: #F3F4F6;
              min-height: calc(100vh - 60px);
              padding: 1.5rem;
              transition: all 0.3s ease;
          }
  
          /* Card Styling */
          .card {
              border: none;
              border-radius: 0.75rem;
              box-shadow: 0 1px 3px rgba(0,0,0,.1);
              transition: all 0.3s ease;
          }
  
          .card:hover {
              box-shadow: 0 4px 6px -1px rgba(0,0,0,.1);
          }
  
          /* Button Styling */
          .btn {
              font-weight: 500;
              padding: 0.5rem 1rem;
              border-radius: 0.5rem;
              transition: all 0.2s;
          }
  
          .btn-primary {
              background: linear-gradient(to right, var(--primary-color), var(--primary-dark));
              border: none;
          }
  
          .btn-primary:hover {
              transform: translateY(-1px);
              box-shadow: 0 4px 6px -1px rgba(79,70,229,.3);
          }
  
          /* Dropdown Styling */
          .dropdown-menu {
              border: none;
              box-shadow: 0 4px 6px -1px rgba(0,0,0,.1);
              border-radius: 0.5rem;
              padding: 0.5rem;
          }
  
          .dropdown-item {
              padding: 0.5rem 1rem;
              border-radius: 0.375rem;
              transition: all 0.2s;
          }
  
          .dropdown-item:hover {
              background-color: #F3F4F6;
              color: var(--primary-color);
          }
  
          /* Table Styling */
          .table {
              border-radius: 0.5rem;
              overflow: hidden;
          }
  
          .table thead th {
              background-color: #F9FAFB;
              border-bottom: 2px solid #E5E7EB;
              font-weight: 600;
              text-transform: uppercase;
              font-size: 0.75rem;
              letter-spacing: 0.05em;
          }
  
          /* Form Controls */
          .form-control {
              border-radius: 0.5rem;
              border: 1px solid #E5E7EB;
              padding: 0.625rem;
          }
  
          .form-control:focus {
              border-color: var(--primary-color);
              box-shadow: 0 0 0 3px rgba(79,70,229,.2);
          }
  
          /* Responsive Adjustments */
          @media (max-width: 768px) {
              .sidebar {
                  margin-left: -100%;
              }
              
              .sidebar.show {
                  margin-left: 0;
              }
  
              main {
                  width: 100%;
              }
          }
  
          /* Custom Scrollbar */
          ::-webkit-scrollbar {
              width: 6px;
          }
  
          ::-webkit-scrollbar-track {
              background: #F3F4F6;
          }
  
          ::-webkit-scrollbar-thumb {
              background: #D1D5DB;
              border-radius: 3px;
          }
  
          ::-webkit-scrollbar-thumb:hover {
              background: #9CA3AF;
          }
      </style>
      @stack('styles')
  </head>
  
  <body>
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
          <div class="container-fluid">
              <a class="navbar-brand" href="{{ url('/') }}">
                  <i class="fas fa-graduation-cap me-2"></i>SIPENSI
              </a>
              <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                  <span class="navbar-toggler-icon"></span>
              </button>
  
              <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav ms-auto align-items-center">
                      @guest
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('login') }}">
                              <i class="fas fa-sign-in-alt me-1"></i> Login
                          </a>
                      </li>
                      @else
                      <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                              <div class="d-flex align-items-center justify-content-center bg-white bg-opacity-25 rounded-circle" style="width: 32px; height: 32px;">
                                  <span class="text-white">{{ substr(Auth::user()->name, 0, 1) }}</span>
                              </div>
                              {{ Auth::user()->name }}
                          </a>
                          <ul class="dropdown-menu dropdown-menu-end">
                              <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                                  <i class="fas fa-user me-2"></i> Profile
                              </a></li>
                              <li><hr class="dropdown-divider"></li>
                              <li>
                                  <form method="POST" action="{{ route('logout') }}">
                                      @csrf
                                      <button type="submit" class="dropdown-item text-danger">
                                          <i class="fas fa-sign-out-alt me-2"></i> Logout
                                      </button>
                                  </form>
                              </li>
                          </ul>
                      </li>
                      @endguest
                  </ul>
              </div>
          </div>
      </nav>
  
      <!-- Sidebar & Content -->
      <div class="container-fluid">
          <div class="row">
              <!-- Sidebar -->
              @auth
              <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar">
                  <div class="sidebar-sticky">
                      <ul class="nav flex-column">
                          <li class="nav-item">
                              <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                  <i class="fas fa-tachometer-alt"></i>
                                  <span>Dashboard</span>
                              </a>
                          </li>
                          @if(auth()->user()->role == 'admin')
                          <li class="nav-item">
                              <a class="nav-link {{ Request::is('users*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                                  <i class="fas fa-users"></i>
                                  <span>Users</span>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link {{ Request::is('dosen*') ? 'active' : '' }}" href="{{ route('dosen.index') }}">
                                  <i class="fas fa-chalkboard-teacher"></i>
                                  <span>Dosen</span>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link {{ Request::is('mahasiswa*') ? 'active' : '' }}" href="{{ route('mahasiswa.index') }}">
                                  <i class="fas fa-user-graduate"></i>
                                  <span>Mahasiswa</span>
                              </a>
                          </li>
                          @endif
                          <li class="nav-item">
                              <a class="nav-link {{ Request::is('skripsi*') ? 'active' : '' }}" href="{{ route('skripsi.index') }}">
                                  <i class="fas fa-book"></i>
                                  <span>Skripsi</span>
                              </a>
                          </li>
                            {{-- <li class="nav-item">
                            <a class="nav-link {{ Request::is('sidang*') ? 'active' : '' }}" href="{{ route('sidang.index') }}">
                                <i class="fas fa-graduation-cap"></i> Sidang
                            </a>
                        </li> --}}
                      </ul>
                  </div>
              </nav>
              @endauth
  
              <!-- Main Content -->
              <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                  @yield('content')
              </main>
          </div>
      </div>
  
      <!-- jQuery -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <!-- Bootstrap Bundle JS -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
      <!-- Custom JS -->
      <script>
          // Toggle sidebar on mobile
          document.querySelector('.navbar-toggler').addEventListener('click', function() {
              document.querySelector('#sidebar').classList.toggle('show');
          });
  
          // Close sidebar when clicking outside on mobile
          document.addEventListener('click', function(event) {
              const sidebar = document.querySelector('#sidebar');
              const toggler = document.querySelector('.navbar-toggler');
              if (window.innerWidth < 768 && 
                  !sidebar.contains(event.target) && 
                  !toggler.contains(event.target) &&
                  sidebar.classList.contains('show')) {
                  sidebar.classList.remove('show');
              }
          });
      </script>
      @stack('scripts')
  </body>
  </html>
  
  
  
