<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Aspirasi - Aspirasiku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

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
            overflow-x: hidden;
        }

        /* Sidebar */
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
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--accent-purple) 100%);
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

        /* Main Content */
        .main-content { margin-left: 280px; padding: 40px; width: calc(100% - 280px); }

        .card-custom {
            background: white; border: none; border-radius: 24px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.04);
            padding: 40px;
        }

        .form-label { font-weight: 700; color: var(--gray-900); margin-bottom: 12px; font-size: 0.95rem; }

        .form-control, .form-select {
            border-radius: 15px; border: 2px solid var(--gray-200);
            padding: 14px 18px; transition: 0.3s; font-size: 0.95rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-blue); box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.1);
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--accent-purple) 100%);
            border: none; border-radius: 15px; padding: 15px 35px;
            font-weight: 700; color: white; transition: 0.3s;
        }
        .btn-primary-custom:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(67, 97, 238, 0.3); color: white; }

        .logout-section { padding: 20px 15px; border-top: 1px solid var(--gray-200); }
        .logout-btn {
            width: 100%; padding: 12px; border-radius: 12px; background: #fff5f5;
            color: var(--danger); font-weight: 600; display: flex; align-items: center;
            justify-content: center; gap: 10px; border: none; transition: 0.3s;
        }
        .logout-btn:hover { background: var(--danger); color: white; }

        .info-box {
            background: #f0f7ff; border-radius: 15px; padding: 20px; border-left: 5px solid var(--primary-blue);
        }

        @media (max-width: 992px) {
            .sidebar { width: 80px; }
            .sidebar span, .user-badge span { display: none; }
            .main-content { margin-left: 80px; width: calc(100% - 80px); padding: 20px; }
        }
    </style>
</head>
<body>

@include('layout.sidebarsiswa')

<main class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-800 text-dark mb-1" style="font-weight: 800; letter-spacing: -1px;">Sampaikan Aspirasi</h2>
            <p class="text-muted">Suara Anda adalah langkah awal perubahan sekolah yang lebih baik.</p>
        </div>
        <div class="badge bg-white text-dark border p-2 px-3 shadow-sm d-none d-md-block" style="border-radius: 12px;">
            <i class="bi bi-calendar3 me-2 text-primary"></i>{{ date('d F Y') }}
        </div>
    </div>

    {{-- Pesan Sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4 p-3" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-check-circle-fill me-3 fs-4"></i>
                <div><strong>Berhasil!</strong> {{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Notifikasi Error Global (Opsional) --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4 p-3" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-exclamation-triangle-fill me-3 fs-4"></i>
                <div><strong>Gagal Mengirim!</strong> Mohon periksa kembali isian Anda di bawah.</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card card-custom">
        <form action="{{ route('aspirasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                {{-- Kategori --}}
                <div class="col-md-12 mb-4">
                    <label class="form-label">Kategori Aspirasi</label>
                    <select name="id_kategori" class="form-select shadow-none @error('id_kategori') is-invalid @enderror" required>
                        <option value="" hidden>Pilih kategori laporan...</option>
                        @foreach($kategoris as $kat)
                            <option value="{{ $kat->id_kategori }}" {{ old('id_kategori') == $kat->id_kategori ? 'selected' : '' }}>
                                {{ $kat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Detail Aspirasi --}}
                <div class="col-md-12 mb-4">
                    <label class="form-label">Detail Aspirasi / Laporan</label>
                    <textarea name="isi_aspirasi" 
                              class="form-control shadow-none @error('isi_aspirasi') is-invalid @enderror" 
                              rows="6"
                              placeholder="Ceritakan secara detail kendala atau saran Anda (Minimal 10 karakter)" 
                              required>{{ old('isi_aspirasi') }}</textarea>
                    @error('isi_aspirasi')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Bukti Foto --}}
                <div class="col-md-12 mb-4">
                    <label class="form-label">Bukti Foto <span class="text-muted fw-normal">(Opsional)</span></label>
                    <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*">
                    <div class="form-text text-muted">Format: JPG, PNG, JPEG. Maksimal 2 MB.</div>
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Info Box --}}
                <div class="col-md-12 mb-4">
                    <div class="info-box d-flex align-items-start gap-3">
                        <i class="bi bi-shield-lock-fill text-primary fs-3"></i>
                        <div>
                            <h6 class="fw-bold mb-1">Identitas Anda Terlindungi</h6>
                            <p class="text-muted small mb-0">Sistem akan meneruskan aspirasi Anda ke bagian terkait tanpa memperlihatkan data pribadi Anda secara terbuka guna kenyamanan bersama.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end align-items-center gap-3 mt-4">
                <a href="{{ route('siswa.dashboard') }}" class="btn btn-light rounded-pill px-4 fw-bold text-muted text-decoration-none">Batal</a>
                <button type="submit" class="btn btn-primary-custom shadow-sm">
                    Kirim Aspirasi <i class="bi bi-send-fill ms-2"></i>
                </button>
            </div>
        </form>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>