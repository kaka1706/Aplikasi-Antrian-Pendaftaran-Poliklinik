@extends('layouts.app')

@section('title', 'Detail Jadwal Poli')

@section('content')
@php
    $quota = $schedule->quota ?? 0;
    $todayQueues = $todayQueues ?? 0;
    $remainingQuota = max(0, $quota - $todayQueues);

    $percentage = $quota > 0 ? min(100, ($todayQueues / $quota) * 100) : 0;
    $progressClass = $percentage >= 80 ? 'bg-danger' : ($percentage >= 50 ? 'bg-warning' : 'bg-success');
@endphp

<div class="container-fluid">
<div class="row">
<div class="col-12">
    <div class="page-title-box d-sm-flex justify-content-between">
        <h4>Detail Jadwal Poli</h4>
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('poli_schedules.index') }}">Jadwal Poli</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </div>
</div>
</div>

<div class="row">
<div class="col-lg-8">

{{-- INFORMASI --}}
<div class="card mb-4">
<div class="card-header d-flex justify-content-between">
    <h5><i class="bi bi-calendar-week me-2"></i> Informasi Jadwal</h5>
    {!! $schedule->status_badge ?? '<span class="badge bg-secondary">Tidak ada status</span>' !!}
</div>

<div class="card-body">
<div class="row">

<div class="col-md-6 mb-4">
    <h6 class="text-muted mb-3">Informasi Dasar</h6>

    <p>
        <strong>Poli</strong><br>
        {{ $schedule->poli->name ?? '-' }} <br>
        @if(auth()->user()->role === 'admin_prodi')
            <small class="text-info">{{ $schedule->poli->clinic->name ?? '-' }}</small>
        @endif
    </p>

    <p>
        <strong>Hari</strong><br>
        {{ $schedule->day_of_week ?? '-' }}
        @if($schedule->is_today)
            <span class="badge bg-info ms-2">Hari Ini</span>
        @endif
    </p>

    <p>
        <strong>Jam</strong><br>
        {{ $schedule->start_time ?? '-' }} - {{ $schedule->end_time ?? '-' }}
    </p>
</div>

<div class="col-12">
    <div class="alert {{ $schedule->is_active ? 'alert-success' : 'alert-danger' }}">
        {{ $schedule->is_active
            ? 'Jadwal aktif dan dapat menerima antrian.'
            : 'Jadwal tidak aktif.' }}
    </div>
</div>

</div>

<div class="d-flex gap-2 mt-3">
    <a href="{{ route('poli-schedules.edit', $schedule->id) }}" class="btn btn-warning">
        <i class="bi bi-pencil"></i> Edit
    </a>

    <form method="POST" action="{{ route('poli_schedules.toggle-status', $schedule->id) }}">
        @csrf
        @method('PATCH')
        <button class="btn {{ $schedule->is_active ? 'btn-danger' : 'btn-success' }}">
            {{ $schedule->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
        </button>
    </form>

    <a href="{{ route('poli_schedules.index') }}" class="btn btn-secondary">Kembali</a>
</div>

</div>
</div>

{{-- ANTRIAN --}}
<div class="card">
<div class="card-header">
    <h5>
        <i class="bi bi-list-ul me-2"></i>
        Antrian Hari Ini
        <span class="badge bg-info ms-2">{{ $schedule->queues->count() }}</span>
    </h5>
</div>

<div class="card-body">
@if($schedule->queues->count())
<table class="table table-sm">
<thead>
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>NIM</th>
    <th>Status</th>
    <th>Waktu</th>
</tr>
</thead>
<tbody>
@foreach($schedule->queues as $queue)
<tr>
    <td>#{{ $queue->queue_number }}</td>
    <td>{{ $queue->patient_name }}</td>
    <td>{{ $queue->patient_nim }}</td>
    <td><span class="badge bg-secondary">{{ $queue->status }}</span></td>
    <td>{{ optional($queue->created_at)->format('H:i') }}</td>
</tr>
@endforeach
</tbody>
</table>
@else
<p class="text-muted text-center">Belum ada antrian hari ini.</p>
@endif
</div>
</div>

</div>

{{-- SIDEBAR --}}
<div class="col-lg-4">
<div class="card">
<div class="card-header">Aksi Cepat</div>
<div class="card-body d-grid gap-2">

@if($schedule->is_active && $remainingQuota > 0)
<a href="{{ route('queues.create', ['schedule_id'=>$schedule->id]) }}"
   class="btn btn-primary">
   Buat Antrian
</a>
@endif

@if($schedule->is_today && $schedule->queues->count())
<button class="btn btn-success" id="callNextBtn">
    Panggil Antrian Berikutnya
</button>
@endif

</div>
</div>
</div>

</div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('callNextBtn');
    if (!btn) return;

    btn.addEventListener('click', () => {
        if (!confirm('Panggil antrian berikutnya?')) return;

       fetch("{{ route('api.queues.call-next', $schedule->id) }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            alert(data.message);
            if (data.success) location.reload();
        })
        .catch(() => alert('Terjadi kesalahan'));
    });
});
</script>
@endsection