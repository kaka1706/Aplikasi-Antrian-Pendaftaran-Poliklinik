@extends('layouts.app')

@section('title', 'Dashboard')

@push('css')
<style>
    .stat-card {
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .stat-icon {
        font-size: 2rem;
        opacity: 0.7;
    }
</style>
@endpush

@section('content')

@php
    // Default jika nilai tidak dikirim dari controller
    $total_clinic = $total_clinic ?? 0;
    $total_poli = $total_poli ?? 0;
    $total_queue = $total_queue ?? 0;
@endphp

@if(Auth::user()->role === 'admin_prodi')

<div class="row">

    {{-- TOTAL KLINIK --}}
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2 stat-card">
            <div class="card-body p-4">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Klinik
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ number_format($total_clinic) }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-hospital fa-2x text-gray-300 stat-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- TOTAL POLI --}}
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2 stat-card">
            <div class="card-body p-4">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Poli
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ number_format($total_poli) }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clinic-medical fa-2x text-gray-300 stat-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- TOTAL ANTRIAN --}}
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2 stat-card">
            <div class="card-body p-4">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Total Antrian
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ number_format($total_queue) }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300 stat-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endif

@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
@endpush
