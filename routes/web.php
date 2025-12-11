<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\ClinicController;
use App\Http\Controllers\Web\PoliController;
use App\Http\Controllers\Web\AntrianController as WebQueueController;


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

    // prodi routes (only prodi)
    Route::middleware(['role:admin_prodi'])->group(function () {
        Route::get('/dashboard/prodi', [DashboardController::class, 'prodi'])->name('dashboard.prodi');
    // CRUD Klinik
    Route::resource('clinics', ClinicController::class);

    });

    Route::middleware(['role:admin_poli'])->group(function () {
        Route::get('/dashboard/poli', [DashboardController::class, 'poli'])->name('dashboard.poli');

        // poli admins manage polis/jadwal/queues for their clinic
        // CRUD Poli
        Route::resource('polis', PoliController::class);
        Route::resource('queues', WebQueueController::class)->only(['index','show','edit','update']);
        // additional queue management endpoints (call, finish)
        Route::post('/queues/{queue}/call', [WebQueueController::class, 'call'])->name('queues.call');
        Route::post('/queues/{queue}/finish', [WebQueueController::class, 'finish'])->name('queues.finish');
    });
});


Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/api/docs', function () {
    return view('l5-swagger::index');
});

