@extends('layouts.app')

@section('title', 'Antrian')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Antrian</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Daftar Antrian</h5>

        {{-- Jika mau buat antrian manual, aktifkan tombol ini --}}
        {{-- <a href="{{ route('queues.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus"></i> Tambah Antrian
        </a> --}}
    </div>

    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-primary">
                    <tr>
                        <th width="50">#</th>
                        <th>Mahasiswa</th>
                        <th>Jadwal Poli</th>
                        <th>No. Antrian</th>
                        <th>Status</th>
                        <th>Dibuat</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($queues as $queue)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        {{-- Nama mahasiswa (student_id) bisa ganti jika ada relasi --}}
                        <td>Mahasiswa #{{ $queue->student_id }}</td>

                        <td>
                            {{ $queue->schedule->poli_name ?? '-' }} <br>
                            <small class="text-muted">
                                {{ $queue->schedule->day ?? '' }} - 
                                {{ $queue->schedule->time_start ?? '' }} s/d 
                                {{ $queue->schedule->time_end ?? '' }}
                            </small>
                        </td>

                        <td>
                            <span class="badge bg-primary fs-6">
                                {{ $queue->queue_number }}
                            </span>
                        </td>

                        <td>
                            @if ($queue->status == 'menunggu')
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            @elseif ($queue->status == 'dipanggil')
                                <span class="badge bg-primary">Dipanggil</span>
                            @else
                                <span class="badge bg-success">Selesai</span>
                            @endif
                        </td>

                        <td>{{ $queue->created_at->format('d M Y H:i') }}</td>

                        <td>
                            <a href="{{ route('queues.show', $queue) }}" class="btn btn-info btn-sm">
                                <i class="bi bi-eye"></i>
                            </a>

                            <form action="{{ route('queues.destroy', $queue) }}" 
                                  method="POST" 
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm" 
                                        onclick="return confirm('Hapus antrian ini?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data antrian</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection
