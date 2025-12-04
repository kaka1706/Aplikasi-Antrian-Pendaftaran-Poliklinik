<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Poli extends Model
{
    use HasFactory;

    protected $table = 'polies';

    protected $fillable = [
        'clinic_id',
        'name',
        'description',
    ];

    /**
     * Poli milik satu clinic
     */
    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    /**
     * Poli memiliki banyak jadwal
     */
    public function schedules()
    {
        return $this->hasMany(PoliSchedule::class);
    }
}
