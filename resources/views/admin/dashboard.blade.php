<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | Sistem Antrian RS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

    :root {
        --blue-main: #2563eb; 
        --blue-soft: #f8fafc; 
        --blue-dark: #1e293b; 
        --text-muted: #64748b;
        --card-bg: #ffffff;
        --border-light: #f1f5f9;
        --shadow-light: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
        --shadow-hover: 0 10px 15px -3px rgb(0 0 0 / 0.1);
        --navbar-height: 70px;
    }

    body {
        background: var(--blue-soft); 
        color: var(--blue-dark);
        font-family: 'Inter', sans-serif;
        min-height: 100vh;
        letter-spacing: -0.01em;
    }

    /* Navbar Modern */
    .navbar {
        height: var(--navbar-height);
        position: fixed; 
        width: 100%; 
        z-index: 1000;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid var(--border-light);
    }

    .navbar-brand {
        font-weight: 700;
        color: var(--blue-main) !important;
        letter-spacing: -0.5px;
    }

    /* Content Area */
    .content {
        padding-top: calc(var(--navbar-height) + 40px); 
        max-width: 1200px;
        margin: 0 auto;
        padding-left: 20px;
        padding-right: 20px;
    }

    /* Stats Cards */
    .card-custom {
        background: var(--card-bg);
        border-radius: 16px;
        padding: 24px; 
        box-shadow: var(--shadow-light);
        border: 1px solid var(--border-light);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }

    .card-custom:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-hover);
        border-color: var(--blue-main);
    }

    .card-icon {
        width: 45px;
        height: 45px;
        background: var(--blue-soft);
        color: var(--blue-main);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        margin-bottom: 15px;
    }

    .card-title { 
        font-size: 0.875rem; 
        font-weight: 600;
        color: var(--text-muted); 
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .card-count { 
        font-size: 2rem; 
        font-weight: 800; 
        color: var(--blue-dark); 
        line-height: 1;
    }

    /* Table Design */
    .table-wrapper {
        margin-top: 30px;
        background: var(--card-bg);
        border-radius: 16px;
        padding: 0; /* Container padding diatur ulang */
        overflow: hidden;
        box-shadow: var(--shadow-light);
        border: 1px solid var(--border-light);
    }

    .table-header {
        padding: 20px 25px;
        border-bottom: 1px solid var(--border-light);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .table {
        margin-bottom: 0;
    }

    .table thead th {
        background: #f8fafc;
        color: var(--text-muted);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        padding: 15px 25px;
        border-top: none;
    }

    .table tbody td {
        padding: 18px 25px;
        vertical-align: middle;
        color: var(--blue-dark);
        font-size: 0.95rem;
        border-color: var(--border-light);
    }

    /* Status Badges */
    .badge { 
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.75rem;
    }

    .badge-waiting { background: #fef3c7; color: #92400e; }
    .badge-process { background: #dbeafe; color: #1e40af; }
    .badge-success { background: #dcfce7; color: #166534; }

</style>

</head>

<body>

    <nav class="navbar navbar-light px-4">
    <div class="container-fluid">
        <span class="navbar-brand mb-0">
            <i class="fas fa-notes-medical me-2"></i> SEHAT SELALU
        </span>

        <div class="dropdown ms-auto">
            <button class="btn btn-link dropdown-toggle text-decoration-none text-dark fw-bold" data-bs-toggle="dropdown">
                <img src="https://ui-avatars.com/api/?name=Admin&background=0D6EFD&color=fff" class="rounded-circle me-2" width="32">
                Admin
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                <li>
                    <form method="POST" action="{{ route('logout') }}"> 
                        @csrf 
                        <button class="dropdown-item text-danger py-2">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="content">
    <div class="mb-4">
        <h2 class="fw-bold mb-1">Halo, Administrator 👋</h2>
        <p class="text-muted">Pantau aktivitas antrian rumah sakit hari ini secara real-time.</p>
    </div>

    <div class="row g-4">
        <div class="col-md-6 col-lg-3">
            <div class="card-custom">
                <div class="card-icon"><i class="fas fa-users"></i></div>
                <div>
                    <div class="card-title">Total Pasien</div>
                    <div class="card-count">{{ $totalPasien }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card-custom">
                <div class="card-icon"><i class="fas fa-user-md"></i></div>
                <div>
                    <div class="card-title">Total Dokter</div>
                    <div class="card-count">{{ $totalDocter }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card-custom">
                <div class="card-icon"><i class="fas fa-clock"></i></div>
                <div>
                    <div class="card-title">Antrian Hari Ini</div>
                    <div class="card-count">{{ $antrianHariIni }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card-custom">
                <div class="card-icon"><i class="fas fa-clinic-medical"></i></div>
                <div>
                    <div class="card-title">Poli Aktif</div>
                    <div class="card-count">{{ $totalPoli }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="table-wrapper">
        <div class="table-header">
            <h5 class="mb-0 fw-bold"><i class="fas fa-list-ul me-2 text-primary"></i>Daftar Antrian</h5>
            <span class="badge bg-light text-dark border">{{ now()->format('d M Y') }}</span>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>No. Antrian</th>
                        <th>Nama Pasien</th>
                        <th>Layanan / Poli</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($daftarAntrian ?? [] as $a)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><span class="fw-bold text-primary">{{ $a->queue_number }}</span></td>
                        <td>{{ $a->customer_name }}</td>
                        <td><div class="text-muted small">Poli</div>{{ $a->service->name ?? 'N/A' }}</td>
                        <td>
                            @if($a->status == 'waiting')
                                <span class="badge badge-waiting">Menunggu</span>
                            @elseif($a->status == 'in_progress')
                                <span class="badge badge-process">Dipanggil</span>
                            @else
                                <span class="badge badge-success">Selesai</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <img src="https://illustrations.popsy.co/blue/waiting-room.svg" alt="Empty" style="width: 150px; margin-bottom: 20px; display: block; margin-left: auto; margin-right: auto;">
                            Belum ada antrian untuk hari ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
