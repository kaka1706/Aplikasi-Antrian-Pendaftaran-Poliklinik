@extends('layouts.app')

@section('content')
<h2>Dashboard Admin Poli</h2>

<p><strong>Klinik:</strong> {{ $clinic->name }}</p>

<ul>
    <li>Total Poli di Klinik Ini: {{ $total_poli }}</li>
    <li>Total Antrian di Klinik Ini: {{ $total_queue }}</li>
</ul>
@endsection
