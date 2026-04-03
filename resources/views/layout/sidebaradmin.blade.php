<nav class="sidebar">
    <div class="brand-section">
        <img src="{{ asset('images/logoaspirasi.png') }}" alt="Logo" style="max-height: 60px; margin-bottom: 15px;">
        <br>
        <div class="user-badge" style="background: linear-gradient(135deg, #1e293b 0%, #334155 100%);">
            <i class="bi bi-shield-lock-fill"></i> <span>ADMINISTRATOR</span>
        </div>
    </div>

    <div class="sidebar-menu" style="flex-grow: 1; padding-top: 20px;">
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill"></i> <span>Dashboard</span>
        </a>

        <a href="{{ route('admin.aspirasi') }}" class="nav-link {{ Request::is('admin/aspirasi*') ? 'active' : '' }}">
            <i class="bi bi-chat-square-dots-fill"></i> <span>Data Aspirasi</span>
        </a>

        {{-- MENU BARU: DATA KATEGORI --}}
        <a href="{{ route('admin.kategori') }}" class="nav-link {{ Request::is('admin/kategori*') ? 'active' : '' }}">
            <i class="bi bi-tags-fill"></i> <span>Data Kategori</span>
        </a>

        <a href="{{ route('admin.siswa') }}" class="nav-link {{ Request::is('admin/siswa*') ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i> <span>Data Siswa</span>
        </a>
    </div>

    <div class="logout-section">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="bi bi-box-arrow-right"></i> <span>Keluar Panel</span>
            </button>
        </form>
    </div>
</nav>