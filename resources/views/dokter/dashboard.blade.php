<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Dokter | RS Selalu Sehat</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --dr-primary: #2563eb;
            --dr-secondary: #eff6ff;
            --dr-dark: #1e293b;
            --dr-success: #10b981;
            --bg-body: #f8fafc;
        }

        body {
            background-color: var(--bg-body);
            color: var(--dr-dark);
            font-family: 'Inter', sans-serif;
        }

        .navbar-dr {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px 0 rgba(0, 0,0,0.1);
        }

        .current-patient-card {
            background: linear-gradient(135deg, var(--dr-primary), #1d4ed8);
            color: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 20px 25px -5px rgba(37, 99, 235, 0.3);
            position: relative;
            overflow: hidden;
            min-height: 200px;
        }

        .queue-item {
            border-left: 4px solid transparent;
            transition: all 0.2s;
            cursor: pointer;
        }

        .queue-item:hover {
            background-color: var(--dr-secondary);
            border-left-color: var(--dr-primary);
            transform: translateX(5px);
        }

        .queue-item.active {
            background-color: var(--dr-secondary);
            border-left-color: var(--dr-primary);
        }

        .status-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
        }

        .medical-form {
            background: white;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        @media (max-width: 768px) {
            .current-patient-card {
                border-radius: 12px;
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dr sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fas fa-stethoscope text-primary me-2"></i> Dokter Dashboard
            </a>
            <div class="d-flex align-items-center">
                <span class="me-3 d-none d-md-inline">
                    <div class="fw-bold">{{ Auth::user()->name ?? 'Dokter' }}</div>
                    <small class="text-muted">{{ $activePatient->service->name ?? 'Poli Umum' }}</small>
                </span>
                <form method="POST" action="{{ route('logout') }}" class="me-0">
                    @csrf
                    <button class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid py-4 px-3 px-md-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('info'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">
            <!-- Sidebar Queue -->
            <div class="col-lg-4 col-xl-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-header bg-light border-0">
                        <h6 class="mb-0 fw-bold">
                            <i class="fas fa-list me-2"></i> Antrian Pasien ({{ $waitingQueues->count() ?? 0 }})
                        </h6>
                    </div>
                    <div class="card-body p-0 overflow-auto" style="height: 400px;">
                        @forelse($waitingQueues as $queue)
                            <div class="queue-item p-3 active" onclick="selectQueue({{ $queue->id }})">
                                <div class="d-flex justify-content-between align-items-start mb-1">
                                    <span class="fw-bold fs-5 text-primary">{{ $queue->queue_number }}</span>
                                    <span class="status-badge bg-light text-primary border">Menunggu</span>
                                </div>
                                <div class="fw-semibold">{{ $queue->customer_name }}</div>
                                <small class="text-muted">{{ $queue->service->name ?? 'N/A' }}</small>
                            </div>
                        @empty
                            <div class="text-center py-4 text-muted">
                                <i class="fas fa-clock fa-2x mb-2 opacity-50"></i>
                                <div>Tidak ada antrian</div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-8 col-xl-9">
                @if($activePatient)
                    <div class="current-patient-card mb-4">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h6 class="opacity-75 small mb-1">Pasien Aktif</h6>
                                <h2 class="mb-2">{{ $activePatient->customer_name }}</h2>
                                <p class="mb-0"><i class="fas fa-hashtag me-2"></i> {{ $activePatient->queue_number }}</p>
                            </div>
                            <div class="col-md-4 text-end">
                                <div class="display-5 fw-bold mb-1">{{ $activePatient->service->name ?? 'N/A' }}</div>
                                <span class="status-badge bg-white text-primary px-3 py-2 fw-bold">Diproses</span>
                            </div>
                        </div>
                    </div>

                    <div class="medical-form p-4">
<form method="POST" action="{{ route('dokter.save-record', $activePatient->id) }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold small text-uppercase">Anamnesis</label>
                                    <textarea name="anamnesis" class="form-control" rows="3" placeholder="Keluhan pasien..."></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold small text-uppercase">Pemeriksaan Fisik</label>
                                    <textarea name="physical_exam" class="form-control" rows="3" placeholder="TD, RR, Nadi..."></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold small text-uppercase">Diagnosis</label>
                                    <input type="text" name="diagnosis" class="form-control" placeholder="Diagnosis ICD-10">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold small text-uppercase">Terapi</label>
                                    <textarea name="therapy" class="form-control" rows="3" placeholder="Obat & dosis..."></textarea>
                                </div>
                                <div class="col-12 mb-4">
                                    <label class="form-label fw-semibold small text-uppercase">Catatan Tambahan</label>
                                    <textarea name="notes" class="form-control" rows="2" placeholder="Rencana tindak lanjut..."></textarea>
                                </div>
                            </div>
                            <div class="d-flex gap-2 justify-content-end">
                                <form method="POST" action="{{ route('dokter.skip', $activePatient->id) }}" class="d-inline">
                                    @csrf @method('POST')
                                    <button type="submit" class="btn btn-outline-secondary">
                                        <i class="fas fa-pause"></i> Tunda
                                    </button>
                                </form>
                                <button type="submit" class="btn btn-success fw-bold px-4">
                                    <i class="fas fa-save me-2"></i> Selesai & Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-user-md fa-4x text-muted mb-4"></i>
                        <h4 class="text-muted">Tidak ada pasien aktif</h4>
                        <p class="text-muted">Panggil antrian berikutnya dari daftar sebelah.</p>
<form method="POST" action="{{ route('dokter.call-next') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-play me-2"></i> Panggil Selanjutnya
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function selectQueue(id) {
            // AJAX to call patient
            alert('Memanggil antrian ID: ' + id);
        }

        function nextQueue() {
            alert('Panggil antrian berikutnya');
        }
    </script>
</body>
</html>

