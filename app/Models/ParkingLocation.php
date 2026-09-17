<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'city',
        'phone',
        'total_spots',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function parkingSpots()
    {
        return $this->hasMany(ParkingSpot::class);
    }
}
