<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'parking_spot_id',
        'vehicle_id',
        'entry_time',
        'exit_time',
        'status',
        'entry_gate',
        'exit_gate',
        'duration_minutes',
        'parking_fee',
        'discount',
        'total_amount',
    ];

    protected $casts = [
        'entry_time' => 'datetime',
        'exit_time' => 'datetime',
        'parking_fee' => 'decimal:2',
        'discount' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];

    public function getDurationAttribute()
    {
        if (!$this->entry_time) {
            return null;
        }
        $minutes = $this->entry_time->diffInMinutes(now());
        $hours = intdiv($minutes, 60);
        $remainingMinutes = $minutes % 60;
        if ($hours > 0) {
            return "{$hours}h {$remainingMinutes}m";
        }
        return "{$remainingMinutes}m";
    }

    public function parkingSpot()
    {
        return $this->belongsTo(ParkingSpot::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
