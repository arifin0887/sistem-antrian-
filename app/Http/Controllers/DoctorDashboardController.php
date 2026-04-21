<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\queue;
use App\Models\MedicalRecord;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DoctorDashboardController extends Controller
{
    public function index()
    {
        $serviceId = Auth::user()->service_id ?? 1;
        if (!Auth::user()->service_id) {
            Auth::user()->update(['service_id' => 1]);
        }

        $activePatient = queue::where('service_id', $serviceId)
            ->where('status', 'in_progress')
            ->whereDate('created_at', Carbon::today())
            ->first();

        $waitingQueues = queue::where('service_id', $serviceId)
            ->where('status', 'waiting')
            ->whereDate('created_at', Carbon::today())
            ->orderBy('id', 'asc')
            ->get();

        return view('dokter.dashboard', compact('activePatient', 'waitingQueues'));
    }

    public function storeMedicalRecord(Request $request, $id)
    {
        $request->validate([
            'anamnesis' => 'nullable|string|max:1000',
            'physical_exam' => 'nullable|string|max:1000',
            'diagnosis' => 'nullable|string|max:255',
            'therapy' => 'nullable|string|max:1000',
            'notes' => 'nullable',
        ]);

        $queue = queue::findOrFail($id);
        MedicalRecord::create([
            'queue_id' => $id,
            'doctor_id' => Auth::id(),
            'anamnesis' => $request->anamnesis,
            'physical_exam' => $request->physical_exam,
            'diagnosis' => $request->diagnosis,
            'therapy' => $request->therapy,
            'notes' => $request->notes,
        ]);

        $queue->update(['status' => 'completed', 'completed_at' => now()]);

        return redirect()->route('dokter.dashboard')->with('success', 'Rekam medis tersimpan dan antrian selesai.');
    }

    public function skipPatient(Request $request, $id)
    {
        $queue = queue::findOrFail($id);
        $queue->update(['status' => 'waiting']);

        return redirect()->route('dokter.dashboard')->with('info', 'Pasien ditunda.');
    }

    public function callNext(Request $request)
    {
        $serviceId = Auth::user()->service_id ?? 1;
        
        $nextQueue = queue::where('service_id', $serviceId)
            ->where('status', 'waiting')
            ->whereDate('created_at', Carbon::today())
            ->orderBy('id', 'asc')
            ->first();
            
        if (!$nextQueue) {
            return redirect()->route('dokter.dashboard')->with('info', 'Tidak ada antrian tersedia.');
        }
        
        $nextQueue->update([
            'status' => 'in_progress',
            'called_at' => now()
        ]);
        
        return redirect()->route('dokter.dashboard')->with('success', 'Antrian ' . $nextQueue->queue_number . ' (' . $nextQueue->customer_name . ') telah dipanggil.');
    }

    public function getMedicalRecord($id)
    {
        $record = \App\Models\MedicalRecord::findOrFail($id);
        return response()->json($record);
    }
}

