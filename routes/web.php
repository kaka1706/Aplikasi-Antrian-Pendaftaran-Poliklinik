<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\ClinicController;
use App\Http\Controllers\Web\PoliController;
use App\Http\Controllers\Web\QueueController;


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

    // Queue Management
    Route::resource('queues', QueueController::class);

});

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/api/docs', function () {
    return view('l5-swagger::index');
});

