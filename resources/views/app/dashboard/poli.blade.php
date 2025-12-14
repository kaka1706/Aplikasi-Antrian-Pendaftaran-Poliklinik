@extends('layouts.app')

@section('title', 'Dashboard Admin Poli')

@push('css')
<style>
    .stat-card {
        transition: all 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }
    .stat-icon {
        font-size: 2.2rem;
        opacity: 0.7;
    }
</style>
@endpush

@section('content')

<div class="row mb-4">
    <div class="col-xl-12">
        <div class="card shadow p-4">
            <h5 class="font-weight-bold mb-2">Klinik:</h5>
            <p class="mb-0 h5 text-gray-800">{{ $clinic->name }}</p>
        </div>
    </div>
</div>

<div class="row">

    <!-- Total Poli -->
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-3 stat-card">
            <div class="card-body px-4">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Poli di Klinik Ini</div>
                        <div class="h4 font-weight-bold text-gray-800">{{ number_format($total_poli) }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-hospital text-gray-300 stat-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Antrian -->
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-3 stat-card">
            <div class="card-body px-4">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Antrian di Klinik Ini</div>
                        <div class="h4 font-weight-bold text-gray-800">{{ number_format($total_queue) }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-stream text-gray-300 stat-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
@endpush
