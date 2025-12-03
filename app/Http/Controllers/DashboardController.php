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
        $totalPasien = Queue::count();
        $totalDocter = User::where('role', 'docter')->count();
        $antrianHariIni = Queue::whereDate('created_at', Carbon::today())->count();
        $totalPoli = Service::count();
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
