<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Operator | RS Selalu Sehat</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-blue: #0f62fe;
            --soft-bg: #f4f7fb;
            --text-dark: #161616;
        }

        body {
            background-color: var(--soft-bg);
            color: var(--text-dark);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
        }

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

        .content {
            padding: 100px 2rem 2rem;
        }

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

        .table-card {
            background: white;
            border-radius: 24px;
            border: 1px solid #edf2f7;
            padding: 2rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        }

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

        .btn-action {
            border-radius: 12px;
            padding: 8px 16px;
            font-weight: 600;
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
        <div class="row align-items-center mb-5">
            <div class="col-md-7">
                <h2 class="fw-800 mb-2">Pusat Kendali Antrian</h2>
                <p class="text-muted mb-0">Pantau alur pasien real-time.</p>
            </div>
            <div class="col-md-5 text-md-end">
                <button class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahAntrian">
                    <i class="fas fa-plus me-2"></i> Daftarkan Baru
                </button>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-xl-3 col-md-6">
                <div class="stat-card bg-gradient-blue text-white">
                    <div class="stat-label">Total Pasien</div>
                    <div class="stat-val">{{ $totalPasien }}</div>
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="stat-card bg-gradient-purple text-white">
                    <div class="stat-label">Dokter On Duty</div>
                    <div class="stat-val">{{ $totalDocter }}</div>
                    <i class="fas fa-user-md"></i>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="stat-card bg-gradient-cyan text-white">
                    <div class="stat-label">Antrian Hari Ini</div>
                    <div class="stat-val">{{ $antrianHariIni }}</div>
                    <i class="fas fa-ticket-alt"></i>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="stat-card bg-gradient-orange text-white">
                    <div class="stat-label">Poli Aktif</div>
                    <div class="stat-val">{{ $totalPoli }}</div>
                    <i class="fas fa-clinic-medical"></i>
                </div>
            </div>
        </div>

        <div class="table-card">
            <ul class="nav nav-tabs mb-4" id="operatorTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-bold" id="aktif-tab" data-bs-toggle="tab" data-bs-target="#aktif" type="button">
                        <i class="fas fa-list me-1"></i> Aktif (<span id="count-aktif">0</span>)
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold" id="selesai-tab" data-bs-toggle="tab" data-bs-target="#selesai" type="button">
                        <i class="fas fa-check-double me-1"></i> Selesai (<span id="count-selesai">0</span>)
                    </button>
                </li>
            </ul>

            <div class="tab-content">
                <!-- Tab Aktif -->
                <div class="tab-pane fade show active" id="aktif" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No Antrian</th>
                                    <th>Pasien</th>
                                    <th>Poli</th>
                                    <th>Status</th>
                                    <th>Kendali</th>
                                </tr>
                            </thead>
<tbody id="data-aktif">
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="fas fa-inbox fa-2x mb-3 opacity-50"></i><br>Tidak ada data
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tab Selesai -->
                <div class="tab-pane fade" id="selesai" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No Antrian</th>
                                    <th>Pasien</th>
                                    <th>Poli</th>
                                    <th>Dokter</th>
                                    <th>Resume</th>
                                </tr>
                            </thead>
<tbody id="data-selesai">
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="fas fa-check-circle fa-2x mb-3 opacity-50"></i><br>Tidak ada data selesai
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Antrian -->
    <div class="modal fade" id="modalTambahAntrian" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header pb-0 border-0">
                    <h5 class="modal-title fw-bold">
                        <i class="fas fa-plus-circle text-primary me-2"></i>
                        Daftar Antrian Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('queues.store') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted mb-2">Nama Lengkap Pasien</label>
                            <input type="text" name="customer_name" class="form-control form-control-lg" placeholder="Masukkan nama pasien" required>
                        </div>
                        <div class="mb-0">
                            <label class="form-label fw-bold small text-muted mb-2">Pilih Unit Layanan</label>
                            <select name="service_id" class="form-select form-select-lg" required>
                                <option value="">Pilih Poli...</option>
                                @foreach($services ?? [] as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
                            <i class="fas fa-paper-plane me-2"></i> Proses Antrian
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Resume -->
    <div class="modal fade" id="resumeModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">
                        <i class="fas fa-file-medical text-info me-2"></i> Resume Dokter
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="resumeContent">
                    Loading...
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let allData = [];

        function getStatusBadge(status) {
            switch(status) {
                case 'waiting': return '<span class="status-badge badge-waiting">Menunggu</span>';
                case 'in_progress': return '<span class="status-badge badge-active">Dipanggil</span>';
                case 'completed': return '<span class="status-badge badge-done">Selesai</span>';
                default: return '<span class="status-badge bg-secondary">Unknown</span>';
            }
        }

        function renderTable(containerId, data, isSelesai = false) {
            let html = '';
            if (data.length === 0) {
                html = '<tr><td colspan="' + (isSelesai ? '6' : '6') + '" class="text-center py-5 text-muted"><i class="fas fa-inbox fa-2x mb-3 opacity-50"></i><br>Tidak ada data</td></tr>';
            } else {
                data.forEach((queue, index) => {
                    if (isSelesai) {
                        html += `
                            <tr>
                                <td>${index + 1}</td>
                                <td><strong class="text-success">${queue.queue_number}</strong></td>
                                <td>${queue.customer_name}<br><small class="text-muted">#${queue.id}</small></td>
                                <td><span class="badge bg-light text-dark">${queue.service?.name || 'Umum'}</span></td>
                                <td>${queue.medicalRecord?.doctor?.name || 'N/A'}</td>
                                <td>
                                    ${queue.medicalRecord ? 
                                        '<button class="btn btn-sm btn-info" onclick="showResume(' + JSON.stringify(queue.medicalRecord || {}) + ')"><i class="fas fa-eye"></i> Resume</button>' 
                                        : '<span class="text-muted">No Resume</span>'
                                    }
                                </td>
                            </tr>`;
                    } else {
                        html += `
                            <tr>
                                <td>${index + 1}</td>
                                <td><strong>${queue.queue_number}</strong></td>
                                <td>${queue.customer_name}<br><small class="text-muted">#${queue.id}</small></td>
                                <td><span class="badge bg-light text-dark">${queue.service?.name || 'Umum'}</span></td>
                                <td>${getStatusBadge(queue.status)}</td>
                                <td>
                                    ${queue.status === 'waiting' ? 
                                        '<form method="POST" action="/queues/' + queue.id + '/call" class="d-inline">
                                            @csrf
                                            <button class="btn btn-sm btn-primary"><i class="fas fa-bullhorn"></i> Panggil</button>
                                        </form>' : 
                                        (queue.status === 'in_progress' ? '<span class="badge bg-warning">Menunggu Dokter</span>' : '')
                                    }
                                </td>
                            </tr>`;
                    }
                });
            }
            document.getElementById(containerId).innerHTML = html;
        }

        function showResume(record) {
            let html = '<div class="row g-3">';
            if (record.anamnesis) html += '<div class="col-12"><strong>Anamnesis:</strong> ' + record.anamnesis + '</div>';
            if (record.physical_exam) html += '<div class="col-md-6"><strong>Fisik:</strong> ' + record.physical_exam + '</div>';
            if (record.diagnosis) html += '<div class="col-md-6"><strong>Diagnosis:</strong> ' + record.diagnosis + '</div>';
            if (record.therapy) html += '<div class="col-12"><strong>Terapi:</strong> ' + record.therapy + '</div>';
            if (record.notes) html += '<div class="col-12"><strong>Catatan:</strong> ' + record.notes + '</div>';
            html += '<div class="col-12 mt-3 pt-3 border-top"><small class="text-muted">Oleh: ' + (record.doctor?.name || 'Dokter') + ' | ' + new Date(record.created_at).toLocaleString('id-ID') + '</small></div>';
            html += '</div>';
            document.getElementById('resumeContent').innerHTML = html;
            new bootstrap.Modal(document.getElementById('resumeModal')).show();
        }

        function loadData() {
            fetch("{{ route('queues.json.today') }}")
                .then(r => r.json())
                .then(data => {
                    allData = data;
                    const aktif = data.filter(q => ['waiting', 'in_progress'].includes(q.status));
                    const selesai = data.filter(q => q.status === 'completed');
                    document.getElementById('count-aktif').textContent = aktif.length;
                    document.getElementById('count-selesai').textContent = selesai.length;
                    renderTable('data-aktif', aktif, false);
                    renderTable('data-selesai', selesai, true);
                })
                .catch(() => {
                    ['data-aktif', 'data-selesai'].forEach(id => {
                        document.getElementById(id).innerHTML = '<tr><td colspan="6" class="text-center text-danger py-4">Gagal memuat data</td></tr>';
                    });
                });
        }

        document.addEventListener('DOMContentLoaded', () => {
            loadData();
            setInterval(loadData, 5000);

            // Tab switch
            document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
                tab.addEventListener('shown.bs.tab', () => loadData());
            });
        });
    </script>

    <div class="modal fade" id="resumeModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-file-alt text-info me-2"></i> Resume Pemeriksaan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="resumeContent">
                    Loading...
                </div>
            </div>
        </div>
    </div>
</body>
</html>

