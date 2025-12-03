<?php

namespace App\Http\Controllers;

use App\Models\queues;
use Illuminate\Http\Request;

class QueuesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //  
        $queues = queues::all();
        return view('queues.index', compact('queues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $queues = queues::all();
        return view('queues.create', compact('queues'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'queue_number' => 'required|string|max:255|unique:queues',
            'service_type' => 'required|string|max:255',
            'status' => 'required|in:waiting,in_progress,completed',
            'called_by' => 'nullable|string|max:255',
            'called_at' => 'nullable|date',
        ]);

        queues::create($request->all());

        return redirect()->route('queues.index')
            ->with('success', 'Queue created successfully.');   
    }

    /**
     * Display the specified resource.
     */
    public function show(queues $queues)
    {
        $queues = queues::findOrFail($queues->id); 
        return view('queues.show', compact('queues'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(queues $queues)
    {
        $queues = queues::findOrFail($queues->id); 
        return view('queues.edit', compact('queues'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, queues $queues)
    {
        $request->validate([
            'queue_number' => 'required|string|max:255|unique:queues,queue_number,' . $queues->id,
            'service_type' => 'required|string|max:255',
            'status' => 'required|in:waiting,in_progress,completed',
            'called_by' => 'nullable|string|max:255',
            'called_at' => 'nullable|date',
        ]);

        $queues->update($request->all());

        return redirect()->route('queues.index')
            ->with('success', 'Queue updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(queues $queues)
    {
        $queues->delete();

        return redirect()->route('queues.index')
            ->with('success', 'Queue deleted successfully.');
    }
}
