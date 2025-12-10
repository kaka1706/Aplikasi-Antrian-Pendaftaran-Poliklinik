<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\QueueController;
use App\Http\Controllers\Api\PoliScheduleController;
use App\Http\Controllers\Api\ClinicApiController;
use App\Http\Controllers\Api\PoliApiController;

Route::prefix('v1')->group(function () {

    // === AUTH TEST (Dari Kelompok 1) ===
    Route::post('/login', fn() => response()->json([
        'message' => 'Use Auth Service Login Endpoint'
    ]));

    // === CLINICS ===
    Route::get('/clinics', [ClinicApiController::class, 'index']);
    Route::get('/clinics/{id}', [ClinicApiController::class, 'show']);

    // === POLI ===
    Route::get('/clinics/{clinic_id}/polis', [PoliApiController::class, 'byClinic']);
    Route::get('/polis/{id}', [PoliApiController::class, 'show']);

    // === POLI SCHEDULE ===
    Route::get('/polis/{poli_id}/schedules', [PoliScheduleController::class, 'index']);
    Route::post('/polis/{poli_id}/schedules', [PoliScheduleController::class, 'store']);
    Route::get('/schedules/{id}', [PoliScheduleController::class, 'show']);

    // === QUEUE ===
    Route::get('/queue/active/{student_id}', [QueueController::class, 'active']);
    Route::post('/queue', [QueueController::class, 'store']);
    Route::get('/queue/history/{student_id}', [QueueController::class, 'history']);
});
