<?php

namespace App\Http\Controllers;
use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    // GET /api/poli
    public function index()
    {
       $poli = Poli::with('clinic')->get();

       return response()->json([
        'status' => true,
        'data' => $poli,
       ]);
    }

    // POST /api/poli
    public function store(Request $request)
    {
        $request->validate([
            'clinic_id' => 'required|exists:clinics,id',
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        $poli = Poli::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Poli berhasil ditambahkan',
            'data' => $poli
        ], 201);
    }

    // GET /api/poli/{id}
    public function show($id)
    {
        $poli = Poli::with(['clinic', 'schedules'])->findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $poli
        ]);
    }

    // PUT /api/poli/{id}
    public function update(Request $request, $id)
    {
        $poli = Poli::findOrFail($id);

        $request ->validate([
            'clinic_id' => 'exists:clinics,id',
            'name' => 'string|max:100',
            'description' => 'nullable|string',
        ]);

        $poli->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Poli berhasil diperbarui',
            'data' => $poli
        ]);
    }

    // DELETE /api/poli/{id}
    public function destroy($id)
    {
        Poli::destroy($id);

        return response()->json([
            'status' => true,
            'message' => 'Poli berhasil dihapus',
        ]);
    }
}
