<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Poli;
use App\Models\Clinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PoliController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'poli' || $user->role === 'admin_poli') {
            $polis = Poli::with('clinic')
                ->where('clinic_id', $user->clinic_id)
                ->get();
        } else {
            $polis = Poli::with('clinic')->get();
        }

        return view('app.polis.index', compact('polis'));
    }

    /**
     * Form tambah poli
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->role === 'poli' || $user->role === 'admin_poli') {
            // Admin poli hanya boleh pilih kliniknya sendiri
            $clinics = Clinic::where('id', $user->clinic_id)->get();
        } else {
            $clinics = Clinic::all();
        }

        return view('app.polis.create', compact('clinics'));
    }

    /**
     * Simpan poli baru
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string',
            'clinic_id'   => 'nullable|exists:clinics,id',
        ]);

        Poli::create([
            'clinic_id'   => ($user->role === 'poli' || $user->role === 'admin_poli')
                                ? $user->clinic_id
                                : $request->clinic_id,
            'name'        => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('polis.index')
            ->with('success', 'Poli berhasil ditambahkan');
    }

    /**
     * Detail poli
     */
    public function show($id)
    {
        $user = Auth::user();

        $poli = Poli::with(['clinic', 'schedules'])
            ->when(
                $user->role === 'poli' || $user->role === 'admin_poli',
                fn ($q) => $q->where('clinic_id', $user->clinic_id)
            )
            ->findOrFail($id);

        return view('app.polis.show', compact('poli'));
    }

    /**
     * Form edit poli
     */
    public function edit($id)
    {
        $user = Auth::user();

        $poli = Poli::when(
                $user->role === 'poli' || $user->role === 'admin_poli',
                fn ($q) => $q->where('clinic_id', $user->clinic_id)
            )
            ->findOrFail($id);

        $clinics = ($user->role === 'poli' || $user->role === 'admin_poli')
            ? Clinic::where('id', $user->clinic_id)->get()
            : Clinic::all();

        return view('app.polis.edit', compact('poli', 'clinics'));
    }

    /**
     * Update poli
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        $request->validate([
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string',
            'clinic_id'   => 'nullable|exists:clinics,id',
        ]);

        $poli = Poli::when(
                $user->role === 'poli' || $user->role === 'admin_poli',
                fn ($q) => $q->where('clinic_id', $user->clinic_id)
            )
            ->findOrFail($id);

        $poli->update([
            'clinic_id'   => ($user->role === 'poli' || $user->role === 'admin_poli')
                                ? $user->clinic_id
                                : $request->clinic_id,
            'name'        => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('polis.index')
            ->with('success', 'Poli berhasil diperbarui');
    }

    /**
     * Hapus poli
     */
    public function destroy($id)
    {
        $user = Auth::user();

        $poli = Poli::when(
                $user->role === 'poli' || $user->role === 'admin_poli',
                fn ($q) => $q->where('clinic_id', $user->clinic_id)
            )
            ->findOrFail($id);

        $poli->delete();

        return redirect()->route('polis.index')
            ->with('success', 'Poli berhasil dihapus');
    }
}
