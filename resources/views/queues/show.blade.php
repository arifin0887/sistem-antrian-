@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Detail Antrian</h3>

    <p>No Antrian : <strong>{{ $queue->queue_number }}</strong></p>
    <p>Nama : {{ $queue->customer_name }}</p>
    <p>Layanan : {{ $queue->service->name }}</p>
    <p>Status : {{ ucfirst($queue->status) }}</p>

    <form action="{{ route('queues.updateStatus', $queue->id) }}" method="POST">
        @csrf

        <label>Status Baru:</label>
        <select name="status" class="form-control mb-2">
            <option value="waiting">Waiting</option>
            <option value="in_progress">Dipanggil</option>
            <option value="completed">Selesai</option>
        </select>

        <button class="btn btn-success">Update</button>
    </form>

</div>
@endsection
