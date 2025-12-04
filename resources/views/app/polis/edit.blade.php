@extends('layouts.app')

@section('title', 'Edit Poli')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('polis.index') }}">Poli</a></li>
<li class="breadcrumb-item active">Edit Poli</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0" style="color:#133E87;">Edit Poli</h5>
    </div>

    <div class="card-body p-4">
        <form action="{{ route('poli.update', $poli->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Pilih Klinik --}}
            <div class="mb-3">
                <label for="clinic_id" class="form-label">Pilih Klinik</label>
                <select name="clinic_id" id="clinic_id" 
                        class="form-control @error('clinic_id') is-invalid @enderror" 
                        required>
                    <option value="">-- Pilih Klinik --</option>
                    @foreach ($clinics as $clinic)
                        <option value="{{ $clinic->id }}"
                            {{ old('clinic_id', $poli->clinic_id) == $clinic->id ? 'selected' : '' }}>
                            {{ $clinic->name }}
                        </option>
                    @endforeach
                </select>

                @error('clinic_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Nama Poli --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nama Poli</label>
                <input type="text" 
                       class="form-control @error('name') is-invalid @enderror" 
                       id="name" 
                       name="name" 
                       value="{{ old('name', $poli->name) }}" 
                       required>

                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div class="mb-3">
                <label for="description" class="form-label">Keterangan (Opsional)</label>
                <textarea 
                    class="form-control @error('description') is-invalid @enderror" 
                    id="description" 
                    name="description" 
                    rows="3">{{ old('description', $poli->description) }}</textarea>

                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('polis .index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
