<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aspirasiku - Suaramu, Masa Depan Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;600;700;800&family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-dark: #1a1d29;
            --primary-accent: #4f46e5;
            --secondary-accent: #ec4899;
            --soft-white: #fafbfc;
            --warm-gray: #f5f3f0;
            --text-dark: #2d2d2d;
            --gradient-1: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-2: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --gradient-3: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--soft-white);
            overflow-x: hidden;
            color: var(--text-dark);
        }

        /* Simple Background */
        .animated-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: #f0f4f8;
        }

        /* Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
            padding: 20px 0;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            padding: 12px 0;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: 'Lexend', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-dark);
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.02);
        }

        .navbar-brand img {
            height: 45px;
            filter: drop-shadow(2px 2px 4px rgba(0, 0, 0, 0.1));
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover img {
            transform: rotate(-5deg);
        }

        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: 600;
            border-radius: 30px;
            padding: 12px 35px;
            border: none;
            font-size: 1rem;
            letter-spacing: 0.5px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
            color: white;
        }

        /* Hero Section */
        .hero-section {
            min-height: 92vh;
            display: flex;
            align-items: center;
            padding: 80px 0 60px;
            position: relative;
        }

        .hero-content {
            opacity: 0;
            animation: fadeInUp 1s ease forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
            from {
                opacity: 0;
                transform: translateY(30px);
            }
        }

        .hero-badge {
            display: inline-block;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            color: var(--primary-accent);
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 25px;
            border: 2px solid rgba(102, 126, 234, 0.2);
            animation: fadeInUp 1s ease 0.2s forwards;
            opacity: 0;
        }

        .hero-title {
            font-family: 'Lexend', sans-serif;
            font-weight: 800;
            font-size: 4.5rem;
            line-height: 1.1;
            margin-bottom: 30px;
            background: linear-gradient(135deg, #1a1d29 0%, #4f46e5 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: fadeInUp 1s ease 0.4s forwards;
            opacity: 0;
        }

        .hero-subtitle {
            font-size: 1.4rem;
            color: #6b7280;
            margin-bottom: 45px;
            line-height: 1.6;
            max-width: 600px;
            animation: fadeInUp 1s ease 0.6s forwards;
            opacity: 0;
        }

        .hero-cta {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            animation: fadeInUp 1s ease 0.8s forwards;
            opacity: 0;
        }

        .btn-primary-hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: 600;
            border-radius: 35px;
            padding: 18px 45px;
            border: none;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 30px rgba(102, 126, 234, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-primary-hero::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s ease, height 0.6s ease;
        }

        .btn-primary-hero:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-primary-hero:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .btn-secondary-hero {
            background: transparent;
            color: var(--primary-dark);
            font-weight: 600;
            border-radius: 35px;
            padding: 18px 45px;
            border: 2px solid var(--primary-dark);
            font-size: 1.1rem;
            letter-spacing: 0.5px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-secondary-hero:hover {
            background: var(--primary-dark);
            color: white;
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(26, 29, 41, 0.3);
        }

        /* Feature Cards */
        .features-section {
            padding: 100px 0;
            background: white;
            position: relative;
        }

        .section-title {
            font-family: 'Lexend', sans-serif;
            font-weight: 700;
            font-size: 2.8rem;
            text-align: center;
            margin-bottom: 20px;
            color: var(--primary-dark);
        }

        .section-subtitle {
            text-align: center;
            font-size: 1.2rem;
            color: #6b7280;
            margin-bottom: 60px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .feature-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            height: 100%;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--gradient-1);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .feature-card:nth-child(2)::before {
            background: var(--gradient-2);
        }

        .feature-card:nth-child(3)::before {
            background: var(--gradient-3);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 25px;
            background: var(--gradient-1);
            color: white;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }

        .feature-card:nth-child(2) .feature-icon {
            background: var(--gradient-2);
            box-shadow: 0 8px 20px rgba(236, 72, 153, 0.3);
        }

        .feature-card:nth-child(3) .feature-icon {
            background: var(--gradient-3);
            box-shadow: 0 8px 20px rgba(79, 172, 254, 0.3);
        }

        .feature-title {
            font-family: 'Lexend', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: var(--primary-dark);
        }

        .feature-description {
            color: #6b7280;
            line-height: 1.7;
            font-size: 1rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.8rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .hero-cta {
                flex-direction: column;
            }

            .btn-primary-hero,
            .btn-secondary-hero {
                width: 100%;
                text-align: center;
            }

            .section-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>

    <!-- Simple Background -->
    <div class="animated-bg"></div>

    <!-- Navbar -->
    <nav class="navbar sticky-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logoaspirasi.png') }}" alt="Logo Aspirasiku">
            </a>
            <div class="d-flex">
                <a href="/login" class="btn btn-login">MASUK</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 hero-content">
                    <div class="hero-badge">
                        <i class="bi bi-stars me-1"></i> Platform Aspirasi Sekolah Terpercaya
                    </div>
                    <h1 class="hero-title">
                        Suaramu,<br>
                        Masa Depan<br>
                        Sekolah
                    </h1>
                    <p class="hero-subtitle">
                        Sampaikan aspirasi, ide, dan masukan untuk menciptakan lingkungan sekolah yang lebih baik. Bersama kita wujudkan perubahan nyata.
                    </p>
                    <div class="hero-cta">
                        <a href="/login" class="btn btn-primary-hero">
                            Mulai Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="features-section">
        <div class="container">
            <h2 class="section-title">Kenapa Aspirasiku?</h2>
            <p class="section-subtitle">
                Platform yang dirancang untuk mendengarkan setiap suara dan mewujudkan perubahan positif
            </p>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="bi bi-chat-dots-fill"></i></div>
                        <h3 class="feature-title">Mudah Digunakan</h3>
                        <p class="feature-description">
                            Interface yang intuitif memudahkan setiap siswa untuk menyampaikan aspirasinya tanpa kendala.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="bi bi-shield-lock-fill"></i></div>
                        <h3 class="feature-title">Aman & Terpercaya</h3>
                        <p class="feature-description">
                            Data dan identitas terlindungi dengan sistem keamanan terbaik untuk menjaga privasi Anda.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="bi bi-lightning-charge-fill"></i></div>
                        <h3 class="feature-title">Respon Cepat</h3>
                        <p class="feature-description">
                            Setiap aspirasi ditanggapi dengan serius dan cepat oleh pihak sekolah untuk solusi terbaik.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('mainNav');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>
