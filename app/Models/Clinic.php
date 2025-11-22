<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;  

class Clinic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'description',
    ];

    /**
     * Relasi: 1 Clinic memiliki banyak jadwal.
     */
    public function polies()
    {
        return $this->hasMany(Poli::class);
    }
}
