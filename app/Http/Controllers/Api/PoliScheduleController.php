<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PoliSchedule;
use App\Models\Poli;
use Illuminate\Http\Request;

class PoliScheduleController extends Controller
{

    public function index($poli_id)
    {
        Poli::findOrFail($poli_id);
        
        $schedules = PoliSchedule::where('poli_id', $poli_id)->get();

        return response()->json([
            'status' => true,
            'data' => $schedules
        ]);
    }

    public function store(Request $request, $poli_id)
    {
        Poli::findOrFail($poli_id);
        
        $request->validate([
            'day_of_week' => 'required|string',
            'start_time'  => 'required',
            'end_time'    => 'required',
            'quota'       => 'required|integer|min:1|max:50',
        ]);

        $schedule = PoliSchedule::create([
            'poli_id'     => $poli_id,
            'day_of_week' => $request->day_of_week,
            'start_time'  => $request->start_time,
            'end_time'    => $request->end_time,
            'quota'       => $request->quota,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Jadwal Poli berhasil ditambahkan',
            'data' => $schedule
        ], 201);
    }


    public function show($id)
    {
        $schedule = PoliSchedule::with('poli')->findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $schedule
        ]);
    }
}
