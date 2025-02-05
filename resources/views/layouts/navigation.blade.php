{{-- resources/views/layouts/navigation.blade.php --}}

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top bg-white">
    <div class="container-fluid">
        <!-- Sidebar Toggle Button -->
        <button class="btn btn-link d-lg-none me-2" id="sidebar-toggle">
            <i class="mdi mdi-menu"></i>
        </button>

        <!-- Brand Logo -->
        <a class="navbar-brand fw-bold text-primary" href="{{ route('dashboard') }}">
            <i class="mdi mdi-school me-2"></i>SIPENSI
        </a>

        <!-- Right Navigation Items -->
        <div class="ms-auto d-flex align-items-center gap-3">
            <!-- Notifications Dropdown -->
            <div class="dropdown">
                <button class="btn btn-link position-relative" data-bs-toggle="dropdown" 
                        aria-expanded="false" id="notificationDropdown">
                    <i class="mdi mdi-bell text-secondary"></i>
                    @if($unreadNotifications = Auth::user()->unreadNotifications->count())
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $unreadNotifications > 99 ? '99+' : $unreadNotifications }}
                        </span>
                    @endif
                </button>
                <ul class="dropdown-menu dropdown-menu-end notification-dropdown">
                    <li class="dropdown-header">
                        <h6 class="mb-0">Notifikasi</h6>
                        @if($unreadNotifications)
                            <small class="text-muted">{{ $unreadNotifications }} pesan baru</small>
                        @endif
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    @forelse(Auth::user()->notifications()->latest()->limit(5)->get() as $notification)
                        <li>
                            <a class="dropdown-item {{ $notification->read_at ? '' : 'unread' }}" 
                               href="{{ route('notifications.show', $notification->id) }}">
                                <i class="mdi {{ $notification->data['icon'] ?? 'mdi-bell' }} me-2"></i>
                                <div>
                                    <p class="mb-0">{{ $notification->data['message'] }}</p>
                                    <small class="text-muted">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </small>
                                </div>
                            </a>
                        </li>
                    @empty
                        <li>
                            <div class="dropdown-item text-center text-muted">
                                Tidak ada notifikasi
                            </div>
                        </li>
                    @endforelse
                    @if(Auth::user()->notifications->count() > 5)
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-center" href="{{ route('notifications.index') }}">
                                Lihat Semua Notifikasi
                            </a>
                        </li>
                    @endif
                </ul>
            </div>

            <!-- Vertical Divider -->
            <div class="vr"></div>

            <!-- User Profile Dropdown -->
            <div class="dropdown">
                <button class="btn btn-link p-0 d-flex align-items-center gap-2" 
                        data-bs-toggle="dropdown" aria-expanded="false">
                    @if(Auth::user()->foto_profile)
                        <img src="{{ asset('storage/'.Auth::user()->foto_profile) }}" 
                             alt="{{ Auth::user()->name }}" 
                             class="rounded-circle" 
                             width="32" 
                             height="32">
                    @else
                        <img src="{{ asset('images/default-avatar.png') }}" 
                             alt="{{ Auth::user()->name }}" 
                             class="rounded-circle" 
                             width="32" 
                             height="32">
                    @endif
                    <span class="d-none d-md-inline text-secondary">{{ Auth::user()->name }}</span>
                    <i class="mdi mdi-chevron-down text-secondary"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="mdi mdi-account me-2"></i>Profil
                        </a>
                    </li>
                    @if(Auth::user()->role === 'admin')
                        <li>
                            <a class="dropdown-item" href="{{ route('settings.index') }}">
                                <i class="mdi mdi-cog me-2"></i>Pengaturan
                            </a>
                        </li>
                    @endif
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" id="logout-form">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="mdi mdi-logout me-2"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<style>
    /* Navbar Styles */
    .navbar {
        padding: 0.5rem 1rem;
        background: var(--surface) !important;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.03);
    }

    .navbar-brand {
        font-size: 1.25rem;
        color: var(--primary) !important;
    }

    /* Notification Styles */
    .notification-dropdown {
        width: 320px;
        padding: 0;
        max-height: 480px;
        overflow-y: auto;
    }

    .notification-dropdown .dropdown-header {
        padding: 1rem;
        background: rgba(var(--bs-primary-rgb), 0.05);
    }

    .notification-dropdown .dropdown-item {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        white-space: normal;
    }

    .notification-dropdown .dropdown-item.unread {
        background: rgba(var(--bs-primary-rgb), 0.05);
    }

    .notification-dropdown .dropdown-item:last-child {
        border-bottom: none;
    }

    /* User Dropdown Styles */
    .dropdown-menu {
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
    }

    .dropdown-item {
        padding: 0.5rem 1rem;
        color: var(--text-primary);
        transition: all 0.2s;
    }

    .dropdown-item:hover {
        background: rgba(var(--bs-primary-rgb), 0.05);
        color: var(--primary);
    }

    .dropdown-item.text-danger:hover {
        background: rgba(var(--bs-danger-rgb), 0.05);
        color: var(--bs-danger);
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .navbar {
            padding: 0.25rem 0.5rem;
        }

        .notification-dropdown {
            width: 280px;
        }
    }

    /* Dark Mode Support */
    @media (prefers-color-scheme: dark) {
        .navbar {
            background: var(--dark-surface) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .dropdown-menu {
            background: var(--dark-surface);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .dropdown-item {
            color: var(--dark-text);
        }

        .notification-dropdown .dropdown-item {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .notification-dropdown .dropdown-header {
            background: rgba(255, 255, 255, 0.05);
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mark notifications as read when dropdown is opened
        const notificationDropdown = document.getElementById('notificationDropdown');
        if (notificationDropdown) {
            notificationDropdown.addEventListener('show.bs.dropdown', function() {
                fetch('{{ route("notifications.markAsRead") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                });
            });
        }

        // Prevent dropdown from closing when clicking inside notification items
        const notificationItems = document.querySelectorAll('.notification-dropdown .dropdown-item');
        notificationItems.forEach(item => {
            item.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });
    });
</script>