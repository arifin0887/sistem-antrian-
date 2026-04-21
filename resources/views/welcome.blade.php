<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Antrian Rumah Sakit | RS Selalu Sehat</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-blue: #0f62fe; /* Biru IBM/Enterprise */
            --dark-blue: #002d9c;
            --soft-blue: #e8f0fe;
            --accent-color: #00d1b2;
            --text-dark: #161616;
            --text-muted: #525252;
        }

        body {
            font-family: 'Inter', sans-serif; 
            color: var(--text-dark);
            background-color: #ffffff;
            scroll-behavior: smooth;
        }

        /* --- Navbar --- */
        .navbar {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.9) !important;
            padding: 15px 0;
            transition: all 0.3s;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            letter-spacing: -0.5px;
        }

        .nav-link {
            font-weight: 600;
            margin: 0 10px;
            color: var(--text-dark) !important;
        }

        /* --- Hero Section --- */
        .hero-section {
            background: radial-gradient(circle at top right, #1378c9, #002d9c);
            color: white;
            padding: 180px 0 120px 0;
            clip-path: ellipse(150% 100% at 50% 0%);
        }

        .hero-section h1 {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 20px;
        }

        .hero-section p {
            font-size: 1.25rem;
            font-weight: 300;
            max-width: 700px;
            margin: 0 auto 40px auto;
            color: rgba(255, 255, 255, 0.85);
        }

        .btn-cta {
            padding: 16px 35px;
            border-radius: 50px;
            font-weight: 700;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
        }

        .btn-cta:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        /* --- Cards --- */
        .service-card {
            border: none;
            border-radius: 20px;
            background: #fff;
            padding: 40px 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: all 0.4s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 4px;
            background: var(--primary-blue);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .service-card:hover::before {
            transform: scaleX(1);
        }

        .icon-box {
            width: 80px;
            height: 80px;
            background: var(--soft-blue);
            color: var(--primary-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px auto;
            font-size: 2rem;
            transition: 0.3s;
        }

        .service-card:hover .icon-box {
            background: var(--primary-blue);
            color: #fff;
            transform: rotateY(360deg);
        }

        /* --- Fitur --- */
        .feature-icon {
            font-size: 2.5rem;
            margin-bottom: 20px;
            background: -webkit-linear-gradient(var(--primary-blue), var(--accent-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* --- Footer --- */
        .footer {
            background: #0a0a0a;
            color: #888;
            padding: 60px 0 30px 0;
        }

        .footer h5 { color: #fff; font-weight: 700; }

        /* --- Badge Antrian --- */
        .badge-code {
            background: var(--soft-blue);
            color: var(--primary-blue);
            padding: 5px 15px;
            border-radius: 8px;
            font-weight: 700;
            display: inline-block;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand text-primary" href="#">
                <i class="fas fa-hand-holding-medical me-2"></i>SELALU SEHAT
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a href="#layanan" class="nav-link">Layanan Poli</a></li>
                    <li class="nav-item"><a href="#fitur" class="nav-link">Keunggulan</a></li>
                    @guest
                    <li class="nav-item ms-lg-3">
                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-cta px-4 py-2">Staff Login</a>
                    </li>
                    @endguest
                    @auth
                    <li class="nav-item ms-lg-3">
                        <a href="{{ route('queues.index') }}" class="btn btn-primary btn-cta px-4 py-2">Panel Kontrol</a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-section text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <span class="badge bg-white text-primary px-3 py-2 rounded-pill fw-bold mb-3 shadow-sm">SISTEM ANTRIAN DIGITAL v2.0</span>
                    <h1>Solusi Antrian Pintar Tanpa Menunggu Lama</h1>
                    <p>Optimalkan waktu istirahat Anda. Ambil nomor antrian dari mana saja dan pantau status secara real-time melalui perangkat Anda.</p>
                    <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                        <a href="{{ route('queues.create') }}" class="btn btn-light btn-cta shadow">
                            Ambil Antrian Sekarang <i class="fas fa-ticket-alt ms-2"></i>
                        </a>
                        <a href="{{ route('queues.index') }}" class="btn btn-outline-light btn-cta">
                            Cek Antrian <i class="fas fa-search ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section id="layanan" class="py-5 mt-5">
        <div class="container">
            <div class="text-center mb-5">
                <h6 class="text-primary fw-bold text-uppercase">Poliklinik</h6>
                <h2 class="fw-bold">Layanan Kesehatan Kami</h2>
                <div class="mx-auto" style="width: 60px; height: 3px; background: var(--primary-blue);"></div>
            </div>

            <div class="row g-4 justify-content-center">
                @foreach(\App\Models\Service::all() as $service)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="service-card text-center">
                        <div class="badge-code">{{ $service->prefix }}</div>
                        <div class="icon-box">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <h4 class="fw-bold h5">{{ $service->name }}</h4>
                        <p class="text-muted small mb-4">Konsultasi ahli dengan dokter spesialis kami.</p>
                        <a href="{{ route('queues.create') }}?service={{ $service->prefix }}" class="btn btn-primary w-100 rounded-pill fw-bold">
                            Pilih Poli
                        </a>
                    </div>
                </div>
                @endforeach
                
                @if(\App\Models\Service::count() == 0)
                <div class="col-md-4">
                    <div class="service-card text-center">
                        <div class="badge-code">A</div>
                        <div class="icon-box"><i class="fas fa-stethoscope"></i></div>
                        <h4 class="fw-bold h5">Poli Umum</h4>
                        <p class="text-muted small mb-4">Layanan pemeriksaan kesehatan harian untuk keluarga.</p>
                        <button class="btn btn-primary w-100 rounded-pill fw-bold">Ambil Antrian</button>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>

    <section id="fitur" class="py-5 bg-light">
        <div class="container py-4">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <h6 class="text-primary fw-bold text-uppercase">Teknologi</h6>
                    <h2 class="fw-bold mb-4">Mengapa Menggunakan Antrian Digital?</h2>
                    <p class="text-muted mb-4">Kami mengintegrasikan teknologi terkini untuk memberikan pengalaman pasien yang lebih manusiawi dan terorganisir.</p>
                    
                    <div class="d-flex mb-4">
                        <div class="me-3"><i class="fas fa-check-circle text-success fa-lg"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1">Efisien & Teratur</h6>
                            <p class="small text-muted">Mencegah penumpukan pasien di ruang tunggu secara drastis.</p>
                        </div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="me-3"><i class="fas fa-check-circle text-success fa-lg"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1">Transparansi Status</h6>
                            <p class="small text-muted">Pasien tahu persis berapa orang lagi sebelum giliran mereka.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row g-4">
                        <div class="col-6">
                            <div class="card p-4 border-0 shadow-sm text-center">
                                <i class="fas fa-mobile-alt feature-icon"></i>
                                <h6 class="fw-bold">Responsif</h6>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card p-4 border-0 shadow-sm text-center">
                                <i class="fas fa-bolt feature-icon"></i>
                                <h6 class="fw-bold">Cepat</h6>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card p-4 border-0 shadow-sm text-center">
                                <i class="fas fa-shield-alt feature-icon"></i>
                                <h6 class="fw-bold">Aman</h6>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card p-4 border-0 shadow-sm text-center">
                                <i class="fas fa-headset feature-icon"></i>
                                <h6 class="fw-bold">24/7</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="row mb-4">
                <div class="col-lg-6 text-center text-lg-start">
                    <h5 class="text-primary"><i class="fas fa-hospital me-2"></i> RS SELALU SEHAT</h5>
                    <p class="small">Melayani dengan hati, mengobati dengan teknologi.</p>
                </div>
                <div class="col-lg-6 text-center text-lg-end">
                    <div class="social-links">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            <hr class="border-secondary">
            <p class="text-center small mb-0">&copy; {{ date('Y') }} RS Selalu Sehat — Managed by IT Medical Solution</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>