<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    // Menampilkan halaman index Blade
    public function index()
    {
        $clinics = Clinic::all();
        return view('app.clinics.index', compact('clinics'));
    }

    // Jika ingin API
    public function indexApi()
    {
        $clinics = Clinic::all();
        return response()->json([
            'status' => true,
            'data' => $clinics
        ]);
    }

    // Menampilkan form create
    public function create()
    {
        return view('app.clinics.create');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $clinic = Clinic::findOrFail($id);
        return view('app.clinics.edit', compact('clinic'));
    }

    // Simpan data baru (API dan form bisa sama)
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'address'     => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $clinic = Clinic::create($request->all());

        return redirect()->route('clinics.index')
                         ->with('success', 'Clinic berhasil dibuat');
    }

    // Update data
    public function update(Request $request, $id)
    {
        $clinic = Clinic::findOrFail($id);

        $request->validate([
            'name'        => 'string|max:255',
            'address'     => 'string|max:255',
            'description' => 'nullable|string',
        ]);

        $clinic->update($request->all());

        return redirect()->route('clinics.index')
                         ->with('success', 'Clinic berhasil diperbarui');
    }

    // Hapus data
    public function destroy($id)
    {
        $clinic = Clinic::findOrFail($id);
        $clinic->delete();

        return redirect()->route('clinics.index')
                         ->with('success', 'Clinic berhasil dihapus');
    }
}
