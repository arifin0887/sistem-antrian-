<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Antrian Rumah Sakit</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> 
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-blue: #1378c9;
            --secondary-blue: #47b2e4;
            --bg-light: #f8f9fa;
        }

        body {
            font-family: 'Inter', sans-serif; 
            color: #212529;
            background-color: white; 
        }

        .navbar-brand {
            font-weight: 800 !important; 
        }
        .nav-link {
            font-weight: 500;
            transition: color 0.2s;
        }
        .nav-link:hover {
            color: var(--primary-blue) !important;
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: white;
            padding: 150px 0 100px 0; 
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); 
        }
        .hero-section h1 {
            font-size: 3.5rem;
            font-weight: 900;
        }
        .hero-section p {
            font-size: 1.25rem;
            opacity: 0.9;
        }

        .service-card, .card {
            border-radius: 12px;
            border: 1px solid #e9ecef;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease-in-out;
        }
        .service-card:hover, .card:hover {
            transform: translateY(-8px); 
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .service-card h4 {
            color: var(--primary-blue);
        }
        .card i {
            color: var(--primary-blue); 
        }
        .text-primary, .btn-primary {
            --bs-btn-bg: var(--primary-blue);
            --bs-btn-border-color: var(--primary-blue);
        }

        .footer {
            background: var(--bg-light);
            padding: 25px 0;
            border-top: 1px solid #dee2e6;
            font-size: 0.9rem;
            color: #6c757d;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">
                <i class="fas fa-hospital me-2"></i> RS Selalu Sehat
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="#layanan" class="nav-link">Layanan</a></li>
                    <li class="nav-item"><a href="#fitur" class="nav-link">Fitur</a></li>

                    @guest
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-primary ms-3">
                            Login 
                        </a>
                    </li>
                    @endguest

                    @auth
                    <li class="nav-item">
                        <a href="{{ route('queues.index') }}" class="btn btn-success ms-3">
                            Dashboard
                        </a>
                    </li>
                    @endauth
                </ul>

            </div>
        </div>
    </nav>

    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">Sistem Antrian Rumah Sakit</h1>
            <p class="lead mt-3">Ambil antrian dengan mudah, cepat, dan tanpa ribet.</p>

            <div class="mt-5">
                <a href="{{ route('queues.create') }}" class="btn btn-light btn-lg me-3 px-5 py-3 fw-bold">
                    Ambil Antrian Sekarang <i class="fas fa-arrow-right ms-2"></i>
                </a>
                <a href="{{ route('queues.index') }}" class="btn btn-outline-light btn-lg px-5 py-3 fw-bold">
                    Lihat Antrian <i class="fas fa-eye ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <section id="layanan" class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Layanan Kami</h2>

            <div class="row g-4 justify-content-center">

                @foreach(\App\Models\Service::all() as $service)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card service-card p-4 text-center">
                        <i class="fas fa-user-md fa-3x text-primary mb-3 mx-auto"></i>
                        <h4 class="fw-bold">{{ $service->name }}</h4>
                        <p class="text-muted small">Kode Layanan: <strong>{{ $service->prefix }}</strong></p>
                        <a href="{{ route('queues.create') }}?service={{ $service->prefix }}" class="btn btn-primary mt-2">
                            Ambil Antrian
                        </a>
                    </div>
                </div>
                @endforeach
                
                 @if(empty(\App\Models\Service::all()))
                    <div class="col-md-4">
                        <div class="card service-card p-4 text-center">
                            <i class="fas fa-stethoscope fa-3x text-primary mb-3 mx-auto"></i>
                            <h4 class="fw-bold">Poli Umum</h4>
                            <p class="text-muted small">Kode Layanan: <strong>A</strong></p>
                            <a href="#" class="btn btn-primary mt-2">Ambil Antrian</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card service-card p-4 text-center">
                            <i class="fas fa-tooth fa-3x text-primary mb-3 mx-auto"></i>
                            <h4 class="fw-bold">Poli Gigi</h4>
                            <p class="text-muted small">Kode Layanan: <strong>B</strong></p>
                            <a href="#" class="btn btn-primary mt-2">Ambil Antrian</a>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </section>

    <section id="fitur" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Fitur Sistem Antrian</h2>

            <div class="row g-4">

                <div class="col-md-4">
                    <div class="card p-4 text-center shadow-sm h-100">
                        <i class="fas fa-qrcode fa-3x mb-3 mx-auto" style="color: var(--primary-blue);"></i>
                        <h5 class="fw-bold">Nomor Antrian Otomatis</h5>
                        <p class="text-muted">Setiap layanan menghasilkan kode antrian otomatis (misal: A001, B001).</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card p-4 text-center shadow-sm h-100">
                        <i class="fas fa-users-cog fa-3x mb-3 mx-auto" style="color: #28a745;"></i>
                        <h5 class="fw-bold">Manajemen User Role</h5>
                        <p class="text-muted">Admin & Operator memiliki akses fitur yang berbeda untuk keamanan data.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card p-4 text-center shadow-sm h-100">
                        <i class="fas fa-bullhorn fa-3x mb-3 mx-auto" style="color: #ffc107;"></i>
                        <h5 class="fw-bold">Pemanggilan Real-Time</h5>
                        <p class="text-muted">Status antrian dapat dipanggil, dilayani, dan diselesaikan langsung oleh operator.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <footer class="footer text-center">
        <p class="mb-0">&copy; {{ date('Y') }} Rumah Sakit Selalu Sehat — Sistem Antrian Online</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a2d9d5a64b.js" crossorigin="anonymous"></script>

</body>
</html>