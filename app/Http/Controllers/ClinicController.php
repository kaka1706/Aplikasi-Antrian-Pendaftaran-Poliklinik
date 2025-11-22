<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    public function index()
    {
        $clinics = Clinic::all();

        return response()->json([
            'status' => true,
            'data' => $clinics
        ]);
    }

    public function indexWithDetails()
    {
        $clinics = Clinic::with('polies.schedules')->get();

        return response()->json([
            'status' => true,
            'data' => $clinics
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'address'     => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $clinic = Clinic::create($request->all());

        return response()->json([
            'status'  => true,
            'message' => 'Clinic berhasil dibuat',
            'data'    => $clinic
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $clinic = Clinic::findOrFail($id);

        $request->validate([
            'name'        => 'string|max:255',
            'address'     => 'string|max:255',
            'description' => 'nullable|string',
        ]);

        $clinic->update($request->all());

        return response()->json([
            'status'  => true,
            'message' => 'Clinic berhasil diperbarui',
            'data'    => $clinic
        ]);
    }

    public function destroy($id)
    {
        $clinic = Clinic::findOrFail($id);
        $clinic->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Clinic berhasil dihapus'
        ]);
    }
}