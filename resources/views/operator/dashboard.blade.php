<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Operator') | Sistem Antrian RS</title>

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
            top: 0;
            left: 0; 
            width: 100%; 
            position: fixed; 
            z-index: 1000;
            padding: 0 1.5rem;
            border-bottom: 1px solid #e9ecef;
        }
        .navbar-brand {
            color: var(--blue-dark) !important;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .content {
            padding-top: calc(var(--navbar-height) + 30px); 
            padding-bottom: 30px;
            padding-left: 30px;
            padding-right: 30px;
        }

        .page-header {
            margin-bottom: 30px;
        }
        .page-header h2 {
            font-weight: 800; 
            color: var(--blue-dark);
            font-size: 1.8rem;
        }
        .page-header p {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .card-custom {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 30px; 
            box-shadow: var(--shadow-light);
            border: none; 
            transition: 0.3s ease;
            height: 100%;
        }
        .card-custom:hover {
            transform: translateY(-5px); 
            box-shadow: var(--shadow-hover);
        }
        .card-title {
            font-size: 1rem;
            color: var(--text-muted); 
            margin-bottom: 5px;
            font-weight: 500;
            letter-spacing: 0.5px;
        }
        .card-count {
            font-size: 2.5rem; 
            font-weight: 900;
            color: var(--blue-dark); 
        }

        .table-wrapper {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 25px;
            box-shadow: var(--shadow-light);
            border: 1px solid var(--border-light);
        }
        .table thead {
            background: var(--blue-main);
            color: white;
            border-radius: 8px 8px 0 0;
        }
        .table thead th {
            border: none;
            font-weight: 600;
            vertical-align: middle;
            padding: 12px 15px;
        }
        .table tbody tr:hover {
            background: var(--blue-soft) !important;
            cursor: pointer;
        }
        .table tbody td b {
            color: var(--blue-main);
            font-weight: 700;
            font-size: 1.1em;
        }

        .badge {
            font-size: 0.85em;
            padding: 0.5em 0.8em;
            font-weight: 600;
            border-radius: 1rem;
        }
        .badge.bg-warning {
            color: #664d03 !important; 
            background-color: #ffc10740 !important; 
            border: 1px solid #ffc107;
        }
        .badge.bg-primary {
             background-color: var(--blue-main) !important;
        }
        .badge.bg-success {
            background-color: #28a745 !important;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-light bg-white shadow-sm">
        <div class="container-fluid d-flex align-items-center justify-content-between">

            <span class="navbar-brand mb-0 h5">
                <i class="fas fa-hospital me-2 text-primary"></i> Rumah Sakit Selalu Sehat
            </span>
            
            <div class="dropdown ms-auto">
                <a class="nav-link dropdown-toggle text-dark d-flex align-items-center" 
                href="#" id="navbarDropdown" 
                role="button" 
                data-bs-toggle="dropdown">
                    <i class="fas fa-user-circle me-2" style="font-size: 20px;"></i> 
                    Operator
                </a>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <form method="POST" action="{{ route('logout') }}"> 
                            @csrf 
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
            
        </div>
    </nav>

    <div class="content">
        
        <div class="page-header">
            <h2>Selamat Datang, Operator!</h2>
            <p>Kelola data antrian dan statistik utama sistem rumah sakit.</p>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-6 col-lg-3">
                <div class="card-custom">
                    <div class="card-title">Total Pasien Terdaftar</div>
                    <div class="card-count">{{ $totalPasien ?? 0 }}</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card-custom">
                    <div class="card-title">Total Dokter Aktif</div>
                    <div class="card-count">{{ $totalDocter?? 0 }}</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card-custom">
                    <div class="card-title">Antrian Hari Ini</div>
                    <div class="card-count">{{ $antrianHariIni ?? 0 }}</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card-custom">
                    <div class="card-title">Poli Aktif</div>
                    <div class="card-count">{{ $totalPoli ?? 0 }}</div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0 text-dark fw-bold">
                <i class="fas fa-list-alt me-2"></i> Daftar Antrian Hari Ini
            </h4>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahAntrian">
                <i class="fas fa-plus-circle me-1"></i> Tambah Antrian
            </button>
        </div>

        <div class="table-wrapper">
            <table class="table table-striped table-hover mt-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nomor Antrian</th>
                        <th scope="col">Nama Pasien</th>
                        <th scope="col">Poli Tujuan</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
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
                        <td>
                            @if($a->status == 'waiting')
                                <form action="{{ route('queues.call', $a->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-info text-white">
                                        <i class="fas fa-bullhorn"></i> Panggil
                                    </button>
                                </form>
                            @endif

                            @if($a->status == 'in_progress')
                                <form action="{{ route('queues.done', $a->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-success">
                                        <i class="fas fa-check"></i> Selesai
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <i class="fas fa-info-circle me-1"></i> Tidak ada antrian yang terdaftar hari ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    <div class="modal fade" id="modalTambahAntrian" tabindex="-1" aria-labelledby="modalTambahAntrianLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content shadow-lg">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalTambahAntrianLabel">
                        <i class="fas fa-plus-circle me-2"></i> Tambah Antrian Baru
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('queues.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        {{-- Input Nama Pelanggan --}}
                        <div class="mb-3">
                            <label for="customer_name" class="form-label fw-bold">Nama Pelanggan / Pasien</label>
                            <input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="Masukkan nama pasien/pelanggan" required>
                        </div>
                        
                        {{-- Input ID Layanan --}}
                        <div class="mb-3">
                            <label for="service_id" class="form-label fw-bold">Layanan Tujuan</label>
                            {{-- Sebaiknya ini berupa <select> dari data layanan (Poli) --}}
                            <input type="number" name="service_id" id="service_id" class="form-control" placeholder="Contoh: 1 (Poli Umum)">
                            <small class="text-muted">Nomor antrian akan digenerate secara otomatis oleh sistem.</small>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light border" data-bs-dismiss="modal">
                            <i class="fas fa-times-circle me-1"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Simpan Antrian
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')

</body>
</html>