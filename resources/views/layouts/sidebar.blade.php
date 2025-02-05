{{-- resources/views/layouts/sidebar.blade.php --}}

<!-- Sidebar -->
<div class="sidebar vh-100 pt-5" id="sidebar">
    <!-- User Profile Section -->
    <div class="user-profile">
        @if(Auth::user()->foto_profile)
            <img src="{{ asset('storage/'.Auth::user()->foto_profile) }}" 
                 alt="{{ Auth::user()->name }}"
                 class="profile-image">
        @else
            <img src="{{ asset('images/default-avatar.png') }}" 
                 alt="{{ Auth::user()->name }}"
                 class="profile-image">
        @endif
        <div class="user-info">
            <h6 class="mb-1">{{ Auth::user()->name }}</h6>
            <small class="text-muted text-capitalize">{{ Auth::user()->role }}</small>
        </div>
    </div>

    <!-- Navigation Menu -->
    <div class="nav flex-column">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" 
           class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="mdi mdi-view-dashboard"></i>
            <span>Dashboard</span>
        </a>

        <!-- Role-based Menu Items -->
        @if(Auth::user()->role === 'mahasiswa')
            <!-- Skripsi Menu - Only for Students -->
            <a href="{{ route('thesis.index') }}" 
               class="nav-link {{ request()->routeIs('thesis.*') ? 'active' : '' }}">
                <i class="mdi mdi-file-document"></i>
                <span>Skripsi Saya</span>
            </a>
        @endif

        @if(Auth::user()->role === 'dosen')
            <!-- Bimbingan Menu - Only for Lecturers -->
            <a href="{{ route('guidance.index') }}" 
               class="nav-link {{ request()->routeIs('guidance.*') ? 'active' : '' }}">
                <i class="mdi mdi-account-group"></i>
                <span>Mahasiswa Bimbingan</span>
            </a>
        @endif

        <!-- Common Menu Items -->
        <a href="{{ route('schedule.index') }}" 
           class="nav-link {{ request()->routeIs('schedule.*') ? 'active' : '' }}">
            <i class="mdi mdi-calendar"></i>
            <span>Jadwal Bimbingan</span>
        </a>

        <a href="{{ route('documents.index') }}" 
           class="nav-link {{ request()->routeIs('documents.*') ? 'active' : '' }}">
            <i class="mdi mdi-folder"></i>
            <span>Dokumen</span>
        </a>

        @if(Auth::user()->role === 'admin')
            <!-- Admin Menu Items -->
            <div class="sidebar-heading">
                <span>Administrator</span>
            </div>

            <a href="{{ route('users.index') }}" 
               class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                <i class="mdi mdi-account-multiple"></i>
                <span>Manajemen User</span>
            </a>

            <a href="{{ route('settings.index') }}" 
               class="nav-link {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                <i class="mdi mdi-cog"></i>
                <span>Pengaturan Sistem</span>
            </a>
        @endif
    </div>

    <!-- Sidebar Footer -->
    <div class="sidebar-footer">
        <div class="current-time text-center">
            <small class="text-muted" id="current-date">
                {{ now()->translatedFormat('l, d F Y') }}
            </small>
            <br>
            <small class="text-muted" id="current-time">
                {{ now()->format('H:i:s') }}
            </small>
        </div>
    </div>
</div>

<style>
    /* Sidebar Specific Styles */
    .sidebar {
        background: var(--surface);
        width: 280px;
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 100;
        padding-top: 70px;
        box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    /* User Profile Section */
    .user-profile {
        padding: 1.5rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .profile-image {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        object-fit: cover;
    }

    .user-info h6 {
        font-weight: 600;
        margin: 0;
    }

    /* Navigation Links */
    .nav-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 1.5rem;
        color: var(--text-secondary);
        transition: all 0.3s ease;
        border-radius: 8px;
        margin: 4px 12px;
    }

    .nav-link:hover {
        background: rgba(99, 102, 241, 0.08);
        color: var(--primary);
    }

    .nav-link.active {
        background: var(--primary);
        color: white;
    }

    .nav-link i {
        font-size: 20px;
    }

    /* Sidebar Headings */
    .sidebar-heading {
        padding: 1.5rem 1.5rem 0.5rem;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-secondary);
        font-weight: 600;
    }

    /* Sidebar Footer */
    .sidebar-footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        padding: 1rem;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
        background: var(--surface);
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.show {
            transform: translateX(0);
        }
    }

    /* Dark Mode Support */
    @media (prefers-color-scheme: dark) {
        .sidebar {
            background: var(--dark-surface);
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }

        .nav-link {
            color: var(--dark-text);
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .sidebar-footer {
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            background: var(--dark-surface);
        }
    }
</style>

<script>
    // Update time every second
    function updateTime() {
        const now = new Date();
        document.getElementById('current-time').textContent = 
            now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
    }

    // Initial call and interval setup
    updateTime();
    setInterval(updateTime, 1000);

    // Handle sidebar toggle on mobile
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebar-toggle');

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('show');
            });
        }

        // Close sidebar when clicking outside
        document.addEventListener('click', function(event) {
            if (!sidebar.contains(event.target) && 
                !sidebarToggle.contains(event.target) && 
                sidebar.classList.contains('show')) {
                sidebar.classList.remove('show');
            }
        });
    });
</script>