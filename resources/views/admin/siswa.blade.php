<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa - Admin Aspirasiku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #4361ee;
            --primary-dark: #1d2433;
            --accent-purple: #7209b7;
            --bg-soft: #f8f9fc;
            --white: #ffffff;
            --gray-200: #e5e7eb;
            --gray-600: #6b7280;
            --gray-900: #1f2937;
            --danger: #ef4444;
        }

        body {
            background-color: var(--bg-soft);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--gray-900);
        }

        .sidebar {
            background: var(--white);
            height: 100vh;
            position: fixed;
            width: 280px;
            left: 0;
            top: 0;
            border-right: 1px solid var(--gray-200);
            display: flex;
            flex-direction: column;
            z-index: 1000;
        }

        .brand-section { padding: 30px 25px; text-align: center; border-bottom: 1px solid var(--gray-200); }
        .user-badge {
            background: var(--primary-dark);
            color: white; padding: 8px 18px; border-radius: 20px; font-weight: 600; font-size: 0.75rem;
            display: inline-flex; align-items: center; gap: 8px;
        }

        .nav-link {
            color: var(--gray-600); padding: 14px 18px; border-radius: 12px; margin: 5px 15px;
            display: flex; align-items: center; gap: 12px; text-decoration: none;
            transition: 0.3s; font-weight: 500;
        }
        .nav-link:hover, .nav-link.active {
            color: var(--primary-blue); background: rgba(67, 97, 238, 0.08);
        }
        .nav-link.active { font-weight: 700; background: rgba(67, 97, 238, 0.1); }

        .main-content { margin-left: 280px; padding: 40px; width: calc(100% - 280px); }

        .logout-section { padding: 20px 15px; border-top: 1px solid var(--gray-200); }
        .logout-btn {
            width: 100%; padding: 12px; border-radius: 12px; background: #fff5f5;
            color: var(--danger); font-weight: 600; display: flex; align-items: center;
            justify-content: center; gap: 10px; border: none; transition: 0.3s;
        }
        .logout-btn:hover { background: var(--danger); color: white; }

        /* Search Bar */
        .search-wrapper .input-group {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        }
        .search-wrapper .input-group-text {
            background: white;
            border-right: 0;
            border-color: var(--gray-200);
            padding-left: 16px;
        }
        .search-wrapper .form-control {
            border-left: 0;
            border-color: var(--gray-200);
            font-size: 0.9rem;
        }
        .search-wrapper .form-control:focus {
            box-shadow: none;
            border-color: var(--primary-blue);
        }
        .search-wrapper .input-group:focus-within .input-group-text {
            border-color: var(--primary-blue);
        }
        #searchInfo {
            font-size: 0.8rem;
            color: var(--gray-600);
            white-space: nowrap;
        }

        /* Detail Modal */
        .detail-avatar {
            width: 72px; height: 72px;
            background: linear-gradient(135deg, var(--primary-blue), var(--accent-purple));
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.8rem; color: white; font-weight: 700;
            margin: 0 auto 16px;
        }
        .detail-item {
            display: flex; flex-direction: column;
            background: var(--bg-soft);
            border-radius: 12px;
            padding: 14px 16px;
            margin-bottom: 10px;
        }
        .detail-item .label {
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--gray-600);
            margin-bottom: 4px;
        }
        .detail-item .value {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--gray-900);
        }
        .badge-kelas-detail {
            display: inline-block;
            background: rgba(67, 97, 238, 0.1);
            color: var(--primary-blue);
            font-weight: 700;
            font-size: 0.85rem;
            padding: 4px 14px;
            border-radius: 20px;
        }

        @media (max-width: 992px) {
            .sidebar { width: 80px; }
            .sidebar span, .user-badge span { display: none; }
            .main-content { margin-left: 80px; width: calc(100% - 80px); }
        }
    </style>
</head>
<body>

@include('layout.sidebaradmin')

