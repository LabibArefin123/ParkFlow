<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingSpot extends Model
{
    use HasFactory;

    protected $fillable = [
        'parking_location_id',
        'floor',
        'spot_number',
        'vehicle_type',
        'status',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function parkingLocation()
    {
        return $this->belongsTo(ParkingLocation::class);
    }

    public function parkingSessions()
    {
        return $this->hasMany(ParkingSession::class);
    }
}
