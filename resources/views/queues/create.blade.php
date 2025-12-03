@extends('layouts.app')

@section('content')
<div class="container">

    <h3 class="mb-4">Tambah Antrian Baru</h3>

    <form action="{{ route('queues.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Customer</label>
            <input type="text" name="customer_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Pilih Layanan</label>
            <select name="service_id" class="form-control" required>
                <option value="">-- Pilih --</option>
                @foreach ($services as $s)
                <option value="{{ $s->id }}">{{ $s->name }} ({{ $s->prefix }})</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Simpan</button>

    </form>

</div>
@endsection
