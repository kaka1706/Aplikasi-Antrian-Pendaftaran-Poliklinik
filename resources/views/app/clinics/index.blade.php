@extends('layouts.app')

@section('title', 'Klinik')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Klinik</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Daftar Klinik</h5>
        <a href="{{ route('clinics.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus"></i> Tambah Klinik
        </a>
    </div>

    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-primary">
                    <tr>
                        <th width="50">#</th>
                        <th>Nama Klinik</th>
                        <th>Alamat</th>
                        <th>Deskripsi</th>
                        <th width="200">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($clinics as $clinic)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $clinic->name }}</td>
                        <td>{{ $clinic->address }}</td>
                        <td>{{ $clinic->description ?? '-' }}</td>
                        <td>
                            <a href="{{ route('clinics.edit', $clinic) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('clinics.destroy', $clinic) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus klinik ini?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data klinik</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
