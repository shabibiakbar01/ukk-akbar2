<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kategori - Aspirasiku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-blue: #4361ee;
            --primary-dark: #1d2433;
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

        /* Sidebar Copy dari Aspirasi */
        .sidebar {
            background: var(--white); height: 100vh;
            position: fixed; width: 280px; left: 0; top: 0;
            border-right: 1px solid var(--gray-200);
            display: flex; flex-direction: column; z-index: 1000;
        }
        .brand-section { padding: 30px 25px; text-align: center; border-bottom: 1px solid var(--gray-200); }
        .user-badge {
            background: var(--primary-dark); color: white;
            padding: 8px 18px; border-radius: 20px; font-weight: 600; font-size: 0.75rem;
            display: inline-flex; align-items: center; gap: 8px;
        }
        .nav-link {
            color: var(--gray-600); padding: 14px 18px; border-radius: 12px; margin: 5px 15px;
            display: flex; align-items: center; gap: 12px; text-decoration: none;
            transition: 0.3s; font-weight: 500;
        }
        .nav-link:hover, .nav-link.active { color: var(--primary-blue); background: rgba(67,97,238,0.08); }
        .nav-link.active { font-weight: 700; background: rgba(67,97,238,0.1); }

        .main-content { margin-left: 280px; padding: 40px; width: calc(100% - 280px); }

        .card-custom {
            background: white; border: none;
            border-radius: 24px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.04);
            overflow: hidden;
        }

        .logout-section { padding: 20px 15px; border-top: 1px solid var(--gray-200); }
        .logout-btn {
            width: 100%; padding: 12px; border-radius: 12px; background: #fff5f5;
            color: var(--danger); font-weight: 600; display: flex; align-items: center;
            justify-content: center; gap: 10px; border: none; transition: 0.3s;
        }
        .logout-btn:hover { background: var(--danger); color: white; }

        @media (max-width: 992px) {
            .sidebar { width: 80px; }
            .sidebar span, .user-badge span { display: none; }
            .main-content { margin-left: 80px; width: calc(100% - 80px); }
        }
    </style>
</head>
<body>

{{-- Kamu memanggil sidebar lewat include, pastikan file ini ada --}}
@include('layout.sidebaradmin')

<main class="main-content">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 style="font-weight: 800; color: var(--primary-dark);">Manajemen Kategori</h2>
            <p class="text-muted small">Kelola daftar kategori aspirasi untuk mempermudah klasifikasi.</p>
        </div>
        <button class="btn btn-primary rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahKategori">
            <i class="bi bi-plus-lg me-2"></i> Tambah Kategori
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 d-flex align-items-center">
            <i class="bi bi-check-circle-fill me-2"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4 d-flex align-items-center">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <div>{{ session('error') }}</div>
        </div>
    @endif

    {{-- Tabel --}}
    <div class="card card-custom">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary small text-uppercase">
                    <tr>
                        <th class="ps-4 py-3">No</th>
                        <th class="py-3">Nama Kategori</th>
                        <th class="pe-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategoris as $k)
                    <tr>
                        <td class="ps-4 fw-bold text-dark">{{ $loop->iteration }}</td>
                        <td>
                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold">
                                {{ $k->nama_kategori }}
                            </span>
                        </td>
                        <td class="pe-4 text-center">
                            <form action="{{ route('admin.kategori.destroy', $k->id_kategori) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 py-1"
                                        onclick="return confirm('Hapus kategori ini? Pastikan tidak ada aspirasi yang menggunakan kategori ini.')">
                                    <i class="bi bi-trash3-fill me-1"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-5 text-muted">
                            <i class="bi bi-tag fs-3 d-block mb-2"></i>
                            Belum ada kategori.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</main>

<div class="modal fade" id="modalTambahKategori" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 p-4 pb-0">
                <h5 class="fw-bold">Tambah Kategori Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.kategori.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control border-2 shadow-none" 
                               style="border-radius:12px;" placeholder="Contoh: Sarana Prasarana" required>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">Simpan Kategori</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>