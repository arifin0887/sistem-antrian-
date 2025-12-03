@extends('layouts.app')

@section('content')
<div class="container">

    <h3 class="mb-3">Daftar Antrian</h3>

    <a href="{{ route('queues.create') }}" class="btn btn-primary mb-3">Tambah Antrian</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No Antrian</th>
                <th>Nama</th>
                <th>Layanan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($queues as $q)
            <tr>
                <td>{{ $q->queue_number }}</td>
                <td>{{ $q->customer_name }}</td>
                <td>{{ $q->service->name }}</td>
                <td>
                    <span class="badge bg-info">{{ ucfirst($q->status) }}</span>
                </td>
                <td>
                    <a href="{{ route('queues.show', $q->id) }}" class="btn btn-sm btn-secondary">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

</div>
@endsection
