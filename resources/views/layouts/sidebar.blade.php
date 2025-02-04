<nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
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
            <li class="nav-item">
                <a class="nav-link {{ Request::is('sidang*') ? 'active' : '' }}" href="{{ route('sidang.index') }}">
                    <i class="fas fa-graduation-cap"></i> Sidang
                </a>
            </li>
        </ul>
    </div>
</nav>