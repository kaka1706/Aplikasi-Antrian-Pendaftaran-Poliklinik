<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Poli;
use Illuminate\Http\Request;

class PoliApiController extends Controller
{

    public function byClinic($clinic_id)
    {
        $polis = Poli::where('clinic_id', $clinic_id)
                    ->with('clinic')
                    ->get();

        return response()->json([
            'status' => true,
            'data' => $polis
        ]);
    }


    public function show($id)
    {
        $poli = Poli::with('clinic', 'schedules')->find($id);

        if (!$poli) {
            return response()->json([
                'status' => false,
                'message' => 'Poli not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $poli
        ]);
    }
}
