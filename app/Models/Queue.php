<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Queue extends Model
{
    use HasFactory;

    protected $fillable = [
        'queue_number',
        'student_id',
        'poli_schedule_id',
        'status',
    ];

    /**
     * Relasi ke ClinicSchedule
     */
    public function schedule()
    {
        return $this->belongsTo(PoliSchedule::class, 'poli_schedule_id');
    }

    /**
     * Relasi ke NotificationLog
     */
    public function notificationLogs()
    {
        return $this->hasMany(NotificationLog::class);
    }
}
