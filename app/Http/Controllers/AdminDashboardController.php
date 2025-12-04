<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Total pasien = semua data antrian
        $totalPasien = Queue::count();

        // Total dokter = user dengan role docter
        $totalDocter = User::where('role', 'docter')->count();

        // Antrian hari ini
        $antrianHariIni = Queue::whereDate('created_at', Carbon::today())->count();

        // Total Poli (services)
        $totalPoli = Service::count();

        // Daftar antrian hari ini
        $daftarAntrian = Queue::with(['service', 'user'])
            ->whereDate('created_at', Carbon::today())
            ->orderBy('created_at', 'ASC')
            ->get();

        return view('admin.dashboard', compact(
            'totalPasien',
            'totalDocter',
            'antrianHariIni',
            'totalPoli',
            'daftarAntrian'
        ));
    }
}
