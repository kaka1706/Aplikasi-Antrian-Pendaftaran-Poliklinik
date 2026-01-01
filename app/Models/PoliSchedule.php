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
        'is_active', 
    ];

    /**
     * Casting attribute untuk tipe data
     */
    protected $casts = [
        'is_active' => 'boolean', // ✅ Cast ke boolean
        'quota' => 'integer',
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

    /**
     * Scope untuk jadwal aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk jadwal berdasarkan hari
     */
    public function scopeByDay($query, $day)
    {
        return $query->where('day_of_week', $day);
    }

    /**
     * Scope untuk jadwal berdasarkan klinik
     */
    public function scopeByClinic($query, $clinicId)
    {
        return $query->whereHas('poli', function($q) use ($clinicId) {
            $q->where('clinic_id', $clinicId);
        });
    }

    /**
     * Cek apakah jadwal masih tersedia kuota hari ini
     */
    public function getAvailableQuotaAttribute()
    {
        $usedQuota = $this->queues()
            ->whereDate('created_at', today())
            ->count();
        
        return max(0, $this->quota - $usedQuota);
    }

    /**
     * Cek apakah jadwal bisa menerima antrian baru
     */
    public function canAcceptQueue()
    {
        // 1. Cek aktif
        if (!$this->is_active) {
            return false;
        }

        // 2. Cek hari sesuai
        $today = now()->format('l');
        $dayMapping = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu'
        ];

        if ($this->day_of_week !== ($dayMapping[$today] ?? $today)) {
            return false;
        }

        // 3. Cek jam operasional
        $currentTime = now()->format('H:i');
        if ($currentTime < $this->start_time || $currentTime > $this->end_time) {
            return false;
        }

        // 4. Cek kuota
        if ($this->available_quota <= 0) {
            return false;
        }

        return true;
    }

    /**
     * Accessor untuk status antrian
     */
    public function getStatusBadgeAttribute()
    {
        if (!$this->is_active) {
            return '<span class="badge bg-danger">Nonaktif</span>';
        }

        if ($this->available_quota <= 0) {
            return '<span class="badge bg-warning">Penuh</span>';
        }

        return '<span class="badge bg-success">Aktif</span>';
    }

    /**
     * Hitung antrian hari ini
     */
    public function getTodayQueuesCountAttribute()
    {
        return $this->queues()
            ->whereDate('created_at', today())
            ->count();
    }
}