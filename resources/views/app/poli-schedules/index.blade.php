@extends('layouts.app')

@section('title', 'Daftar Jadwal Poli')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Jadwal Poli</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Daftar Jadwal Poli</h5>

        @if(auth()->user()->role === 'admin_poli' || auth()->user()->role === 'admin_prodi')
            <a href="{{ route('poli-schedules.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus"></i> Tambah Jadwal
            </a>
        @endif
    </div>

    <div class="card-body p-4">
        <!-- FILTERS -->
        @if(auth()->user()->role === 'admin_prodi')
        <div class="row mb-3">
            <div class="col-md-4">
                <form method="GET" action="{{ route('poli_schedules.index') }}">
                    <select name="clinic_id" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">Semua Klinik</option>
                        @foreach($clinics as $clinic)
                            <option value="{{ $clinic->id }}" {{ request('clinic_id') == $clinic->id ? 'selected' : '' }}>
                                {{ $clinic->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
        @endif

        <!-- ALERTS -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-triangle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- TABLE -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-primary">
                    <tr>
                        <th width="50">#</th>
                        <th>Hari</th>
                        
                        @if(auth()->user()->role === 'admin_prodi')
                            <th>Klinik</th>
                        @endif
                        
                        <th>Poli</th>
                        <th>Jam</th>
                        <th>Kuota</th>
                        <th>Status</th>
                        <th width="250">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($schedules as $schedule)
                    <tr>
                        <td>{{ ($schedules->currentPage() - 1) * $schedules->perPage() + $loop->iteration }}</td>
                        <td>
                            <strong>{{ $schedule->day_of_week }}</strong>
                            @php
                                // Cek apakah hari ini
                                $dayMapping = [
                                    'Monday' => 'Senin',
                                    'Tuesday' => 'Selasa',
                                    'Wednesday' => 'Rabu', 
                                    'Thursday' => 'Kamis',
                                    'Friday' => 'Jumat',
                                    'Saturday' => 'Sabtu',
                                    'Sunday' => 'Minggu'
                                ];
                                $todayIndonesian = $dayMapping[now()->format('l')] ?? now()->format('l');
                            @endphp
                            @if($schedule->day_of_week == $todayIndonesian)
                                <br><small class="badge bg-info">Hari Ini</small>
                            @endif
                        </td>
                        
                        @if(auth()->user()->role === 'admin_prodi')
                            <td>{{ $schedule->poli->clinic->name ?? '-' }}</td>
                        @endif
                        
                        <td>{{ $schedule->poli->name ?? 'N/A' }}</td>
                        <td>{{ $schedule->start_time }} - {{ $schedule->end_time }}</td>
                        <td>{{ $schedule->quota }} pasien</td>
                        <td>
                            @if($schedule->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('poli-schedules.show', $schedule->id) }}" 
                                   class="btn btn-info" title="Lihat Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                
                                @if(auth()->user()->role === 'admin_poli' || auth()->user()->role === 'admin_prodi')
                                <a href="{{ route('poli-schedules.edit', $schedule->id) }}" 
                                   class="btn btn-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                
                                <!-- PERBAIKAN DI SINI: Pisahkan logic -->
                                @php
                                    $confirmMessage = $schedule->is_active ? 'Nonaktifkan jadwal ini?' : 'Aktifkan jadwal ini?';
                                    $buttonClass = $schedule->is_active ? 'btn-danger' : 'btn-success';
                                    $buttonTitle = $schedule->is_active ? 'Nonaktifkan' : 'Aktifkan';
                                @endphp
                                
                                <form action="{{ route('poli_schedules.toggle-status', $schedule->id) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            class="btn {{ $buttonClass }}"
                                            title="{{ $buttonTitle }}"
                                            onclick="return confirm('{{ $confirmMessage }}')">
                                        <i class="bi bi-power"></i>
                                    </button>
                                </form>
                                
                                @if($schedule->queues_count == 0)
                                <form action="{{ route('poli-schedules.destroy', $schedule->id) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-danger" 
                                            title="Hapus"
                                            onclick="return confirm('Hapus jadwal ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @endif
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ auth()->user()->role === 'admin_prodi' ? 8 : 7 }}" class="text-center">
                            <div class="py-4">
                                <i class="bi bi-calendar-x" style="font-size: 3rem; color: #dee2e6;"></i>
                                <h5 class="mt-3 text-muted">Belum ada jadwal poli</h5>
                                @if(auth()->user()->role === 'admin_poli' || auth()->user()->role === 'admin_prodi')
                                <a href="{{ route('poli-schedules.create') }}" class="btn btn-primary mt-2">
                                    <i class="bi bi-plus-circle"></i> Tambah Jadwal Pertama
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- PAGINATION -->
        @if($schedules->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="text-muted">
                Menampilkan {{ $schedules->firstItem() }} - {{ $schedules->lastItem() }} dari {{ $schedules->total() }}
            </div>
            <div>
                {{ $schedules->links() }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection