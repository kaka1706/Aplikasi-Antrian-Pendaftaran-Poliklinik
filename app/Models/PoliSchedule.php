<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PoliSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'poli_id',
        'day_of_week',
        'start_time',
        'end_time',
        'quota',
    ];

    /**
     * Jadwal milik satu Poli
     */
    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }

    /**
     * Jadwal memiliki banyak antrian
     */
    public function queues()
    {
        return $this->hasMany(Queue::class, 'poli_schedule_id');
    }
}
