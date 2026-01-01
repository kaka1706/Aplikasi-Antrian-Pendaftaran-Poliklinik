@extends('layouts.app')

@section('title', 'Tambah Jadwal Poli Baru')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Tambah Jadwal Poli Baru</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('poli_schedules.index') }}">Jadwal Poli</a></li>
                        <li class="breadcrumb-item active">Tambah Baru</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Form Jadwal Poli</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('poli-schedules.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <!-- Poli Selection -->
                            <div class="col-md-6 mb-3">
                                <label for="poli_id" class="form-label">
                                    Poli <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('poli_id') is-invalid @enderror" 
                                        id="poli_id" name="poli_id" required>
                                    <option value="">Pilih Poli</option>
                                    @foreach($polis as $poli)
                                        <option value="{{ $poli->id }}" 
                                                {{ old('poli_id') == $poli->id ? 'selected' : '' }}>
                                            {{ $poli->name }}
                                            @if(auth()->user()->role === 'admin_prodi')
                                                - {{ $poli->clinic->name }}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                @error('poli_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Day Selection -->
                            <div class="col-md-6 mb-3">
                                <label for="day_of_week" class="form-label">
                                    Hari <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('day_of_week') is-invalid @enderror" 
                                        id="day_of_week" name="day_of_week" required>
                                    <option value="">Pilih Hari</option>
                                    @foreach($days as $day)
                                        <option value="{{ $day }}" 
                                                {{ old('day_of_week') == $day ? 'selected' : '' }}>
                                            {{ $day }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('day_of_week')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Start Time -->
                            <div class="col-md-6 mb-3">
                                <label for="start_time" class="form-label">
                                    Jam Mulai <span class="text-danger">*</span>
                                </label>
                                <input type="time" 
                                       class="form-control @error('start_time') is-invalid @enderror" 
                                       id="start_time" name="start_time" 
                                       value="{{ old('start_time', '08:00') }}" 
                                       required>
                                @error('start_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- End Time -->
                            <div class="col-md-6 mb-3">
                                <label for="end_time" class="form-label">
                                    Jam Selesai <span class="text-danger">*</span>
                                </label>
                                <input type="time" 
                                       class="form-control @error('end_time') is-invalid @enderror" 
                                       id="end_time" name="end_time" 
                                       value="{{ old('end_time', '16:00') }}" 
                                       required>
                                @error('end_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Quota -->
                            <div class="col-md-6 mb-3">
                                <label for="quota" class="form-label">
                                    Kuota Harian <span class="text-danger">*</span>
                                    <small class="text-muted">(Jumlah pasien maksimal)</small>
                                </label>
                                <div class="input-group">
                                    <input type="number" 
                                           class="form-control @error('quota') is-invalid @enderror" 
                                           id="quota" name="quota" 
                                           value="{{ old('quota', 30) }}" 
                                           min="1" max="200"
                                           required>
                                    <span class="input-group-text">pasien</span>
                                </div>
                                @error('quota')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Status -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status</label>
                                <div class="mt-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" 
                                               type="radio" 
                                               id="is_active_1" 
                                               name="is_active" 
                                               value="1" 
                                               {{ old('is_active', true) ? 'checked' : '' }}>
                                        <label class="form-check-label text-success" for="is_active_1">
                                            <i class="bi bi-check-circle me-1"></i> Aktif
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" 
                                               type="radio" 
                                               id="is_active_0" 
                                               name="is_active" 
                                               value="0" 
                                               {{ old('is_active') === '0' ? 'checked' : '' }}>
                                        <label class="form-check-label text-danger" for="is_active_0">
                                            <i class="bi bi-x-circle me-1"></i> Nonaktif
                                        </label>
                                    </div>
                                </div>
                                @error('is_active')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Simpan Jadwal
                            </button>
                            <a href="{{ route('poli_schedules.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Sidebar Information -->
        <div class="col-lg-4">
            <!-- Information Card -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-info-circle me-2"></i> Informasi
                    </h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h6><i class="bi bi-lightbulb me-2"></i> Petunjuk Pengisian</h6>
                        <ul class="mb-0 ps-3">
                            <li>Pilih poli yang sudah terdaftar</li>
                            <li>Setiap poli hanya boleh memiliki 1 jadwal per hari</li>
                            <li>Jam selesai harus setelah jam mulai</li>
                            <li>Kuota menentukan jumlah pasien maksimal per hari</li>
                            <li>Jadwal nonaktif tidak muncul di antrian</li>
                        </ul>
                    </div>
                    
                    <div class="alert alert-warning">
                        <h6><i class="bi bi-exclamation-triangle me-2"></i> Perhatian</h6>
                        <p class="mb-0">
                            Pastikan tidak ada jadwal duplikat untuk poli yang sama di hari yang sama.
                            Sistem akan menolak jika ada duplikasi.
                        </p>
                    </div>
                    
                    @if(auth()->user()->role === 'admin_poli')
                        @php
                            $userClinic = auth()->user()->clinic;
                        @endphp
                        @if($userClinic)
                        <div class="alert alert-primary">
                            <h6><i class="bi bi-hospital me-2"></i> Klinik Anda</h6>
                            <p class="mb-0">
                                <strong>{{ $userClinic->name }}</strong><br>
                                <small>{{ $userClinic->address }}</small>
                            </p>
                        </div>
                        @endif
                    @endif
                </div>
            </div>
            
            <!-- Today's Schedule Preview -->
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-calendar-check me-2"></i> Jadwal Hari Ini
                    </h5>
                </div>
                <div class="card-body">
                    @php
                        $todayEnglish = now()->format('l');
                        $dayMapping = [
                            'Monday' => 'Senin',
                            'Tuesday' => 'Selasa',
                            'Wednesday' => 'Rabu', 
                            'Thursday' => 'Kamis',
                            'Friday' => 'Jumat',
                            'Saturday' => 'Sabtu',
                            'Sunday' => 'Minggu'
                        ];
                        $todayIndonesian = $dayMapping[$todayEnglish] ?? $todayEnglish;
                        
                        $query = \App\Models\PoliSchedule::with('poli')
                            ->where('day_of_week', $todayIndonesian)
                            ->where('is_active', true);
                            
                        if(auth()->user()->role === 'admin_poli') {
                            $query->whereHas('poli', function($q) {
                                $q->where('clinic_id', auth()->user()->clinic_id);
                            });
                        }
                        
                        $todaySchedules = $query->count();
                    @endphp
                    
                    <div class="text-center py-3">
                        <h3>{{ $todaySchedules }}</h3>
                        <p class="text-muted mb-0">Jadwal aktif hari ini ({{ $todayIndonesian }})</p>
                        <a href="{{ route('poli_schedules.today') }}" class="btn btn-sm btn-outline-info mt-2">
                            <i class="bi bi-eye me-1"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Validasi waktu
        const startTime = document.getElementById('start_time');
        const endTime = document.getElementById('end_time');
        
        function validateTimes() {
            if (startTime.value && endTime.value) {
                if (startTime.value >= endTime.value) {
                    endTime.setCustomValidity('Jam selesai harus setelah jam mulai');
                    endTime.classList.add('is-invalid');
                } else {
                    endTime.setCustomValidity('');
                    endTime.classList.remove('is-invalid');
                }
            }
        }
        
        startTime.addEventListener('change', validateTimes);
        endTime.addEventListener('change', validateTimes);
        
        // Preview hari ini
        const daySelect = document.getElementById('day_of_week');
        const todayPreview = document.querySelector('.today-preview');
        
        if (daySelect && todayPreview) {
            const todayIndonesian = "{{ $todayIndonesian }}";
            
            daySelect.addEventListener('change', function() {
                if (this.value === todayIndonesian) {
                    todayPreview.style.display = 'block';
                } else {
                    todayPreview.style.display = 'none';
                }
            });
        }
    });
</script>
@endsection