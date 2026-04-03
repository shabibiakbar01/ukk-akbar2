<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Aspirasi - Aspirasiku</title>
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
            background: var(--bg-soft);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--gray-900);
            overflow-x: hidden;
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

        .main-content { margin-left: 280px; padding: 40px; width: calc(100% - 280px); min-height: 100vh; }

        .card-custom {
            background: white; border: none; border-radius: 24px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }

        .badge-status {
            padding: 6px 14px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-pending { background: #fff7ed; color: #ea580c; border: 1px solid #ffedd5; }
        .status-proses { background: #eff6ff; color: #2563eb; border: 1px solid #dbeafe; }
        .status-selesai { background: #ecfdf5; color: #059669; border: 1px solid #d1fae5; }

        .img-thumbnail-custom {
            width: 60px; height: 60px; object-fit: cover; border-radius: 12px;
            border: 2px solid var(--gray-200); transition: 0.3s; cursor: pointer;
        }
        .img-thumbnail-custom:hover { transform: scale(1.1); border-color: var(--primary-blue); }
        .no-photo {
            width: 60px; height: 60px; background: var(--bg-soft); border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            color: var(--gray-200); font-size: 1.2rem; border: 2px dashed var(--gray-200);
        }

        .table thead th {
            background: #fdfdfd; text-transform: uppercase; font-size: 0.75rem;
            letter-spacing: 1px; color: var(--gray-600); padding: 20px; border-bottom: 2px solid var(--bg-soft);
        }
        .table tbody td { padding: 20px; border-bottom: 1px solid var(--bg-soft); }

        /* Style Modal Tanggapan */
        .modal-content { border-radius: 24px; border: none; }
        .feedback-box {
            background: #f8fafc; border-left: 4px solid var(--primary-blue);
            padding: 15px; border-radius: 0 12px 12px 0;
        }

        @media (max-width: 992px) {
            .sidebar { width: 80px; }
            .sidebar span, .user-badge span { display: none; }
            .main-content { margin-left: 80px; width: calc(100% - 80px); }
        }
    </style>
</head>
<body>

@include('layout.sidebarsiswa')

<main class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-800 text-dark mb-1" style="font-weight: 800;">Riwayat Aspirasi</h2>
            <p class="text-muted">Pantau status dan tanggapan dari setiap laporanmu.</p>
        </div>
        <div class="badge bg-white text-dark border p-2 px-3 shadow-sm" style="border-radius: 10px;">
            <i class="bi bi-calendar3 me-2 text-primary"></i>{{ date('d F Y') }}
        </div>
    </div>

    <div class="card card-custom">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Tanggal</th>
                        <th>Foto</th>
                        <th>Kategori</th>
                        <th>Isi Aspirasi</th>
                        <th>Status</th>
                        <th class="pe-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aspirasis as $item)
                    <tr>
                        <td class="ps-4">
                            <div class="fw-bold text-dark small">{{ \Carbon\Carbon::parse($item->tgl_pelaporan)->format('d M Y') }}</div>
                            <div class="text-muted" style="font-size: 0.7rem;">{{ \Carbon\Carbon::parse($item->tgl_pelaporan)->format('H:i') }} WIB</div>
                        </td>
                        <td>
                            @if($item->foto)
                                <a href="{{ asset('storage/foto_aspirasi/'.$item->foto) }}" target="_blank">
                                    <img src="{{ asset('storage/foto_aspirasi/'.$item->foto) }}" class="img-thumbnail-custom" alt="Bukti">
                                </a>
                            @else
                                <div class="no-photo" title="Tidak ada foto"><i class="bi bi-image"></i></div>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-light text-primary border px-3 py-2" style="border-radius: 8px; font-weight: 600;">
                                {{ $item->kategori->nama_kategori ?? 'Umum' }}
                            </span>
                        </td>
                        <td>
                            <p class="mb-0 text-dark small fw-500" style="max-width: 250px; white-space: normal; line-height: 1.5;">
                                {{ Str::limit($item->ket, 80) }}
                            </p>
                        </td>
                        <td>
                            @if($item->status == 'pending')
                                <span class="badge-status status-pending">Menunggu</span>
                            @elseif($item->status == 'proses')
                                <span class="badge-status status-proses">Diproses</span>
                            @else
                                <span class="badge-status status-selesai">Selesai</span>
                            @endif
                        </td>
                        <td class="pe-4 text-center">
                            <button class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalDetail{{ $item->id_pelaporan }}">
                                <i class="bi bi-eye-fill"></i> Lihat
                            </button>
                        </td>
                    </tr>

                    <div class="modal fade" id="modalDetail{{ $item->id_pelaporan }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content shadow-lg border-0">
                                <div class="modal-header border-0 px-4 pt-4">
                                    <h5 class="fw-bold"><i class="bi bi-info-circle me-2 text-primary"></i>Detail Tanggapan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body px-4 pb-4">
                                    <div class="mb-4">
                                        <label class="text-muted small fw-bold text-uppercase mb-2 d-block">Aspirasi Saya:</label>
                                        <p class="text-dark small bg-light p-3 rounded-3 mb-0">{{ $item->ket }}</p>
                                    </div>

                                    <label class="text-muted small fw-bold text-uppercase mb-2 d-block">Jawaban Admin:</label>
                                    @if($item->feedback && $item->feedback->pesan)
                                        <div class="feedback-box">
                                            <p class="mb-2 text-dark" style="font-size: 0.95rem; line-height: 1.6;">"{{ $item->feedback->pesan }}"</p>
                                            <div class="d-flex align-items-center gap-2 text-muted mt-3" style="font-size: 0.75rem;">
                                                <i class="bi bi-calendar-check"></i>
                                                <span>{{ \Carbon\Carbon::parse($item->feedback->tgl_feedback)->translatedFormat('l, d F Y') }}</span>
                                                <span class="mx-1">•</span>
                                                <i class="bi bi-clock"></i>
                                                <span>{{ \Carbon\Carbon::parse($item->feedback->tgl_feedback)->format('H:i') }} WIB</span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="text-center py-4 bg-light rounded-3">
                                            <i class="bi bi-chat-dots fs-2 text-muted opacity-50"></i>
                                            <p class="text-muted small mt-2 mb-0 fst-italic">Belum ada tanggapan dari admin.</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="modal-footer border-0 px-4 pb-4">
                                    <button type="button" class="btn btn-secondary rounded-pill w-100 fw-bold" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="py-4">
                                <i class="bi bi-chat-left-dots text-gray-200" style="font-size: 4rem;"></i>
                                <h5 class="mt-3 fw-bold text-muted">Belum ada riwayat</h5>
                                <p class="text-muted small">Aspirasi yang kamu kirim akan muncul di sini.</p>
                                <a href="{{ route('aspirasi.create') }}" class="btn btn-primary btn-sm rounded-pill px-4 mt-2">Buat Sekarang</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
