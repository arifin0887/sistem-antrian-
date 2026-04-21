<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;

class OperatorDashboardController extends Controller
{
    public function index()
    {
        $totalPasien = Queue::count();
        $totalDocter = User::where('role', 'docter')->count();
        $antrianHariIni = Queue::whereDate('created_at', Carbon::today())
            ->whereIn('status', ['waiting', 'in_progress']) 
            ->count();
        $totalPoli = Service::count();
        $services = Service::all();
        $daftarAntrian = Queue::with('service')
            ->whereIn('status', ['waiting', 'in_progress']) 
            ->whereDate('created_at', Carbon::today()) 
            ->orderBy('created_at', 'ASC')
            ->get();

        return view('operator.dashboard', compact(
            'totalPasien',
            'totalDocter',
            'antrianHariIni',
            'totalPoli',
            'daftarAntrian',
            'services'
        ));
    }
}

