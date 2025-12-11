<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\User;
use Illuminate\Support\Str;
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
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    $clinic = Clinic::create($request->only(['name','address','description']));

    // create default admin poli for this clinic
    $defaultEmail = Str::slug($clinic->name) . '@poli.local';
    $rawPassword = 'iniadminpoli12';
    $hashPassword = bcrypt($rawPassword);

    User::create([
        'name' => 'Admin Poli - ' . $clinic->name,
        'email' => $defaultEmail,
        'password' => $hashPassword,
        'role' => 'admin_poli',
        'clinic_id' => $clinic->id,
    ]);

    // optional: notify the prodi admin with the new admin's credentials
    // or log them somewhere. For now we'll flash password to session (not safe for production)
    // session()->flash('new_poli_admin', ['email'=>$defaultEmail,'password_raw'=>$rawPassword]);

    return redirect()->route('clinics.index')
                     ->with('success', 'Clinic berhasil dibuat. Admin Poli otomatis dibuat dengan email: '.$defaultEmail);
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
