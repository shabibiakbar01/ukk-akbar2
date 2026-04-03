<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aspirasiku</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        body {
            background: #f0f2f5;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', sans-serif;
        }
        .login-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            width: 100%;
            max-width: 420px;
            padding: 40px;
        }
        .logo-box {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo-box img {
            height: 60px;
            width: auto;
        }
        .nav-pills-custom {
            background: #f1f5f9;
            border-radius: 12px;
            padding: 4px;
        }
        .nav-pills-custom .nav-link {
            border-radius: 10px;
            color: #64748b;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 10px;
        }
        .nav-pills-custom .nav-link.active {
            background: white;
            color: #2563eb;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .form-label {
            font-size: 0.8rem;
            font-weight: 700;
            color: #475569;
            letter-spacing: 0.5px;
        }
        .input-group-custom {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            display: flex;
            align-items: center;
            padding: 0 15px;
            transition: 0.3s;
        }
        .input-group-custom:focus-within {
            border-color: #2563eb;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }
        .input-group-custom i { color: #94a3b8; }
        .input-group-custom input {
            background: transparent;
            border: none;
            padding: 12px;
            width: 100%;
            outline: none;
            font-size: 0.95rem;
        }
        .btn-primary-custom {
            background: #2563eb;
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 700;
            transition: 0.3s;
        }
        .btn-primary-custom:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
        }
        .btn-primary-custom:disabled {
            background: #94a3b8;
        }
    </style>
</head>
<body>

    <div class="login-card animate__animated animate__fadeIn">
        <div class="logo-box">
            <img src="{{ asset('images/logoaspirasi.png') }}" alt="Logo Aspirasiku">
            <p class="text-muted small mt-2">Portal Aspirasi Digital Siswa</p>
        </div>

        <ul class="nav nav-pills nav-fill nav-pills-custom mb-4" id="pills-tab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" id="pills-siswa-tab" data-bs-toggle="pill" data-bs-target="#pills-siswa" type="button">SISWA</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="pills-admin-tab" data-bs-toggle="pill" data-bs-target="#pills-admin" type="button">ADMIN</button>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="pills-siswa">
                <form action="/login" method="POST" id="siswaForm">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-uppercase">NISN</label>
                        <div class="input-group-custom">
                            <i class="bi bi-person-fill"></i>
                            <input type="text" name="nisn" placeholder="Masukkan NISN" value="{{ old('nisn') }}" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-uppercase">Password</label>
                        <div class="input-group-custom">
                            <i class="bi bi-lock-fill"></i>
                            <input type="password" name="password" placeholder="••••••••" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-primary-custom w-100">MASUK</button>
                </form>
            </div>

            <div class="tab-pane fade" id="pills-admin">
                <form action="/admin/login" method="POST" id="adminForm">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-uppercase">Username Admin</label>
                        <div class="input-group-custom">
                            <i class="bi bi-shield-lock-fill"></i>
                            <input type="text" name="username" placeholder="Masukkan Username" value="{{ old('username') }}" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-uppercase">Password</label>
                        <div class="input-group-custom">
                            <i class="bi bi-lock-fill"></i>
                            <input type="password" name="password" placeholder="••••••••" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-primary-custom w-100">MASUK ADMIN</button>
                </form>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="/" class="text-decoration-none small text-muted">← Kembali ke Beranda</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // 1. Notifikasi SweetAlert jika Login Gagal
        @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Login Gagal',
            text: '{{ $errors->first() }}',
            confirmButtonColor: '#2563eb',
            confirmButtonText: 'Coba Lagi',
            timer: 4000,
            timerProgressBar: true,
            showClass: {
                popup: 'animate__animated animate__headShake'
            }
        });
        @endif

        // 2. Notifikasi SweetAlert jika ada Success Message (misal: Logout)
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000
        });
        @endif

        // 3. Efek Loading saat Submit Form
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Memverifikasi...';
                    submitBtn.disabled = true;
                }
            });
        });
    </script>
</body>
</html>
