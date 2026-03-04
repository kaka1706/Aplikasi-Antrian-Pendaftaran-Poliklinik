@extends('layouts.app')

@section('title', 'Detail Antrian')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('queues.index') }}">Antrian</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Detail Antrian</h5>
    </div>

    <div class="card-body p-4">

        <div class="mb-3">
            <label class="form-label">Mahasiswa</label>
            <p class="fw-semibold">Mahasiswa #{{ $queue->student_id }}</p>
        </div>

        <div class="mb-3">
            <label class="form-label">Jadwal Poli</label>
            <p class="fw-semibold">{{ $queue->schedule->poli_name ?? '-' }}</p>
            <small class="text-muted">
                {{ $queue->schedule->day ?? '' }},
                {{ $queue->schedule->time_start ?? '' }}–{{ $queue->schedule->time_end ?? '' }}
            </small>
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor Antrian</label>
            <p class="fw-semibold fs-4 badge bg-primary">{{ $queue->queue_number }}</p>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            @if ($queue->status == 'menunggu')
                <p><span class="badge bg-warning text-dark">Menunggu</span></p>
            @elseif ($queue->status == 'dipanggil')
                <p><span class="badge bg-primary">Dipanggil</span></p>
            @else
                <p><span class="badge bg-success">Selesai</span></p>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Dibuat Pada</label>
            <p>{{ $queue->created_at->format('d M Y H:i') }}</p>
        </div>

        <a href="{{ route('queues.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

    </div>
</div>
@endsection
