@extends('layouts.app')

@section('title', 'Jadwal Poli Hari Ini')

@section('content')
<div class="row">

    {{-- PAGE HEADER --}}
    <div class="col-12 mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h4>
                <i class="bi bi-calendar-day me-2"></i>
                Jadwal Poli Hari Ini
                <span class="badge bg-info ms-2">{{ now()->translatedFormat('l, d F Y') }}</span>
            </h4>

            <a href="{{ route('poli_schedules.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Semua Jadwal
            </a>
        </div>
    </div>

    {{-- STATISTICS --}}
    <div class="col-md-3 mb-3">
        <div class="card bg-primary text-white">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5>{{ $schedules->count() }}</h5>
                    <small>Total Jadwal</small>
                </div>
                <i class="bi bi-calendar-week fs-2"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card bg-success text-white">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5>{{ $availableSchedules ?? 0 }}</h5>
                    <small>Jadwal Tersedia</small>
                </div>
                <i class="bi bi-check-circle fs-2"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card bg-info text-white">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5>{{ $totalQueues ?? 0 }}</h5>
                    <small>Total Antrian</small>
                </div>
                <i class="bi bi-people fs-2"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card bg-warning">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5>{{ now()->format('H:i') }}</h5>
                    <small>Waktu Sekarang</small>
                </div>
                <i class="bi bi-clock fs-2"></i>
            </div>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="mb-0">Daftar Jadwal Hari Ini</h5>
                <span class="badge bg-primary">
                    {{ now()->translatedFormat('l, d F Y') }}
                </span>
            </div>

            <div class="card-body">
                @if($schedules->count())
                    <div class="row">
                        @foreach($schedules as $schedule)
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 border {{ ($schedule->available_slots ?? 0) > 0 ? 'border-success' : 'border-danger' }}">
                                <div class="card-body">
                                    <h5>
                                        <i class="bi bi-building me-1"></i>
                                        {{ $schedule->poli->name ?? '-' }}
                                    </h5>

                                    <p class="mb-1">
                                        <i class="bi bi-clock me-1"></i>
                                        {{ $schedule->start_time ?? '-' }} - {{ $schedule->end_time ?? '-' }}
                                    </p>

                                    <p class="mb-2">
                                        <i class="bi bi-people me-1"></i>
                                        {{ $schedule->queues->count() ?? 0 }} / {{ $schedule->max_patients ?? 0 }}
                                    </p>

                                    <a href="{{ route('poli-schedules.show', $schedule->id) }}"
                                       class="btn btn-outline-info btn-sm w-100">
                                        <i class="bi bi-eye me-1"></i> Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-calendar-x fs-1"></i>
                        <p class="mt-3">Tidak ada jadwal hari ini</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>
@endsection