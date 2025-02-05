```php
@extends('layouts.layout')

@push('styles')
<style>
    body {
        padding-top: 56px;
    }

    .sidebar {
        position: fixed;
        top: 56px;
        bottom: 0;
        left: 0;
        z-index: 100;
        padding: 48px 0 0;
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        background-color: #f8f9fa;
        transition: transform 0.3s ease;
    }

    @media (max-width: 767px) {
        .sidebar {
            transform: translateX(-100%);
            width: 250px;
        }
        
        .sidebar.show {
            transform: translateX(0);
        }
    }

    .sidebar-sticky {
        position: relative;
        top: 0;
        height: calc(100vh - 48px);
        padding-top: .5rem;
        overflow-x: hidden;
        overflow-y: auto;
    }

    .sidebar .nav-link {
        font-weight: 500;
        color: #333;
        padding: 0.5rem 1rem;
        transition: all 0.3s ease;
    }

    .sidebar .nav-link:hover, 
    .sidebar .nav-link.active {
        background-color: rgba(0,123,255,0.1);
        color: #007bff;
    }

    main {
        padding-top: 20px;
    }

    .navbar-brand {
        font-weight: 600;
    }

    .nav-item-mobile-only {
        display: none;
    }

    @media (max-width: 767px) {
        .nav-item-desktop-only {
            display: none;
        }

        .nav-item-mobile-only {
            display: block;
        }
    }
</style>
@endpush

@section('content')
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">SIPENSI</a>
            
            <div class="d-flex align-items-center">
                <!-- Mobile Sidebar Toggle -->
                <button class="navbar-toggler me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Mobile Profile Dropdown -->
                <div class="nav-item dropdown nav-item-mobile-only">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="mobileNavbarDropdown" role="button" data-bs-toggle="dropdown">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    @else
                    <li class="nav-item dropdown nav-item-desktop-only">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="offcanvas offcanvas-start sidebar" tabindex="-1" id="sidebar">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            @auth
            <div class="position-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    @if(auth()->user()->role == 'admin')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('users*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                            <i class="fas fa-users"></i> Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dosen*') ? 'active' : '' }}" href="{{ route('dosen.index') }}">
                            <i class="fas fa-chalkboard-teacher"></i> Dosen
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('mahasiswa*') ? 'active' : '' }}" href="{{ route('mahasiswa.index') }}">
                            <i class="fas fa-user-graduate"></i> Mahasiswa
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('skripsi*') ? 'active' : '' }}" href="{{ route('skripsi.index') }}">
                            <i class="fas fa-book"></i> Skripsi
                        </a>
                    </li>
                    
                </ul>
            </div>
            @endauth
        </div>
    </div>

    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">
            <main class="col-12 ms-sm-auto px-md-4">
                @yield('dashboard-content')
            </main>
        </div>
    </div>
@endsection
```