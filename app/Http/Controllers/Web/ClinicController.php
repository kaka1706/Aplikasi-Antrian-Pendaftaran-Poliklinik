<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\Poli;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    // List klinik
    public function index()
    {
        $clinics = Clinic::all();
        return view('app.clinics.index', compact('clinics'));
    }

    // API optional
    public function indexApi()
    {
        $clinics = Clinic::all();
        return response()->json([
            'status' => true,
            'data' => $clinics
        ]);
    }

    // Form create
    public function create()
    {
        return view('app.clinics.create');
    }

    // Form edit
    public function edit($id)
    {
        $clinic = Clinic::findOrFail($id);
        return view('app.clinics.edit', compact('clinic'));
    }

    // Simpan data & buat admin poli + poli default otomatis
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // 1️⃣ Buat klinik
        $clinic = Clinic::create($request->only(['name','address','description']));

        // 2️⃣ Buat Admin Poli otomatis
        $defaultEmail = Str::slug($clinic->name) . '@poli.local';
        $rawPassword = 'iniadminpoli12';
        $hashPassword = bcrypt($rawPassword);

        User::create([
            'name'      => 'Admin Poli - ' . $clinic->name,
            'email'     => $defaultEmail,
            'password'  => $hashPassword,
            'role'      => 'admin_poli',
            'clinic_id' => $clinic->id,
        ]);

        // 3️⃣ Tambahkan Poli Default otomatis
        Poli::create([
            'clinic_id'  => $clinic->id,
            'name'       => 'Poli Umum',
            'description'=> 'Poli utama untuk klinik ini',
        ]);

        return redirect()->route('clinics.index')
            ->with('success', 'Clinic berhasil dibuat. Admin Poli & Poli default berhasil dibuat.');
    }

    // Update
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

    // Hapus
    public function destroy($id)
    {
        $clinic = Clinic::findOrFail($id);
        $clinic->delete();

        return redirect()->route('clinics.index')
            ->with('success', 'Clinic berhasil dihapus');
    }
}
