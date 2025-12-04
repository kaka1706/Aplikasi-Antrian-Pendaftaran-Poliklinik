<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\PoliScheduleController;


// Halaman Login
Route::get('/login', [AuthController::class, 'loginPage'])
    ->name('login');

// Proses Login
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // CRUD Klinik
    Route::resource('clinics', ClinicController::class);

    // CRUD Poli
    Route::resource('polis', PoliController::class);

    // CRUD Antrian
    Route::resource('queues', QueueController::class);

    // CRUD Jadwal Poli
    Route::resource('schedules', PoliScheduleController::class);

    // Riwayat Antrian
    Route::get('history', [QueueController::class, 'history'])
        ->name('history.index');
});

Route::get('/', function () {
    return redirect()->route('login');
});
