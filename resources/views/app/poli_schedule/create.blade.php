@extends('layouts.app')

@section('title', 'Tambah Jadwal')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Tambah Jadwal {{ $poli->name }}</h5>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('polis.schedules.store', $poli) }}">
            @csrf

            <div class="mb-3">
                <label>Hari</label>
                <select name="day_of_week" class="form-control" required>
                    <option>Senin</option>
                    <option>Selasa</option>
                    <option>Rabu</option>
                    <option>Kamis</option>
                    <option>Jumat</option>
                    <option>Sabtu</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Jam Mulai</label>
                <input type="time" name="start_time" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Jam Selesai</label>
                <input type="time" name="end_time" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Kuota</label>
                <input type="number" name="quota" class="form-control" min="1" required>
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('polis.schedules.index', $poli) }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
