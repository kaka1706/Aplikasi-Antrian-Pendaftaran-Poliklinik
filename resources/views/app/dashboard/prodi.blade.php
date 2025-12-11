@extends('layouts.app')

@section('content')
<h2>Dashboard Admin Prodi</h2>

<ul>
    <li>Total Klinik: {{ $total_clinic }}</li>
    <li>Total Poli: {{ $total_poli }}</li>
    <li>Total Antrian: {{ $total_queue }}</li>
</ul>
@endsection
