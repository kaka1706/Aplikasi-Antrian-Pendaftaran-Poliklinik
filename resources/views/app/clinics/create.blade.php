@extends('layouts.app')

@section('title', 'Tambah Klinik')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('clinics.index') }}">Klinik</a></li>
<li class="breadcrumb-item active">Tambah Klinik</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0" style="color:#133E87;">Tambah Klinik Baru</h5>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('clinics.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama Klinik</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Alamat Klinik</label>
                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
                @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi Klinik (Opsional)</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('clinics.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
