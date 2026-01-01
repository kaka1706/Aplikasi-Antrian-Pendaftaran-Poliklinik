<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\ClinicController;
use App\Http\Controllers\Web\PoliController;
use App\Http\Controllers\Web\QueueController;
use App\Http\Controllers\Web\PoliScheduleController;

// ========== PUBLIC ROUTES ==========
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return redirect()->route('login');
});

// ========== PROTECTED ROUTES (Butuh Login) ==========
Route::middleware(['auth'])->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // KLINIK (Admin Prodi only)
    Route::resource('clinics', ClinicController::class);

    // POLI (Admin Poli only)
    Route::resource('polis', PoliController::class);

    // JADWAL POLI - ROUTE YANG DIPERBAIKI
    Route::get('/poli-schedules', [PoliScheduleController::class, 'index'])
        ->name('poli_schedules.index');

    Route::resource('poli-schedules', PoliScheduleController::class)
        ->except(['index']);

    // ROUTE TAMBAHAN UNTUK POLI SCHEDULES
    Route::patch(
        '/poli-schedules/{id}/toggle-status',
        [PoliScheduleController::class, 'toggleStatus']
    )
        ->name('poli_schedules.toggle-status');

    Route::get(
        '/poli-schedules/{id}/activate',
        [PoliScheduleController::class, 'activate']
    )
        ->name('poli_schedules.activate');

    Route::get(
        '/poli-schedules/{id}/deactivate',
        [PoliScheduleController::class, 'deactivate']
    )
        ->name('poli_schedules.deactivate');

    Route::get(
        '/schedules/today',
        [PoliScheduleController::class, 'todaySchedules']
    )
        ->name('poli_schedules.today');

    Route::get(
        '/poli-schedules/by-clinic/{clinic_id}',
        [PoliScheduleController::class, 'byClinic']
    )
        ->name('poli_schedules.by-clinic');

    Route::get(
        '/api/poli-schedules/{poli_id}',
        [PoliScheduleController::class, 'getByPoli']
    )
        ->name('poli_schedules.by-poli');

    // ANTRIAN
    Route::resource('queues', QueueController::class);

    Route::prefix('api')->name('api.')->group(function () {
        Route::post(
            '/queues/{schedule}/call-next',
            [QueueController::class, 'callNext']
        )->name('queues.call-next');
    });


    // API UNTUK MOBILE APP
    Route::prefix('api')->group(function () {
        Route::get('/schedules/today', [PoliScheduleController::class, 'apiTodaySchedules']);
        Route::get('/schedules/all', [PoliScheduleController::class, 'apiAllSchedules']);
    });

    // LAPORAN
    Route::prefix('reports')->group(function () {
        Route::get('/daily', [DashboardController::class, 'dailyReport'])
            ->name('reports.daily');
        Route::get('/monthly', [DashboardController::class, 'monthlyReport'])
            ->name('reports.monthly');
    });
});

// ========== API DOCS ==========
Route::get('/api/docs', function () {
    return view('l5-swagger::index');
})->name('api.docs');
