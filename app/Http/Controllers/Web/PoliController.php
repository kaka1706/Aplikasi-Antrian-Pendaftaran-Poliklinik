<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Poli;
use App\Models\Clinic;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    public function index()  
    {
        $polis = Poli::with('clinic')->get();
        return view('app.polis.index', compact('polis'));
    }

    public function create()
    {
        $clinics = Clinic::all();
        return view('app.polis.create', compact('clinics'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'clinic_id'   => 'required|exists:clinics,id',
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        Poli::create($request->all());

        return redirect()->route('polis.index')
            ->with('success', 'Poli berhasil ditambahkan');
    }

    public function show($id)
    {
        $poli = Poli::with(['clinic', 'schedules'])->findOrFail($id);
        return view('app.polis.show', compact('poli'));
    }

    public function edit($id)
    {
        $poli = Poli::findOrFail($id);
        $clinics = Clinic::all();

        return view('app.polis.edit', compact('poli', 'clinics'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'clinic_id'   => 'required|exists:clinics,id',
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        $poli = Poli::findOrFail($id);
        $poli->update($request->all());

        return redirect()->route('polis.index')
            ->with('success', 'Poli berhasil diperbarui');
    }

    public function destroy($id)
    {
        Poli::destroy($id);

        return redirect()->route('polis.index')
            ->with('success', 'Poli berhasil dihapus');
    }
}
