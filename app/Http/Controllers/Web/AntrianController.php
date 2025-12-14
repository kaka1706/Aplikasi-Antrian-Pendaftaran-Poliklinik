<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Queue;
use Illuminate\Support\Facades\Auth;

class AntrianController extends Controller
{
    public function index()
    {
        // show all queues for this clinic (admin poli)
        $user = auth::user();
        $queues = Queue::with('schedule.poli')
            ->whereHas('schedule.poli', fn($q)=> $q->where('clinic_id', $user->clinic_id))
            ->orderBy('created_at','asc')
            ->get();

        return view('app.queues.index', compact('queues'));
    }

    public function show($id)
    {
        $queue = Queue::with('schedule.poli')->findOrFail($id);
        return view('app.queues.show', compact('queue'));
    }

    // example action: call
    public function call(Queue $queue)
    {
        $queue->status = 'dipanggil';
        $queue->save();

        // TODO: send notification to kelompok 5 (webhook)
        return back()->with('success','Succeed call queue #'.$queue->queue_number);
    }

    public function finish(Queue $queue)
    {
        $queue->status = 'selesai';
        $queue->save();
        return back()->with('success','Succeed finish queue #'.$queue->queue_number);
    }
}
