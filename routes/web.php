<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\OperatorDashboardController;
use App\Http\Controllers\DoctorDashboardController;
use App\Http\Controllers\QueueProcessController;

Route::get('/', function () {
    return view('welcome');
});

// --- Autentikasi ---
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- Rute Terproteksi (Hanya yang sudah Login) ---
Route::middleware('auth')->group(function () {
    
    // 1. Dashboard Admin
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // 2. Dashboard Operator
    Route::get('/operator/dashboard', [OperatorDashboardController::class, 'index'])->name('operator.dashboard');

    // 3. Dashboard Dokter (Role: docter)
    Route::get('/dokter/dashboard', [DoctorDashboardController::class, 'index'])->name('dokter.dashboard');

    // --- Manajemen Antrian (Shared/General) ---
    Route::resource('queues', QueueController::class);
    
    // API JSON untuk update real-time di Dashboard Operator
    Route::get('/queues-json-today', [QueueController::class, 'jsonToday'])->name('queues.json.today');

    // Proses Antrian (Panggil, Selesai, Update Status)
    Route::post('/queues/{id}/call', [QueueProcessController::class, 'call'])->name('queues.call');
    Route::post('/queues/{id}/done', [QueueProcessController::class, 'done'])->name('queues.done');
    Route::post('/queues/{id}/status', [QueueController::class, 'updateStatus'])->name('queues.updateStatus');

// Rute Khusus Dokter (Simpan Rekam Medis & Tunda)
    Route::post('/dokter/save-record/{id}', [DoctorDashboardController::class, 'storeMedicalRecord'])->name('dokter.save-record');
    Route::post('/dokter/skip/{id}', [DoctorDashboardController::class, 'skipPatient'])->name('dokter.skip');
    Route::post('/dokter/call-next', [DoctorDashboardController::class, 'callNext'])->name('dokter.call-next');

});