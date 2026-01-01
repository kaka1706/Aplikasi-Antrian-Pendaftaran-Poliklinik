@extends('layouts.app')

@section('title', 'Edit Jadwal Poli')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Edit Jadwal Poli</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('poli_schedules.index') }}">Jadwal Poli</a>
                    </li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- FORM -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Edit Jadwal</h5>
                    <span class="badge bg-info">
                        {{ $schedule->poli->name }}
                        @if(auth()->user()->role === 'admin_prodi')
                            - {{ $schedule->poli->clinic->name }}
                        @endif
                    </span>
                </div>

                <div class="card-body">
                    <form action="{{ route('poli-schedules.update', $schedule->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Poli -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Poli *</label>
                                <select name="poli_id"
                                    class="form-select @error('poli_id') is-invalid @enderror"
                                    required>
                                    <option value="">Pilih Poli</option>
                                    @foreach($polis as $poli)
                                        <option value="{{ $poli->id }}"
                                            {{ old('poli_id', $schedule->poli_id) == $poli->id ? 'selected' : '' }}>
                                            {{ $poli->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('poli_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Hari -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Hari *</label>
                                <select name="day_of_week"
                                    class="form-select @error('day_of_week') is-invalid @enderror"
                                    required>
                                    @foreach($days as $day)
                                        <option value="{{ $day }}"
                                            {{ old('day_of_week', $schedule->day_of_week) == $day ? 'selected' : '' }}>
                                            {{ $day }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('day_of_week')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Jam -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jam Mulai *</label>
                                <input type="time"
                                    name="start_time"
                                    value="{{ old('start_time', $schedule->start_time) }}"
                                    class="form-control @error('start_time') is-invalid @enderror"
                                    required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jam Selesai *</label>
                                <input type="time"
                                    name="end_time"
                                    value="{{ old('end_time', $schedule->end_time) }}"
                                    class="form-control @error('end_time') is-invalid @enderror"
                                    required>
                            </div>

                            <!-- Kuota -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kuota *</label>
                                <input type="number"
                                    name="quota"
                                    value="{{ old('quota', $schedule->quota) }}"
                                    min="1"
                                    class="form-control @error('quota') is-invalid @enderror"
                                    required>
                                @error('quota')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status</label><br>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"
                                           type="radio"
                                           name="is_active"
                                           value="1"
                                           {{ old('is_active', $schedule->is_active) == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label text-success">Aktif</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"
                                           type="radio"
                                           name="is_active"
                                           value="0"
                                           {{ old('is_active', $schedule->is_active) == 0 ? 'checked' : '' }}>
                                    <label class="form-check-label text-danger">Nonaktif</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2 mt-4">
                            <button class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Simpan
                            </button>
                            <a href="{{ route('poli_schedules.index') }}"
                               class="btn btn-secondary">
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- SIDEBAR -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <strong>Informasi Jadwal</strong>
                </div>
                <div class="card-body">
                    {!! $schedule->status_badge !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const startTime = document.querySelector('[name="start_time"]');
    const endTime   = document.querySelector('[name="end_time"]');
    const quota     = document.querySelector('[name="quota"]');

    // DATA BACKEND (AMAN)
    //const currentQueues = @json($schedule->today_queues_count ?? 0);

    function validateTime() {
        if (startTime.value && endTime.value && startTime.value >= endTime.value) {
            endTime.setCustomValidity('Jam selesai harus setelah jam mulai');
        } else {
            endTime.setCustomValidity('');
        }
    }

    startTime.addEventListener('change', validateTime);
    endTime.addEventListener('change', validateTime);

    quota.addEventListener('change', function () {
        if (parseInt(this.value) < currentQueues) {
            alert('Kuota tidak boleh lebih kecil dari antrian hari ini!');
            this.value = currentQueues;
        }
    });
});
</script>
@endsection
