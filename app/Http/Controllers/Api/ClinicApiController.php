<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use Illuminate\Http\Request;

class ClinicApiController extends Controller
{

    public function index()
    {
        $clinics = Clinic::all();

        return response()->json([
            'status' => true,
            'data' => $clinics
        ]);
    }


    public function show($id)
    {
        $clinic = Clinic::find($id);

        if (!$clinic) {
            return response()->json([
                'status' => false,
                'message' => 'Clinic not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $clinic
        ]);
    }
}
