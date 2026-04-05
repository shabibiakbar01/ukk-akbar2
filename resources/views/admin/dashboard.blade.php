<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Aspirasiku</title>
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
        }

        /* Sidebar Konsisten dengan Siswa */
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

        /* Main Content */
        .main-content { margin-left: 280px; padding: 40px; width: calc(100% - 280px); }

        /* Stat Cards */
        .stat-card {
            background: white; border: none; border-radius: 24px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.04);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative; overflow: hidden;
        }
        .stat-card:hover { transform: translateY(-5px); box-shadow: 0 15px 35px rgba(0,0,0,0.08); }

        .stat-icon {
            width: 50px; height: 50px; display: flex; align-items: center;
            justify-content: center; border-radius: 15px; font-size: 1.5rem;
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

@include('layout.sidebaradmin')

<main class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 style="font-weight: 800; color: var(--primary-dark);">Ringkasan Statistik</h2>
            <p class="text-muted small">Selamat datang kembali, <strong>{{ Auth::guard('admin')->user()->username ?? 'Admin' }}</strong>!</p>
        </div>
        <div class="badge bg-white text-dark border p-2 px-3 shadow-sm" style="border-radius: 10px;">
            <i class="bi bi-calendar3 me-2 text-primary"></i>{{ date('d F Y') }}
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card stat-card p-4">
                <div class="d-flex align-items-center">
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-journal-text"></i>
                    </div>
                    <div class="ms-3">
                        <p class="text-muted small fw-bold mb-0">TOTAL ASPIRASI</p>
                        <h2 class="fw-800 mb-0" style="font-weight: 800;">{{ $totalAspirasi }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card p-4" style="border-bottom: 4px solid #ffc107;">
                <div class="d-flex align-items-center">
                    <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                    <div class="ms-3">
                        <p class="text-muted small fw-bold mb-0">PERLU RESPON</p>
                        <h2 class="fw-800 mb-0" style="font-weight: 800;">{{ $aspirasiPending }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card p-4" style="border-bottom: 4px solid #198754;">
                <div class="d-flex align-items-center">
                    <div class="stat-icon bg-success bg-opacity-10 text-success">
                        <i class="bi bi-check-all"></i>
                    </div>
                    <div class="ms-3">
                        <p class="text-muted small fw-bold mb-0">SELESAI</p>
                        <h2 class="fw-800 mb-0" style="font-weight: 800;">{{ $aspirasiSelesai }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mt-5 p-5 rounded-4 bg-white text-center">
        <div class="mb-4">
            <div class="bg-light d-inline-block p-4 rounded-circle mb-3">
                <i class="bi bi-lightning-charge-fill text-primary fs-1"></i>
            </div>
            <h4 class="fw-800" style="font-weight: 700;">Kelola Aspirasi Hari Ini</h4>
            <p class="text-muted mx-auto" style="max-width: 500px;">
                Anda memiliki {{ $aspirasiPending }} laporan yang belum ditanggapi. Mari berikan respon terbaik untuk meningkatkan kepuasan siswa.
            </p>
        </div>
        <div>
            <a href="{{ route('admin.aspirasi') }}" class="btn btn-primary px-5 py-3 rounded-pill fw-bold shadow-sm" style="background: var(--primary-blue); border: none;">
                Buka Data Aspirasi <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
