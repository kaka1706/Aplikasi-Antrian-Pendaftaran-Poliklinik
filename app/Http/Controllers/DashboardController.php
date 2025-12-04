<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Poli;
use App\Models\Queue;

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
}
