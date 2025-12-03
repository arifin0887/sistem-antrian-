<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use Illuminate\Http\Request;

class QueueProcessController extends Controller
{
    public function call($id)
    {
        $queue = Queue::findOrFail($id);
        $queue->update([
            'status' => 'in_progress',
            'called_at' => now(),
        ]);
        return back()->with('success', 'Pasien telah dipanggil!');
    }

    public function done($id)
    {
        $queue = Queue::findOrFail($id);
        $queue->update([
            'status' => 'completed',
            'finished_at' => now(),
        ]);
        return back()->with('success', 'Antrian telah diselesaikan!');
    }
}
