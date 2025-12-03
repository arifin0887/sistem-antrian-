<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | Sistem Antrian RS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --blue-main: #0d6efd; 
            --blue-soft: #f0f7ff; 
            --blue-dark: #1f375f; 
            --text-muted: #6c757d;
            --card-bg: #ffffff;
            --border-light: #e0e9f6;
            --shadow-light: 0 4px 15px rgba(0, 0, 0, 0.04);
            --shadow-hover: 0 8px 25px rgba(0, 0, 0, 0.1);
            --navbar-height: 60px;
        }

        body {
            background: var(--blue-soft); 
            color: var(--blue-dark);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
        }

        .navbar {
            height: var(--navbar-height);
            position: fixed; 
            width: 100%; 
            z-index: 1000;
            background: white;
            border-bottom: 1px solid #e9ecef;
        }

        .content {
            padding-top: calc(var(--navbar-height) + 30px); 
            padding-left: 30px;
            padding-right: 30px;
            padding-bottom: 30px;
        }

        .card-custom {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 30px; 
            box-shadow: var(--shadow-light);
            border: none; 
            transition: 0.3s ease;
        }
        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .card-title { font-size: 0.95rem; color: var(--text-muted); }
        .card-count { font-size: 2.5rem; font-weight: 900; color: var(--blue-dark); }

        .table-wrapper {
            margin-top: 40px;
            background: var(--card-bg);
            border-radius: 12px;
            padding: 25px;
            box-shadow: var(--shadow-light);
            border: 1px solid var(--border-light);
        }
        .table thead {
            background: var(--blue-main);
            color: white;
        }
        .table tbody tr:hover {
            background: var(--blue-soft) !important;
        }

        .badge { border-radius: 1rem; padding: 0.45em 0.7em; }
        .bg-warning { background-color: #ffc10740 !important; color: #664d03 !important; border: 1px solid #ffc107; }
        .bg-primary { background-color: var(--blue-main) !important; }
        .bg-success { background-color: #28a745 !important; }
    </style>
</head>

<body>

    <nav class="navbar navbar-light shadow-sm px-4">
        <span class="navbar-brand h5 mb-0">
            <i class="fas fa-hospital text-primary me-2"></i> Rumah Sakit Sehat Selalu
        </span>

        <div class="dropdown ms-auto">
            <a class="nav-link dropdown-toggle text-dark" href="#" data-bs-toggle="dropdown">
                <i class="fas fa-user-circle me-2"></i> Admin
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <form method="POST" action="{{ route('logout') }}"> 
                        @csrf 
                        <button class="dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <div class="content">

        <h2 class="mb-2">Selamat Datang, Admin!</h2>
        <p>Ringkasan data antrian dan statistik utama.</p>

        <div class="row g-4">

            <div class="col-md-6 col-lg-3">
                <div class="card-custom">
                    <div class="card-title">Total Pasien</div>
                    <div class="card-count">{{ $totalPasien }}</div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card-custom">
                    <div class="card-title">Total Dokter</div>
                    <div class="card-count">{{ $totalDocter }}</div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card-custom">
                    <div class="card-title">Antrian Hari Ini</div>
                    <div class="card-count">{{ $antrianHariIni }}</div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card-custom">
                    <div class="card-title">Poli Aktif</div>
                    <div class="card-count">{{ $totalPoli}}</div>
                </div>
            </div>
        </div>

        <div class="table-wrapper">
            <h4><i class="fas fa-list-alt me-2"></i> Daftar Antrian Hari Ini</h4>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nomor Antrian</th>
                        <th>Nama Pasien</th>
                        <th>Layanan / Poli</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($daftarAntrian ?? [] as $a)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><b>{{ $a->queue_number }}</b></td>
                        <td>{{ $a->customer_name }}</td>
                        <td>{{ $a->service->name ?? 'N/A' }}</td>

                        <td>
                            @if($a->status == 'waiting')
                                <span class="badge bg-warning">Menunggu</span>
                            @elseif($a->status == 'in_progress')
                                <span class="badge bg-primary">Dipanggil</span>
                            @else
                                <span class="badge bg-success">Selesai</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-3">
                            <i class="fas fa-info-circle me-1"></i> Belum ada antrian hari ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
