<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Aspirasi - Aspirasiku</title>
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

        .img-preview {
            width: 50px; height: 40px;
            object-fit: cover; border-radius: 6px;
            cursor: pointer; transition: transform 0.2s;
        }
        .img-preview:hover { transform: scale(1.1); }

        .card-custom {
            background: white; border: none;
            border-radius: 24px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.04);
            overflow: hidden;
        }

        .time-badge {
            background: #f0f9ff; color: #0369a1;
            padding: 4px 10px; border-radius: 6px;
            font-size: 0.7rem; font-weight: 600;
            display: inline-flex; align-items: center; gap: 5px;
        }

        /* Sidebar */
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

        .logout-section { padding: 20px 15px; border-top: 1px solid var(--gray-200); }
        .logout-btn {
            width: 100%; padding: 12px; border-radius: 12px; background: #fff5f5;
            color: var(--danger); font-weight: 600; display: flex; align-items: center;
            justify-content: center; gap: 10px; border: none; transition: 0.3s;
        }
        .logout-btn:hover { background: var(--danger); color: white; }

        /* Detail Modal */
        .detail-section-label {
            font-size: 0.68rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: 0.07em; color: var(--gray-600); margin-bottom: 6px;
        }
        .detail-box {
            background: var(--bg-soft); border-radius: 14px;
            padding: 14px 16px; margin-bottom: 12px;
        }
        .detail-box .value {
            font-weight: 600; font-size: 0.9rem; color: var(--gray-900);
        }
        .detail-isi {
            background: var(--bg-soft); border-radius: 14px;
            padding: 16px; line-height: 1.7; font-size: 0.88rem;
            color: var(--gray-900); white-space: pre-wrap; margin-bottom: 14px;
        }
        .detail-foto {
            width: 100%; max-height: 220px; object-fit: cover;
            border-radius: 14px; cursor: pointer; transition: opacity 0.2s;
        }
        .detail-foto:hover { opacity: 0.85; }

        .status-pill {
            display: inline-block; padding: 5px 16px;
            border-radius: 20px; font-size: 0.78rem; font-weight: 700;
            text-transform: capitalize;
        }
        .status-pending { background: #fef9c3; color: #854d0e; }
        .status-proses  { background: #dbeafe; color: #1d4ed8; }
        .status-selesai { background: #dcfce7; color: #166534; }

        .feedback-box {
            background: #f0fdf4; border-left: 4px solid #22c55e;
            border-radius: 0 12px 12px 0; padding: 12px 16px;
            font-size: 0.85rem; color: var(--gray-900); line-height: 1.6;
        }
        .no-feedback-box {
            background: #fafafa; border-left: 4px solid var(--gray-200);
            border-radius: 0 12px 12px 0; padding: 12px 16px;
            font-size: 0.85rem; color: var(--gray-600);
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

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 style="font-weight: 800; color: var(--primary-dark);">Daftar Aspirasi Siswa</h2>
            <p class="text-muted small">Kelola dan tanggapi pesan dari siswa secara real-time.</p>
        </div>
        <div class="badge bg-white text-dark border p-2 px-3 shadow-sm" style="border-radius: 10px;">
            <i class="bi bi-calendar3 me-2 text-primary"></i>{{ date('d F Y') }}
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 d-flex align-items-center">
            <i class="bi bi-check-circle-fill me-2"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

{{-- Filter Status --}}
<div class="d-flex gap-2 mb-3">
    <a href="{{ route('admin.aspirasi') }}" 
       class="btn btn-sm {{ !request('status') ? 'btn-primary' : 'btn-white border' }} rounded-pill px-3">
       Semua <span class="badge bg-white text-dark ms-1 shadow-sm">{{ $counts['all'] ?? 0 }}</span>
    </a>
    <a href="{{ route('admin.aspirasi', ['status' => 'pending']) }}" 
       class="btn btn-sm {{ request('status') == 'pending' ? 'btn-warning text-white' : 'btn-white border' }} rounded-pill px-3">
       Pending <span class="badge bg-warning text-white ms-1 shadow-sm">{{ $counts['pending'] ?? 0 }}</span>
    </a>
    <a href="{{ route('admin.aspirasi', ['status' => 'proses']) }}" 
       class="btn btn-sm {{ request('status') == 'proses' ? 'btn-info text-white' : 'btn-white border' }} rounded-pill px-3">
       Proses <span class="badge bg-info text-white ms-1 shadow-sm">{{ $counts['proses'] ?? 0 }}</span>
    </a>
    <a href="{{ route('admin.aspirasi', ['status' => 'selesai']) }}" 
       class="btn btn-sm {{ request('status') == 'selesai' ? 'btn-success text-white' : 'btn-white border' }} rounded-pill px-3">
       Selesai <span class="badge bg-success text-white ms-1 shadow-sm">{{ $counts['selesai'] ?? 0 }}</span>
    </a>
</div>

    {{-- Tabel --}}
    <div class="card card-custom">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary small text-uppercase">
                    <tr>
                        <th class="ps-4 py-3" style="min-width:150px;">Siswa</th>
                        <th class="py-3" style="min-width:130px;">Waktu Kirim</th>
                        <th class="py-3" style="min-width:110px;">Kategori</th>
                        <th class="py-3" style="min-width:200px;">Isi Aspirasi</th>
                        <th class="py-3 text-center" style="min-width:90px;">Bukti Foto</th>
                        <th class="py-3" style="min-width:100px;">Status</th>
                        <th class="pe-4 py-3 text-center" style="min-width:210px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aspirasis as $row)
                    @php
                        $statusMap = [
                            'pending' => ['pill' => 'status-pending', 'badge' => 'bg-warning text-warning'],
                            'proses'  => ['pill' => 'status-proses',  'badge' => 'bg-primary text-primary'],
                            'selesai' => ['pill' => 'status-selesai', 'badge' => 'bg-success text-success'],
                        ];
                        $sc = $statusMap[$row->status] ?? ['pill' => '', 'badge' => 'bg-secondary text-secondary'];
                    @endphp
                    <tr>
                        <td class="ps-4">
                            <div class="fw-bold text-dark">{{ $row->siswa->nama_lengkap ?? 'User' }}</div>                        </td>
                        <td>
                            <div class="small fw-bold">
                                {{ \Carbon\Carbon::parse($row->tgl_pelaporan)->format('d M Y') }}
                            </div>
                            <div class="text-muted" style="font-size: 0.7rem;">
                                {{ \Carbon\Carbon::parse($row->tgl_pelaporan)->format('H:i') }} WIB
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border px-2 py-1" style="border-radius:8px; white-space:nowrap;">
                                {{ $row->kategori->nama_kategori ?? 'Umum' }}
                            </span>
                        </td>
                        <td>
                            <p class="mb-0 small text-muted text-truncate" style="max-width:200px;" title="{{ $row->ket }}">
                                {{ $row->ket }}
                            </p>
                        </td>
                        <td class="text-center">
                            @if($row->foto)
                                <a href="{{ asset('storage/foto_aspirasi/' . $row->foto) }}" target="_blank">
                                    <img src="{{ asset('storage/foto_aspirasi/' . $row->foto) }}"
                                         class="img-preview border shadow-sm" alt="Bukti">
                                </a>
                            @else
                                <span class="text-muted small fst-italic">-</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $sc['badge'] }} bg-opacity-10 px-3 py-2 rounded-pill small fw-bold text-capitalize" style="white-space:nowrap;">
                                {{ $row->status }}
                            </span>
                        </td>
                        <td class="pe-4 text-center">
    <div class="d-flex justify-content-center align-items-center gap-1">

        {{-- VIEW DETAIL --}}
        <button class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1"
                style="font-size:0.75rem; font-weight:600; min-width:60px;"
                data-bs-toggle="modal"
                data-bs-target="#modalDetail{{ $row->id_pelaporan }}">
            Detail
        </button>

        {{-- UPDATE / TANGGAPI --}}
        <button class="btn btn-sm btn-outline-success rounded-pill px-3 py-1"
                style="font-size:0.75rem; font-weight:600; min-width:60px;"
                data-bs-toggle="modal"
                data-bs-target="#modalTanggapi{{ $row->id_pelaporan }}">
            Tanggapi
        </button>

        {{-- DELETE --}}
        <form action="{{ route('admin.aspirasi.destroy', $row->id_pelaporan) }}" method="POST" class="d-inline">
            @csrf @method('DELETE')
            <button type="submit"
                    class="btn btn-sm btn-outline-danger rounded-pill px-3 py-1"
                    style="font-size:0.75rem; font-weight:600; min-width:60px;"
                    onclick="return confirm('Hapus aspirasi ini?')">
                Hapus
            </button>
        </form>

    </div>
</td>
                    </tr>

                    {{-- ===== MODAL DETAIL (VIEW) ===== --}}
                    <div class="modal fade" id="modalDetail{{ $row->id_pelaporan }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-md">
                            <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">

                                <div class="modal-header border-0 px-4 pt-4 pb-2">
                                    <div>
                                        <h5 class="fw-bold mb-0">Detail Aspirasi</h5>                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body px-4 pb-2">

                                    {{-- Info Siswa & Meta --}}
                                    <div class="row g-2 mb-1">
                                        <div class="col-6">
                                            <div class="detail-box">
                                                <div class="detail-section-label"><i class="bi bi-person me-1"></i>Nama Siswa</div>
                                                <div class="value">{{ $row->siswa->nama_lengkap ?? 'User' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="detail-box">
                                                <div class="detail-section-label"><i class="bi bi-person-badge me-1"></i>NISN</div>
                                                <div class="value">{{ $row->nisn }}</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="detail-box">
                                                <div class="detail-section-label"><i class="bi bi-calendar-event me-1"></i>Tanggal Kirim</div>
                                                <div class="value">{{ \Carbon\Carbon::parse($row->tgl_pelaporan)->translatedFormat('d F Y, H:i') }} WIB</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="detail-box">
                                                <div class="detail-section-label"><i class="bi bi-tag me-1"></i>Kategori</div>
                                                <div class="value">{{ $row->kategori->nama_kategori ?? 'Umum' }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Isi Aspirasi --}}
                                    <div class="detail-section-label"><i class="bi bi-chat-left-text me-1"></i>Isi Aspirasi</div>
                                    <div class="detail-isi">{{ $row->ket }}</div>

                                    {{-- Foto Bukti --}}
                                    <div class="detail-section-label"><i class="bi bi-image me-1"></i>Foto Bukti</div>
                                    @if($row->foto)
                                        <a href="{{ asset('storage/foto_aspirasi/' . $row->foto) }}" target="_blank">
                                            <img src="{{ asset('storage/foto_aspirasi/' . $row->foto) }}"
                                                 class="detail-foto mb-1" alt="Bukti Foto">
                                        </a>
                                        <p class="text-muted small mb-3"><i class="bi bi-zoom-in me-1"></i>Klik foto untuk membuka ukuran penuh</p>
                                    @else
                                        <p class="text-muted small mb-3"><i class="bi bi-image-slash me-1"></i>Tidak ada foto yang dilampirkan.</p>
                                    @endif

                                    {{-- Status --}}
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <div class="detail-section-label mb-0"><i class="bi bi-activity me-1"></i>Status</div>
                                        <span class="status-pill status-{{ $row->status }}">{{ ucfirst($row->status) }}</span>
                                    </div>

                                    {{-- Feedback --}}
                                    <div class="detail-section-label"><i class="bi bi-chat-right-dots me-1"></i>Feedback Admin</div>
                                    @if(!empty($row->feedback->pesan))
                                        <div class="feedback-box mb-2">{{ $row->feedback->pesan }}</div>
                                    @else
                                        <div class="no-feedback-box mb-2">Belum ada tanggapan dari admin.</div>
                                    @endif

                                </div>

                                <div class="modal-footer border-0 px-4 pb-4 pt-2">
                                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
                                    <button class="btn btn-success rounded-pill px-4"
                                            data-bs-dismiss="modal"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalTanggapi{{ $row->id_pelaporan }}">
                                        <i class="bi bi-reply-fill me-1"></i>Tanggapi
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                    {{-- ===== END MODAL DETAIL ===== --}}

                    {{-- ===== MODAL TANGGAPI (UPDATE) ===== --}}
                    <div class="modal fade" id="modalTanggapi{{ $row->id_pelaporan }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow-lg" style="border-radius:24px;">
                                <form action="{{ route('admin.tanggapi', $row->id_pelaporan) }}" method="POST">
                                    @csrf
                                    <div class="modal-header border-0 p-4 pb-0">
                                        <h5 class="fw-bold text-dark">Beri Tanggapan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="bg-light p-3 rounded-4 mb-3 small">
                                            <div class="mb-1"><strong>Siswa:</strong> {{ $row->siswa->nama_lengkap ?? 'User' }}</div>
                                            <div class="mb-2"><strong>Aspirasi:</strong> "{{ $row->ket }}"</div>
                                            @if($row->foto)
                                                <div class="text-center">
                                                    <a href="{{ asset('storage/foto_aspirasi/' . $row->foto) }}" target="_blank">
                                                        <img src="{{ asset('storage/foto_aspirasi/' . $row->foto) }}"
                                                             class="rounded img-fluid mt-2"
                                                             style="max-height:150px; cursor:pointer; transition:opacity 0.2s;"
                                                             onmouseover="this.style.opacity='0.8'"
                                                             onmouseout="this.style.opacity='1'">
                                                    </a>
                                                    <div class="mt-1">
                                                        <small class="text-muted"><i class="bi bi-zoom-in"></i> Klik foto untuk memperbesar</small>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold small">Status Progress</label>
                                            <select name="status" class="form-select border-2 shadow-none" style="border-radius:12px;">
                                                <option value="pending"  {{ $row->status == 'pending'  ? 'selected' : '' }}>Pending</option>
                                                <option value="proses"   {{ $row->status == 'proses'   ? 'selected' : '' }}>Proses</option>
                                                <option value="selesai"  {{ $row->status == 'selesai'  ? 'selected' : '' }}>Selesai</option>
                                            </select>
                                        </div>
                                        <div class="mb-0">
                                            <label class="form-label fw-bold small">Pesan Tanggapan</label>
                                            <textarea name="feedback" class="form-control border-2 shadow-none" rows="4"
                                                      style="border-radius:12px;"
                                                      placeholder="Tulis jawaban atau tindak lanjut..." required>{{ $row->feedback->pesan ?? '' }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0 p-4 pt-0">
                                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">Simpan Tanggapan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- ===== END MODAL TANGGAPI ===== --}}

                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                            Belum ada aspirasi yang masuk.
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