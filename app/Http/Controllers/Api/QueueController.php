<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Queue;
use App\Models\PoliSchedule;
use Illuminate\Http\Request;

class QueueController extends Controller
{

    public function active($student_id)
    {
        $queue = Queue::with('schedule')
            ->where('student_id', $student_id)
            ->where('status', 'menunggu')
            ->first();

        return response()->json([
            'status' => true,
            'data' => $queue
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id'        => 'required',
            'poli_schedule_id'  => 'required|exists:poli_schedules,id',
        ]);

        $schedule = PoliSchedule::findOrFail($request->poli_schedule_id);

        $currentQueueCount = Queue::where('poli_schedule_id', $schedule->id)->count();

        if ($currentQueueCount >= $schedule->quota) {
            return response()->json([
                'status' => false,
                'message' => 'Kuota antrian sudah penuh untuk jadwal ini.'
            ], 400);
        }

        $already = Queue::where('student_id', $request->student_id)
            ->where('poli_schedule_id', $schedule->id)
            ->where('status', 'menunggu')
            ->first();

        if ($already) {
            return response()->json([
                'status' => false,
                'message' => 'Anda sudah terdaftar pada antrian jadwal ini.'
            ], 409);
        }

        $lastQueue = Queue::where('poli_schedule_id', $schedule->id)
            ->orderBy('queue_number', 'desc')
            ->first();

        $nextQueueNumber = $lastQueue ? $lastQueue->queue_number + 1 : 1;

        $queue = Queue::create([
            'student_id'        => $request->student_id,
            'poli_schedule_id'  => $schedule->id,
            'queue_number'      => $nextQueueNumber,
            'status'            => 'menunggu'
        ]);

        return response()->json([
            'status'    => true,
            'message'   => 'Berhasil mendaftar antrian',
            'data'      => $queue
        ], 201);
    }


    public function history($student_id)
    {
        $history = Queue::with('schedule')
            ->where('student_id', $student_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $history
        ]);
    }
}
