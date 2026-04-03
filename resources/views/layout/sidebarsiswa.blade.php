<nav class="sidebar">
    <div class="brand-section">
        <img src="{{ asset('images/logoaspirasi.png') }}" alt="Logo" style="max-height: 60px; margin-bottom: 15px;">
        <br>
        <div class="user-badge">
            <i class="bi bi-person-badge"></i> <span>SISWA</span>
        </div>
    </div>

    <div class="sidebar-menu" style="flex-grow: 1; padding-top: 20px;">
        <a href="{{ route('siswa.dashboard') }}" class="nav-link {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill"></i> <span>Dashboard</span>
        </a>
        <a href="{{ route('aspirasi.create') }}" class="nav-link {{ request()->routeIs('aspirasi.create') ? 'active' : '' }}">
            <i class="bi bi-pencil-square"></i> <span>Buat Aspirasi</span>
        </a>
        <a href="{{ route('aspirasi.index') }}" class="nav-link {{ request()->routeIs('aspirasi.index') ? 'active' : '' }}">
            <i class="bi bi-card-list"></i> <span>Riwayat</span>
        </a>
    </div>

    <div class="logout-section">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="bi bi-box-arrow-right"></i> <span>Logout</span>
            </button>
        </form>
    </div>
</nav>
