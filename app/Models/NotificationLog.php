<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotificationLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'queue_id',
        'sent_to_notification_service',
        'response_json',
    ];

    /**
     * Relasi ke Queue
     */
    public function queue()
    {
        return $this->belongsTo(Queue::class);
    }
}
