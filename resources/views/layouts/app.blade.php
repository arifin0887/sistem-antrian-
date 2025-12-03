<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Antrian Rumah Sakit</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f6fa;
        }
        .sidebar {
            width: 240px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            background: #0d6efd;
            color: white;
            padding-top: 60px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            font-size: 15px;
        }
        .sidebar a:hover {
            background: rgba(255,255,255,0.2);
        }
        .content {
            margin-left: 240px;
            padding: 30px;
        }
        .navbar {
            position: fixed;
            left: 240px;
            right: 0;
            top: 0;
            z-index: 1000;
        }
    </style>

</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-light bg-white shadow-sm">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h5">Dashboard Sistem Antrian</span>

            <div class="d-flex align-items-center">
                <span class="me-3">Admin</span>
                <a href="#" class="btn btn-outline-danger btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <a href="#">Dashboard</a>
        <a href="#">Data Antrian</a>
        <a href="#">Poli</a>
        <a href="#">Data Pasien</a>
        <a href="#">Laporan</a>
        <a href="#">Pengaturan</a>
    </div>

    <!-- CONTENT -->
    <div class="content">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>
</html>
