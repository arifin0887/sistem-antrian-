<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Antrian Rumah Sakit | Sehat Selalu</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #0d6efd; /* Blue */
            --secondary-color: #5ab2ff; /* Light Blue */
            --bg-color: #f3f7ff;
        }

        body {
            background: var(--bg-color);
            /* font-family: 'Poppins', sans-serif; */
        }

        /* --- NAVBAR --- */
        .navbar {
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        /* Navbar Awal: Transparan */
        .navbar-transparent {
            background-color: transparent !important;
            box-shadow: none !important;
        }
        .navbar-transparent .navbar-brand,
        .navbar-transparent .btn-primary {
             color: white !important; /* Agar teks terlihat di Hero */
        }
        
        /* Navbar Saat Scroll */
        .navbar-scrolled {
            background-color: white !important;
            box-shadow: 0px 5px 15px rgba(0,0,0,0.1) !important;
        }
        .navbar-scrolled .navbar-brand {
             color: var(--primary-color) !important;
        }

        /* --- HERO SECTION --- */
        .hero {
            min-height: 100vh; /* Menggunakan min-height untuk fleksibilitas */
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 80px 0; /* Padding vertikal */
        }
        .hero h1 {
            font-weight: 700;
            font-size: clamp(2.5rem, 5vw, 3.5rem); /* Ukuran responsif */
        }
        .hero p {
            font-size: clamp(1rem, 2vw, 1.2rem);
            opacity: 0.9;
        }

        /* --- INFO CARD --- */
        .info-card {
            border-radius: 15px;
            padding: 30px; /* Padding lebih besar */
            background: white;
            box-shadow: 0px 5px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .info-card:hover {
            transform: translateY(-5px); /* Efek hover menarik */
        }

        .info-card img {
            width: 80px;
            height: 80px;
        }

        .btn-light {
            color: white;
            background-color: var(--primary-color);
            border: none;
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 600;
            box-shadow: 0px 5px 15px rgba(0,0,0,0.1);
            transition: background-color 0.3s, color 0.3s;
        }

        /* --- FOOTER --- */
        footer {
            border-top: 1px solid #eee;
        }
    </style>

</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg fixed-top navbar-transparent" id="mainNavbar">
            <div class="container">
                <a class="navbar-brand fw-bold" href="#">RS Sehat Selalu</a>
                <div class="d-flex">
                    <a href="{{'/login'}}" class="btn btn-light shadow-sm fw-bold">Login</a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="hero">
            <div class="container">
                <div class="row align-items-center">

                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <h1 class="display-4">Sistem Antrian Digital untuk Kemudahan Anda</h1>
                        <p class="mt-4">
                            Mempermudah proses antrian pasien dengan sistem yang cepat, akurat, dan modern. Dapatkan nomor antrian Anda secara online dan pantau real-time tanpa perlu menunggu lama.
                        </p>

                        <a href="{{'/regis'}}" class="btn btn-light btn-lg mt-4 shadow-lg text-primary fw-bold">
                            Ambil Antrian Sekarang &rarr;
                        </a>
                        <a href="{{'/status'}}" class="btn btn-outline-light btn-lg mt-4 ms-2">
                             Lihat Status
                        </a>
                    </div>

                    <div class="col-lg-6 text-center">
                        <img src="https://cdn-icons-png.flaticon.com/512/2966/2966488.png"
                             class="img-fluid pulse-animation" width="450" alt="Ilustrasi orang menggunakan aplikasi antrian digital">
                    </div>

                </div>
            </div>
        </div>

        {{-- <div class="container my-5 py-5">
            <h2 class="text-center mb-5 fw-bold">Manfaat Sistem Antrian Kami</h2>

            <div class="row g-4 justify-content-center">
                
                <div class="col-md-6 col-lg-4">
                    <div class="info-card text-center">
                        <img src="https://cdn-icons-png.flaticon.com/512/3209/3209265.png" alt="Ikon Antrian Online">
                        <h5 class="mt-3 fw-bold text-primary">Antrian Digital</h5>
                        <p class="text-muted">Ambil nomor antrian dari mana saja, kapan saja, melalui perangkat seluler Anda.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="info-card text-center">
                        <img src="https://cdn-icons-png.flaticon.com/512/1008/1008181.png" alt="Ikon Real-Time Monitoring">
                        <h5 class="mt-3 fw-bold text-primary">Monitoring Real-Time</h5>
                        <p class="text-muted">Pantau posisi antrian Anda secara langsung, mengurangi waktu tunggu di lokasi.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="info-card text-center">
                        <img src="https://cdn-icons-png.flaticon.com/512/3208/3208729.png" alt="Ikon Laporan Data">
                        <h5 class="mt-3 fw-bold text-primary">Laporan Kinerja</h5>
                        <p class="text-muted">Manajemen mendapatkan data akurat tentang waktu tunggu dan efisiensi pelayanan.</p>
                    </div>
                </div>

            </div>
        </div> --}}

    </main>

    <footer class="bg-white py-4 text-center">
        <div class="container">
            <p class="mb-0 text-muted">© {{ date('Y') }} Rumah Sakit Sehat Selalu. Ditenagai oleh Sistem Antrian Digital.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const mainNavbar = document.getElementById('mainNavbar');
            const heroSection = document.querySelector('.hero');
            
            // Fungsi untuk menentukan apakah navbar harus diubah warnanya
            function toggleNavbarColor() {
                // Mendapatkan posisi Hero Section (atau bisa juga menggunakan window.scrollY)
                const heroHeight = heroSection ? heroSection.offsetHeight : 0;
                
                if (window.scrollY > (heroHeight / 3)) { // Ubah warna setelah scroll sepertiga dari hero
                    mainNavbar.classList.remove('navbar-transparent');
                    mainNavbar.classList.add('navbar-scrolled');
                } else {
                    mainNavbar.classList.remove('navbar-scrolled');
                    mainNavbar.classList.add('navbar-transparent');
                }
            }

            // Panggil sekali saat dimuat
            toggleNavbarColor(); 

            // Tambahkan event listener saat scrolling
            window.addEventListener('scroll', toggleNavbarColor);
        });
    </script>

</body>
</html>