<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QueueController extends Controller
{
    public function index()
    {
        $queues = Queue::with('service')->orderBy('created_at', 'DESC')->get();
        return view('queues.index', compact('queues'));
    }

    public function create()
    {
        $services = Service::all();
        return view('queues.create', compact('services'));
    }

    private function generateQueueNumber($service_id)
    {
        $service = Service::findOrFail($service_id);
        $latest = Queue::where('service_id', $service_id)
                        ->orderBy('id', 'DESC')
                        ->first();
        if ($latest) {
            $lastNumber = intval(substr($latest->queue_number, strlen($service->prefix)));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        return $service->prefix . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'service_id' => 'required|exists:services,id',
        ]);
        Queue::create([
            'queue_number' => $this->generateQueueNumber($request->service_id),
            'customer_name' => $request->customer_name,
            'service_id' => $request->service_id,
            'user_id' => Auth::id(),
        ]);
        return redirect()->route('queues.index')->with('success', 'Antrian berhasil ditambahkan');
    }

    public function show($id)
    {
        $queue = Queue::with('service')->findOrFail($id);
        return view('queues.show', compact('queue'));
    }

    public function updateStatus(Request $request, $id)
    {
        $queue = Queue::findOrFail($id);
        $queue->status = $request->status;
        if ($request->status == 'in_progress') {
            $queue->called_at = now();
        }
        if ($request->status == 'completed') {
            $queue->completed_at = now();
        }
        $queue->save();
        return back()->with('success', 'Status berhasil diperbarui');
    }
}
