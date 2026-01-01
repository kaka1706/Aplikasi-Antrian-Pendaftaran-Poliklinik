<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PoliSchedule;
use App\Models\Poli;
use App\Models\Clinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class PoliScheduleController extends Controller
{
    private function checkAuth()
    {
        if (!Auth::check()) {
            abort(401);
        }
    }

    private function checkAuthorization($schedule = null, $action = 'view')
    {
        $user = Auth::user();

        if ($user->role === 'admin_poli' && $schedule) {
            if ($schedule->poli->clinic_id !== $user->clinic_id) {
                abort(403, "Tidak memiliki akses untuk $action jadwal ini.");
            }
        }
    }

    public function index(Request $request)
    {
        $this->checkAuth();
        $user = Auth::user();

        $query = PoliSchedule::with(['poli.clinic']);

        if ($user->role === 'admin_poli') {
            $query->whereHas('poli', function ($q) use ($user) {
                $q->where('clinic_id', $user->clinic_id);
            });
        }

        if ($request->filled('clinic_id') && $user->role === 'admin_prodi') {
            $query->whereHas('poli', function ($q) use ($request) {
                $q->where('clinic_id', $request->clinic_id);
            });
        }

        if ($request->filled('day_of_week')) {
            $query->where('day_of_week', $request->day_of_week);
        }

        $clinics = Clinic::all();
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        $schedules = $query
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->paginate(20);

        return view('app.poli-schedules.index', compact('schedules', 'clinics', 'days'));
    }

    public function create()
    {
        $this->checkAuth();
        $user = Auth::user();

        $polis = $user->role === 'admin_poli'
            ? Poli::where('clinic_id', $user->clinic_id)->orderBy('name')->get()
            : Poli::with('clinic')->orderBy('name')->get();

        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        return view('app.poli-schedules.create', compact('polis', 'days'));
    }

    public function store(Request $request)
    {
        $this->checkAuth();

        $validated = $request->validate([
            'poli_id'     => 'required|exists:polies,id', // ✅ FIX
            'day_of_week' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'start_time'  => 'required|date_format:H:i',
            'end_time'    => 'required|date_format:H:i|after:start_time',
            'quota'       => 'required|integer|min:1|max:100',
            'is_active'   => 'nullable|boolean',
        ]);

        $validated['is_active'] = $validated['is_active'] ?? true;

        PoliSchedule::create($validated);

        return redirect()
            ->route('poli_schedules.index')
            ->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function show($id)
    {
        $this->checkAuth();

        $schedule = PoliSchedule::with('poli.clinic')->findOrFail($id);
        $this->checkAuthorization($schedule, 'view');

        return view('app.poli-schedules.show', compact('schedule'));
    }

    public function edit($id)
    {
        $this->checkAuth();

        $schedule = PoliSchedule::findOrFail($id);
        $this->checkAuthorization($schedule, 'edit');

        $user = Auth::user();

        $polis = $user->role === 'admin_poli'
            ? Poli::where('clinic_id', $user->clinic_id)->orderBy('name')->get()
            : Poli::orderBy('name')->get();

        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        return view('app.poli-schedules.edit', compact('schedule', 'polis', 'days'));
    }

    public function update(Request $request, $id)
    {
        $this->checkAuth();

        $schedule = PoliSchedule::findOrFail($id);
        $this->checkAuthorization($schedule, 'update');

        $validated = $request->validate([
            'poli_id'     => 'required|exists:polies,id', // ✅ FIX
            'day_of_week' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'start_time'  => 'required|date_format:H:i',
            'end_time'    => 'required|date_format:H:i|after:start_time',
            'quota'       => 'required|integer|min:1|max:100',
            'is_active'   => 'nullable|boolean',
        ]);

        $schedule->update($validated);

        return redirect()
            ->route('poli_schedules.index')
            ->with('success', 'Jadwal berhasil diperbarui');
    }

    public function destroy($id)
    {
        $this->checkAuth();

        $schedule = PoliSchedule::findOrFail($id);
        $this->checkAuthorization($schedule, 'delete');

        $schedule->delete();

        return redirect()
            ->route('poli_schedules.index')
            ->with('success', 'Jadwal berhasil dihapus');
    }

    public function todaySchedules()
    {
        $today = Carbon::now()->locale('id')->dayName;

        $schedules = PoliSchedule::with('poli.clinic')
            ->where('day_of_week', $today)
            ->where('is_active', true)
            ->orderBy('start_time')
            ->get();

        return view('app.poli-schedules.today', compact('schedules', 'today'));
    }
}
