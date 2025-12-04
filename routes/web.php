<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\OperatorDashboardController;
use App\Http\Controllers\QueueProcessController;

Route::get('/', function () {
    return view('welcome');
});

// Autentikasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('queues', QueuesController::class);

    Route::prefix('admin')->name('admin.')->group(function () {
        
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
    });

    Route::prefix('operator')->name('operator.')->group(function () {
        
        Route::get('/dashboard', function () {
            return view('operator.dashboard');
        })->name('dashboard');
        
    });

    Route::middleware(['auth'])->group(function () {

    Route::resource('queues', QueueController::class);

    Route::post('/queues/{id}/status', [QueueController::class, 'updateStatus'])
        ->name('queues.updateStatus');});

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::get('operator/dashboard', [OperatorDashboardController::class, 'index'])
        ->name('operator.dashboard');

    Route::post('/queues/{id}/call', [QueueProcessController::class, 'call'])->name('queues.call');
    Route::post('/queues/{id}/done', [QueueProcessController::class, 'done'])->name('queues.done');

    Route::get('/operator/dashboard', [OperatorDashboardController::class, 'index'])
    ->name('operator.dashboard');

    Route::get('/queues/json/today', [QueueController::class, 'jsonToday'])
    ->name('queues.json.today');

});