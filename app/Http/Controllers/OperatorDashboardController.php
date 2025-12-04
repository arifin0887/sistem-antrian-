<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use App\Models\Service;
use App\Models\User;

class OperatorDashboardController extends Controller
{
    public function index()
    {
        $totalPasien = Queue::count();
        $totalDocter = User::where('role', 'docter')->count();
        $antrianHariIni = Queue::whereDate('created_at', today())
            ->whereIn('status', ['waiting', 'in_progress']) 
            ->count();
        $totalPoli = Service::count();
        $daftarAntrian = Queue::with('service')
            ->whereIn('status', ['waiting', 'in_progress']) 
            ->whereDate('created_at', today()) 
            ->orderBy('created_at', 'ASC')
            ->get();

        return view('operator.dashboard', compact(
            'totalPasien',
            'totalDocter',
            'antrianHariIni',
            'totalPoli',
            'daftarAntrian'
        ));
    }
}
