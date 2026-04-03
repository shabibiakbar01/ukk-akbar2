<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - Aspirasiku</title>
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

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background: var(--bg-soft);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--gray-900);
            overflow-x: hidden;
        }

        /* SIDEBAR FIXED */
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

        .brand-section {
            padding: 30px 25px;
            text-align: center;
            border-bottom: 1px solid var(--gray-200);
        }

        .brand-section img {
            max-height: 60px;
            margin-bottom: 15px;
        }

        .user-badge {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--accent-purple) 100%);
            color: white;
            padding: 8px 18px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.75rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .sidebar-menu { padding: 20px 15px; flex-grow: 1; }

        .nav-link {
            color: var(--gray-600);
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            transition: 0.3s;
            font-weight: 500;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary-blue);
            background: rgba(67, 97, 238, 0.08);
        }

        .nav-link.active { font-weight: 700; background: rgba(67, 97, 238, 0.1); }

        /* CONTENT AREA */
        .main-content {
            margin-left: 280px;
            padding: 40px;
            width: calc(100% - 280px);
            min-height: 100vh;
        }

        .page-header {
            background: var(--white);
            border-radius: 20px;
            padding: 25px 30px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        }

        .welcome-card {
            background: linear-gradient(135deg, #4361ee 0%, #7209b7 100%);
            border-radius: 24px;
            padding: 50px;
            color: white;
            margin-bottom: 40px;
            box-shadow: 0 15px 35px rgba(67, 97, 238, 0.2);
        }

        .action-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .action-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            text-decoration: none;
            color: inherit;
            border: 1px solid var(--gray-200);
            transition: 0.3s;
            cursor: pointer;
        }

        .action-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.05);
            border-color: var(--primary-blue);
        }

        .action-icon {
            width: 55px;
            height: 55px;
            background: rgba(67, 97, 238, 0.1);
            color: var(--primary-blue);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .logout-section { padding: 20px 15px; border-top: 1px solid var(--gray-200); }
        .logout-btn {
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            border: 1px solid #fee2e2;
            background: #fff5f5;
            color: var(--danger);
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border: none;
        }

        /* RESPONSIVE */
        @media (max-width: 992px) {
            .sidebar { width: 80px; }
            .sidebar span, .user-badge span { display: none; }
            .main-content { margin-left: 80px; width: calc(100% - 80px); }
            .action-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

   @include('layout.sidebarsiswa')

    <main class="main-content">
        <div class="page-header">
            <div>
                <h4 class="fw-bold mb-1 text-primary">Halo, {{ Auth::user()->nama_lengkap }}! </h4>
                <p class="text-muted small mb-0">Senang melihatmu kembali hari ini.</p>
            </div>
            <div class="text-end">
                <span class="badge bg-light text-dark border p-2 px-3">
                    <i class="bi bi-calendar3 me-2"></i> {{ date('d F Y') }}
                </span>
            </div>
        </div>

        <div class="welcome-card">
            <h2 class="fw-bold">Selamat Datang di Suara Siswa</h2>
            <p class="opacity-75">Sampaikan keluhan, saran, atau apresiasimu untuk sekolah yang lebih baik. Kami siap mendengarkan aspirasimu.</p>
        </div>

        <h5 class="fw-bold mb-4">Akses Cepat</h5>
        <div class="action-grid">
            <a href="{{ route('aspirasi.create') }}" class="action-card">
                <div class="action-icon"><i class="bi bi-plus-circle-fill"></i></div>
                <h6 class="fw-bold">Buat Aspirasi</h6>
                <p class="text-muted small mb-0">Laporkan masalah atau beri saran baru.</p>
            </a>
            <a href="{{ route('aspirasi.index') }}" class="action-card">
                <div class="action-icon" style="color:#7209b7; background:rgba(114,9,183,0.1);"><i class="bi bi-clock-history"></i></div>
                <h6 class="fw-bold">Riwayat Laporan</h6>
                <p class="text-muted small mb-0">Lihat status laporan yang sudah kamu kirim.</p>
            </a>
            <div class="action-card" data-bs-toggle="modal" data-bs-target="#modalPanduan">
                <div class="action-icon" style="color:#f72585; background:rgba(247,37,133,0.1);"><i class="bi bi-info-circle-fill"></i></div>
                <h6 class="fw-bold">Panduan</h6>
                <p class="text-muted small mb-0">Cara menggunakan sistem aspirasi.</p>
            </div>
        </div>
    </main>

    <div class="modal fade" id="modalPanduan" tabindex="-1" aria-labelledby="modalPanduanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden;">
                <div class="modal-header bg-primary text-white p-4">
                    <h5 class="modal-title fw-bold" id="modalPanduanLabel">
                        <i class="bi bi-book me-2"></i> Panduan Penggunaan Sistem
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="p-3 border rounded-4 mb-3">
                                <h6 class="fw-bold text-primary"><i class="bi bi-1-circle-fill me-2"></i> Buat Aspirasi</h6>
                                <p class="text-muted small mb-0">Pilih menu "Buat Aspirasi", tentukan kategori, dan tuliskan pesanmu dengan jelas.</p>
                            </div>
                            <div class="p-3 border rounded-4">
                                <h6 class="fw-bold text-primary"><i class="bi bi-2-circle-fill me-2"></i> Pantau Status</h6>
                                <p class="text-muted small mb-0">Cek menu "Riwayat" untuk melihat respon atau status perkembangan laporanmu.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded-4 mb-3 h-100">
                                <h6 class="fw-bold text-success"><i class="bi bi-check-circle-fill me-2"></i> Arti Status</h6>
                                <ul class="text-muted small ps-3 mb-0 mt-2">
                                    <li><strong>Pending:</strong> Menunggu verifikasi admin.</li>
                                    <li><strong>Proses:</strong> Sedang ditindaklanjuti.</li>
                                    <li><strong>Selesai:</strong> Aspirasi telah selesai ditangani.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light p-3">
                    <button type="button" class="btn btn-primary px-4" data-bs-dismiss="modal" style="border-radius: 10px;">Mengerti</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
