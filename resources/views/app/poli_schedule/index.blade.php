@extends('layouts.app')

@section('title', 'Jadwal Poli')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5>Jadwal {{ $poli->name }}</h5>
        <a href="{{ route('polis.schedules.create', $poli) }}" class="btn btn-primary btn-sm">
            + Tambah Jadwal
        </a>
    </div>

    <div class="card-body">
        <table class="table">
            <thead class="table-primary">
                <tr>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Kuota</th>
                    <th width="100">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($schedules as $s)
                <tr>
                    <td>{{ $s->day_of_week }}</td>
                    <td>{{ $s->start_time }} - {{ $s->end_time }}</td>
                    <td>{{ $s->quota }}</td>
                    <td>
                        <form action="{{ route('polis.schedules.destroy', $s) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada jadwal</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
