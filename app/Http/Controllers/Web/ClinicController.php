<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClinicController extends Controller
{
    // Menampilkan halaman index Blade
    public function index()
    {
        $clinics = Clinic::orderBy('created_at', 'desc')->get();
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
        // Tambah validasi unique untuk mencegah duplikasi
        $request->validate([
            'name' => 'required|string|max:255|unique:clinics,name',
            'address' => 'required|string|max:500',
            'description' => 'nullable|string',
        ], [
            'name.unique' => 'Nama klinik sudah terdaftar. Mohon gunakan nama lain.'
        ]);

        // Gunakan transaction untuk konsistensi data
        DB::beginTransaction();
        
        try {
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

            DB::commit();

            return redirect()->route('clinics.index')
                ->with('success', 'Klinik berhasil dibuat. Admin Poli otomatis dibuat dengan email: '.$defaultEmail);

        } catch (\Exception $e) {
            DB::rollBack();
            
            // Jika error karena duplicate (jaga-jaga)
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['name' => 'Nama klinik sudah terdaftar.']);
            }
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan sistem. Silakan coba lagi.']);
        }
    }

    // Update data
    public function update(Request $request, $id)
    {
        $clinic = Clinic::findOrFail($id);

        // Tambah validasi unique, tapi ignore record saat ini
        $request->validate([
            'name' => 'required|string|max:255|unique:clinics,name,' . $id,
            'address' => 'required|string|max:500',
            'description' => 'nullable|string',
        ], [
            'name.unique' => 'Nama klinik sudah terdaftar. Mohon gunakan nama lain.'
        ]);

        try {
            $clinic->update($request->all());

            // Update juga nama admin poli jika ada
            $adminPoli = User::where('clinic_id', $clinic->id)
                ->where('role', 'admin_poli')
                ->first();
            
            if ($adminPoli) {
                $adminPoli->update([
                    'name' => 'Admin Poli - ' . $clinic->name
                ]);
            }

            return redirect()->route('clinics.index')
                ->with('success', 'Klinik berhasil diperbarui');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }

    // Hapus data
    public function destroy($id)
    {
        $clinic = Clinic::findOrFail($id);
        
        DB::beginTransaction();
        
        try {
            // Hapus admin poli terkait
            User::where('clinic_id', $clinic->id)
                ->where('role', 'admin_poli')
                ->delete();
            
            // Hapus klinik
            $clinic->delete();
            
            DB::commit();

            return redirect()->route('clinics.index')
                ->with('success', 'Klinik berhasil dihapus');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->withErrors(['error' => 'Gagal menghapus klinik.']);
        }
    }
}