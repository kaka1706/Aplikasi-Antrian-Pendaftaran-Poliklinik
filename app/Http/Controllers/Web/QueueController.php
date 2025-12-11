<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Queue;
use App\Models\Poli;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    public function index()
    {
        return view('app.queues.index', [
            'queues' => Queue::with('schedule')->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function show(Queue $queue)
    {
        $queue->load('schedule');
        return view('app.queues.show', compact('queue'));
    }

    public function destroy(Queue $queue)
    {
        $queue->delete();

        return back()->with('success', 'Antrian berhasil dihapus.');
    }
}