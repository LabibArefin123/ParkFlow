<?php

namespace App\Http\Controllers;

use App\Models\ParkingLocation;
use App\Models\ParkingSpot;

class ParkingMapController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $locations = ParkingLocation::where('is_active', true)
            ->with(['parkingSpots' => function ($query) {
                $query->orderBy('floor')->orderBy('spot_number');
            }])
            ->orderBy('name')
            ->get();

        $selectedLocation = $locations->firstWhere('id', request('location')) ?? $locations->first();

        $stats = [
            'total' => ParkingSpot::where('is_active', true)->count(),
            'available' => ParkingSpot::where('is_active', true)->where('status', 'available')->count(),
            'occupied' => ParkingSpot::where('is_active', true)->where('status', 'occupied')->count(),
            'reserved' => ParkingSpot::where('is_active', true)->where('status', 'reserved')->count(),
            'maintenance' => ParkingSpot::where('is_active', true)->where('status', 'maintenance')->count(),
        ];

        $floors = $selectedLocation
            ? $selectedLocation->parkingSpots
            ->where('is_active', true)
            ->pluck('floor')
            ->unique()
            ->values()
            : collect();

        return view('parkflow.parking.map', compact(
            'user',
            'locations',
            'selectedLocation',
            'stats',
            'floors'
        ));
    }
}
