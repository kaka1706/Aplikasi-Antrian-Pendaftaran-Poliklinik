<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\Poli;
use App\Models\Queue;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('app.dashboard.index', [
            'total_clinic' => Clinic::count(),
            'total_poli'   => Poli::count(),
            'total_queue'  => Queue::count(),
        ]);
    }

    /**
     * Dashboard khusus admin prodi
     */
    public function prodi()
    {
        return view('app.dashboard.prodi', [
            'total_clinic' => Clinic::count(),
            'total_poli'   => Poli::count(),
            'total_queue'  => Queue::count(),
        ]);
    }

    /**
     * Dashboard khusus admin poli
     */
    public function poli()
    {
        $user = Auth::user();

        // Setiap admin poli hanya boleh melihat kliniknya sendiri
        $clinic = Clinic::where('id', $user->clinic_id)->first();
        $poliIds = Poli::where('clinic_id', $clinic->id)->pluck('id');

        $totalQueue = Queue::whereIn('poli_id', $poliIds)->count();


        return view('app.dashboard.poli', [
            'clinic'       => $clinic,
            'total_poli'   => $poliIds->count(),
            'total_queue' => $totalQueue,
        ]);
    }
}
