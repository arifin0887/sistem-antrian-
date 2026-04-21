<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Operator') | RS Selalu Sehat</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-blue: #0f62fe;
            --soft-bg: #f4f7fb;
            --text-dark: #161616;
            --accent-purple: #8a3ffc;
            --accent-cyan: #007d79;
        }

        body {
            background-color: var(--soft-bg);
            color: var(--text-dark);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
        }

        /* --- Custom Navbar --- */
        .navbar {
            background: rgba(255, 255, 255, 0.9) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #e0e0e0;
            padding: 0.8rem 2rem;
        }

        .navbar-brand {
            font-weight: 800;
            letter-spacing: -0.5px;
            color: var(--primary-blue) !important;
        }

        /* --- Dashboard Content --- */
        .content {
            padding: 100px 2rem 2rem;
        }

        .welcome-section h2 {
            font-weight: 800;
            margin-bottom: 5px;
        }

        /* --- Stats Cards --- */
        .stat-card {
            border: none;
            border-radius: 20px;
            padding: 25px;
            color: white;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }

        .stat-card i {
            position: absolute;
            right: -10px;
            bottom: -10px;
            font-size: 5rem;
            opacity: 0.2;
        }

        .bg-gradient-blue { background: linear-gradient(135deg, #0f62fe, #002d9c); }
        .bg-gradient-purple { background: linear-gradient(135deg, #8a3ffc, #491d8b); }
        .bg-gradient-cyan { background: linear-gradient(135deg, #007d79, #004144); }
        .bg-gradient-orange { background: linear-gradient(135deg, #fa4d56, #a2191f); }

        .stat-val {
            font-size: 2.2rem;
            font-weight: 800;
            display: block;
        }

        .stat-label {
            font-size: 0.9rem;
            font-weight: 500;
            opacity: 0.9;
            text-transform: uppercase;
        }

        /* --- Table Container --- */
        .table-card {
            background: white;
            border-radius: 24px;
            border: 1px solid #edf2f7;
            padding: 2rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        }

        .table thead th {
            background: #f8fafc;
            color: #4a5568;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            border-top: none;
            padding: 15px;
        }

        .table td {
            padding: 15px;
            vertical-align: middle;
        }

        /* --- Badges --- */
        .status-badge {
            padding: 6px 14px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.75rem;
            border: 1px solid transparent;
        }

        .badge-waiting { background: #fff8e1; color: #b78103; border-color: #ffe082; }
        .badge-active { background: #e8f0fe; color: #0f62fe; border-color: #a6c8ff; }
        .badge-done { background: #e5fbe5; color: #198038; border-color: #a7f0ba; }

        /* --- Buttons --- */
        .btn-action {
            border-radius: 12px;
            padding: 8px 16px;
            font-weight: 600;
            transition: 0.2s;
        }

        .btn-add {
            background: var(--primary-blue);
            border-radius: 50px;
            padding: 12px 25px;
            font-weight: 700;
            box-shadow: 0 4px 14px rgba(15, 98, 254, 0.4);
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa-microscope me-2"></i>SELALU SEHAT
            </a>
            
            <div class="dropdown ms-auto">
                <button class="btn btn-light rounded-pill px-4 d-flex align-items-center border" data-bs-toggle="dropdown">
                    <div class="bg-primary rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 24px; height: 24px;">
                        <i class="fas fa-user-shield text-white" style="font-size: 12px;"></i>
                    </div>
                    <span class="small fw-bold">Operator Unit</span>
                    <i class="fas fa-chevron-down ms-2 small opacity-50"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-2">
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger fw-bold">
                                <i class="fas fa-sign-out-alt me-2"></i> Keluar Sistem
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="content">
        <div class="row align-items-center mb-5 welcome-section">
            <div class="col-md-7">
                <h2 class="text-dark">Pusat Kendali Antrian</h2>
                <p class="text-muted">Pantau dan kelola alur pasien secara efisien hari ini.</p>
            </div>
            <div class="col-md-5 text-md-end">
                <button class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#modalTambahAntrian">
                    <i class="fas fa-plus-circle me-2"></i> Daftarkan Pasien Baru
                </button>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="stat-card bg-gradient-blue">
                    <span class="stat-label">Pasien Terdaftar</span>
                    <span class="stat-val">{{ $totalPasien ?? 128 }}</span>
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card bg-gradient-purple">
                    <span class="stat-label">Dokter On-Duty</span>
                    <span class="stat-val">{{ $totalDocter ?? 14 }}</span>
                    <i class="fas fa-user-md"></i>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card bg-gradient-cyan">
                    <span class="stat-label">Antrian Hari Ini</span>
                    <span class="stat-val">{{ $antrianHariIni ?? 42 }}</span>
                    <i class="fas fa-ticket-alt"></i>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card bg-gradient-orange">
                    <span class="stat-label">Unit Poli Aktif</span>
                    <span class="stat-val">{{ $totalPoli ?? 8 }}</span>
                    <i class="fas fa-clinic-medical"></i>
                </div>
            </div>
        </div>

        <div class="table-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">Antrian Real-Time</h5>
                <div class="badge bg-soft-primary text-primary p-2">
                    <i class="fas fa-sync fa-spin me-1"></i> Live Update Aktif
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>No. Antrian</th>
                            <th>Identitas Pasien</th>
                            <th>Unit Layanan</th>
                            <th>Status Alur</th>
                            <th class="text-end">Kendali</th>
                        </tr>
                    </thead>
                    <tbody id="data-antrian">
                        <tr class="text-center">
                            <td colspan="6" class="py-5">
                                <div class="spinner-border text-primary" role="status"></div>
                                <p class="mt-2 text-muted">Sinkronisasi data...</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambahAntrian" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold"><i class="fas fa-id-card me-2 text-primary"></i>Registrasi Antrian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('queues.store') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">NAMA LENGKAP PASIEN</label>
                            <input type="text" name="customer_name" class="form-control form-control-lg border-2 shadow-none" placeholder="Contoh: Budi Santoso" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">PILIH UNIT LAYANAN</label>
                            <select name="service_id" class="form-select form-select-lg border-2 shadow-none" required>
                                <option value="">Pilih Poli Tujuan...</option>
                                <option value="1">Poli Umum</option>
                                <option value="2">Poli Gigi</option>
                                <option value="3">Poli Anak</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">Proses Antrian</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    // JS Logic untuk merender badge dengan style baru
    function getStatusBadge(status) {
        switch(status) {
            case 'waiting': return '<span class="status-badge badge-waiting">Menunggu</span>';
            case 'in_progress': return '<span class="status-badge badge-active">Sedang Dilayani</span>';
            case 'done': return '<span class="status-badge badge-done">Selesai</span>';
            default: return '<span class="status-badge bg-secondary">Unknown</span>';
        }
    }

    function loadAntrian() {
        fetch("{{ route('queues.json.today') }}")
            .then(response => response.json())
            .then(data => {
                let html = "";
                if(data.length === 0) {
                    html = '<tr><td colspan="6" class="text-center py-5 text-muted">Belum ada pasien terdaftar hari ini.</td></tr>';
                } else {
                    data.forEach((a, index) => {
                        html += `
                        <tr>
                            <td class="text-muted small">${index + 1}</td>
                            <td><span class="h5 fw-black text-primary mb-0">${a.queue_number}</span></td>
                            <td>
                                <div class="fw-bold">${a.customer_name}</div>
                                <div class="small text-muted">ID: #00${a.id}</div>
                            </td>
                            <td><span class="badge bg-light text-dark border">${a.service ? a.service.name : 'Umum'}</span></td>
                            <td>${getStatusBadge(a.status)}</td>
                            <td class="text-end">
                                ${a.status === 'waiting' ? `
                                    <form action="/queues/${a.id}/call" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-sm btn-primary btn-action shadow-sm">
                                            <i class="fas fa-bullhorn me-1"></i> Panggil
                                        </button>
                                    </form>` : ''}
                                ${a.status === 'in_progress' ? `
                                    <form action="/queues/${a.id}/done" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-sm btn-success btn-action shadow-sm">
                                            <i class="fas fa-check-circle me-1"></i> Selesaikan
                                        </button>
                                    </form>` : ''}
                            </td>
                        </tr>`;
                    });
                }
                document.getElementById("data-antrian").innerHTML = html;
            })
            .catch(err => {
                document.getElementById("data-antrian").innerHTML = '<tr><td colspan="6" class="text-center text-danger py-4">Gagal memuat data antrian.</td></tr>';
            });
    }

    setInterval(loadAntrian, 5000);
    loadAntrian();
    </script>
</body>
</html>