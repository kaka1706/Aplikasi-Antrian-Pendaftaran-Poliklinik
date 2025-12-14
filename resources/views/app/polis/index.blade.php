@extends('layouts.app')

@section('title', 'Poli')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('clinics.index') }}">Klinik</a></li>
<li class="breadcrumb-item active">Poli</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Daftar Poli</h5>

        @if(auth()->user()->role !== 'poli')
            <a href="{{ route('polis.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus"></i> Tambah Poli
            </a>
        @endif
    </div>

    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-primary">
                    <tr>
                        <th width="50">#</th>

                        @if(auth()->user()->role !== 'poli')
                            <th>Nama Klinik</th>
                        @endif

                        <th>Nama Poli</th>
                        <th>Keterangan</th>
                        <th width="200">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($polis as $poli)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        @if(auth()->user()->role !== 'poli')
                            <td>{{ $poli->clinic->name ?? '-' }}</td>
                        @endif

                        <td>{{ $poli->name }}</td>
                        <td>{{ $poli->description ?? '-' }}</td>
                        <td>
                            <a href="{{ route('polis.edit', $poli->id) }}" 
                               class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i> Edit
                            </a>

                            @if(auth()->user()->role !== 'poli')
                                <form action="{{ route('polis.destroy', $poli->id) }}" 
                                      method="POST" 
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus poli ini?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data poli</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