<main class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-800 text-dark mb-1" style="font-weight: 800;">Manajemen Siswa</h2>
            <p class="text-muted small">Kelola data siswa SMKN 4 Tangerang TP 2025/2026.</p>
        </div>
        <button class="btn btn-primary rounded-pill px-4 py-2 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-person-plus-fill me-2"></i> Tambah Siswa
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 p-3">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    {{-- Search Bar --}}
    <div class="d-flex align-items-center gap-3 mb-3 search-wrapper">
        <div class="input-group" style="max-width: 380px;">
            <span class="input-group-text">
                <i class="bi bi-search text-muted"></i>
            </span>
            <input type="text" id="searchInput" class="form-control" placeholder="Cari nama atau NISN...">
        </div>
        <span id="searchInfo"></span>
    </div>

    <div class="card card-custom overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary small text-uppercase">
                    <tr>
                        <th class="ps-4 py-3">NISN / Username</th>
                        <th class="py-3">Nama Lengkap</th>
                        <th class="py-3 text-center">Kelas</th>
                        <th class="pe-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="siswaTable">
                    @forelse($siswa as $s)
                    <tr>
                        <td class="ps-4">
                            <span class="fw-bold text-dark">{{ $s->nisn }}</span>
                        </td>
                        <td>{{ $s->nama_lengkap }}</td>
                        <td class="text-center">
                            <span class="badge-kelas small">{{ $s->kelas }}</span>
                        </td>
                        <td class="pe-4 text-center">
                            <div class="d-flex justify-content-center gap-2">

                                {{-- VIEW --}}
                                <button class="btn btn-sm btn-outline-primary rounded-pill px-3"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalDetail{{ $s->nisn }}">
                                    <i class="bi bi-eye-fill"></i> Detail
                                </button>

                                {{-- UPDATE (Reset Password) --}}
                                <button class="btn btn-sm btn-outline-warning rounded-pill px-3"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalReset{{ $s->nisn }}">
                                    <i class="bi bi-key-fill"></i> Reset
                                </button>

                                {{-- DELETE --}}
                                <form action="{{ route('admin.siswa.destroy', $s->nisn) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm btn-outline-danger border-0 rounded-circle"
                                            onclick="return confirm('Hapus siswa {{ $s->nama_lengkap }}?')">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>

                    {{-- ===== MODAL DETAIL (VIEW) ===== --}}
                    <div class="modal fade" id="modalDetail{{ $s->nisn }}" tabindex="-1">
                        <div class="modal-dialog modal-sm modal-dialog-centered">
                            <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
                                <div class="modal-header border-0 pb-0">
                                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body px-4 pb-4 pt-1 text-center">
                                    <div class="detail-avatar">
                                        {{ strtoupper(substr($s->nama_lengkap, 0, 1)) }}
                                    </div>
                                    <h6 class="fw-bold mb-1">{{ $s->nama_lengkap }}</h6>
                                    <p class="text-muted small mb-4">Siswa Aktif</p>

                                    <div class="text-start">
                                        <div class="detail-item">
                                            <span class="label"><i class="bi bi-person-badge me-1"></i>NISN</span>
                                            <span class="value">{{ $s->nisn }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="label"><i class="bi bi-person me-1"></i>Nama Lengkap</span>
                                            <span class="value">{{ $s->nama_lengkap }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="label"><i class="bi bi-mortarboard me-1"></i>Kelas</span>
                                            <span class="value">
                                                <span class="badge-kelas-detail">{{ $s->kelas }}</span>
                                            </span>
                                        </div>
                                        <div class="detail-item mb-0">
                                            <span class="label"><i class="bi bi-calendar-check me-1"></i>Tanggal Daftar</span>
                                            <span class="value">
                                                {{ \Carbon\Carbon::parse($s->created_at)->translatedFormat('d F Y, H:i') }} WIB
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- ===== END MODAL DETAIL ===== --}}

                    {{-- ===== MODAL RESET PASSWORD (UPDATE) ===== --}}
                    <div class="modal fade" id="modalReset{{ $s->nisn }}" tabindex="-1">
                        <div class="modal-dialog modal-sm modal-dialog-centered">
                            <div class="modal-content border-0 rounded-4 shadow">
                                <form action="{{ route('admin.siswa.updatePassword', $s->nisn) }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="modal-header border-0">
                                        <h6 class="fw-bold mb-0">Reset Password</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body py-0">
                                        <p class="text-muted small">Siswa: <strong>{{ $s->nama_lengkap }}</strong></p>
                                        <input type="password" name="password" class="form-control" placeholder="Password Baru" required minlength="6">
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="submit" class="btn btn-warning w-100 rounded-pill fw-bold">Update Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- ===== END MODAL RESET PASSWORD ===== --}}

                    @empty
                    <tr><td colspan="4" class="text-center py-5 text-muted">Belum ada data siswa.</td></tr>
                    @endforelse

                    <tr id="noResult" style="display:none;">
                        <td colspan="4" class="text-center py-5 text-muted">
                            <i class="bi bi-search me-2"></i> Tidak ada siswa yang cocok dengan pencarian.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>

{{-- ===== MODAL TAMBAH SISWA (CREATE) ===== --}}
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
            <form action="{{ route('admin.siswa.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white p-4">
                    <h5 class="modal-title fw-bold">Daftarkan Siswa Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">NISN (Username)</label>
                            <input type="text" name="nisn" class="form-control" required placeholder="Contoh: 0081234567">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Password Akun</label>
                            <input type="password" name="password" class="form-control" required placeholder="Minimal 6 Karakter">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nama Lengkap Siswa</label>
                        <input type="text" name="nama_lengkap" class="form-control" required placeholder="Masukkan nama sesuai absen">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Pilih Kelas</label>
                        <select name="kelas" class="form-select shadow-none" required>
                            <option value="" hidden>Klik untuk memilih kelas...</option>
                            <optgroup label="GEOMATIKA">
                                <option value="X GEOMATIKA">X GEOMATIKA</option>
                                <option value="XI GEOMATIKA">XI GEOMATIKA</option>
                                <option value="XII GEOMATIKA">XII GEOMATIKA</option>
                            </optgroup>
                            <optgroup label="DPIB">
                                <option value="X DPIB 1">X DPIB 1</option><option value="X DPIB 2">X DPIB 2</option>
                                <option value="XI DPIB 1">XI DPIB 1</option><option value="XI DPIB 2">XI DPIB 2</option>
                                <option value="XII DPIB 1">XII DPIB 1</option><option value="XII DPIB 2">XII DPIB 2</option>
                            </optgroup>
                            <optgroup label="TKP">
                                <option value="X TKP">X TKP</option><option value="XI TKP">XI TKP</option>
                                <option value="XII TKP 1">XII TKP 1</option><option value="XII TKP 2">XII TKP 2</option>
                            </optgroup>
                            <optgroup label="TPG (LAS)">
                                <option value="X TPG">X TPG</option><option value="XI TPG">XI TPG</option><option value="XII TPG">XII TPG</option>
                            </optgroup>
                            <optgroup label="TITL (LISTRIK)">
                                <option value="X TITL 1">X TITL 1</option><option value="X TITL 2">X TITL 2</option><option value="X TITL 3">X TITL 3</option>
                                <option value="XI TITL 1">XI TITL 1</option><option value="XI TITL 2">XI TITL 2</option><option value="XI TITL 3">XI TITL 3</option>
                                <option value="XII TITL 1">XII TITL 1</option><option value="XII TITL 2">XII TITL 2</option><option value="XII TITL 3">XII TITL 3</option>
                            </optgroup>
                            <optgroup label="TO (OTOMASI)">
                                <option value="X OTOMASI">X OTOMASI</option><option value="XI OTOMASI">XI OTOMASI</option><option value="XII OTOMASI">XII OTOMASI</option>
                            </optgroup>
                            <optgroup label="TM (MESIN)">
                                <option value="X MESIN 1">X MESIN 1</option><option value="X MESIN 2">X MESIN 2</option>
                                <option value="XI MESIN 1">XI MESIN 1</option><option value="XI MESIN 2">XI MESIN 2</option>
                                <option value="XII MESIN 1">XII MESIN 1</option><option value="XII MESIN 2">XII MESIN 2</option>
                            </optgroup>
                            <optgroup label="TMI / DGM">
                                <option value="X TMI">X TMI</option><option value="XI TMI">XI TMI</option><option value="XII TMI">XII TMI</option>
                                <option value="X DGM">X DGM</option><option value="XI DGM">XI DGM</option><option value="XII DGM">XII DGM</option>
                            </optgroup>
                            <optgroup label="RPL">
                                <option value="X RPL 1">X RPL 1</option><option value="X RPL 2">X RPL 2</option>
                                <option value="XI RPL 1">XI RPL 1</option><option value="XI RPL 2">XI RPL 2</option>
                                <option value="XII RPL 1">XII RPL 1</option><option value="XII RPL 2">XII RPL 2</option><option value="XII RPL 3">XII RPL 3</option>
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4">
                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-3 fw-bold shadow">Simpan & Daftarkan Siswa</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- ===== END MODAL TAMBAH ===== --}}

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const searchInput = document.getElementById('searchInput');
    const siswaTable  = document.getElementById('siswaTable');
    const searchInfo  = document.getElementById('searchInfo');
    const noResult    = document.getElementById('noResult');

    searchInput.addEventListener('input', function () {
        const keyword = this.value.toLowerCase().trim();
        const rows = Array.from(siswaTable.querySelectorAll('tr')).filter(r => r.id !== 'noResult');
        let visibleCount = 0;

        rows.forEach(row => {
            const nisn = row.cells[0]?.innerText.toLowerCase() ?? '';
            const nama = row.cells[1]?.innerText.toLowerCase() ?? '';
            const match = nisn.includes(keyword) || nama.includes(keyword);
            row.style.display = match ? '' : 'none';
            if (match) visibleCount++;
        });

        noResult.style.display = (keyword && visibleCount === 0) ? '' : 'none';
        searchInfo.textContent  = keyword ? `${visibleCount} siswa ditemukan` : '';
    });
</script>
</body>
</html>
