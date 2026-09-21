<?php

namespace App\Http\Controllers;

use App\Models\ParkingSession;
use Illuminate\Http\Request;

class ActiveSessionController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = ParkingSession::with([
            'vehicle',
            'parkingSpot.parkingLocation',
        ])
            ->where('status', 'active')
            ->latest('entry_time');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->whereHas('vehicle', function ($vehicle) use ($search) {
                    $vehicle->where('registration_number', 'like', "%{$search}%");
                })
                    
                    ->orWhereHas('parkingSpot', function ($spot) use ($search) {
                        $spot->where('spot_number', 'like', "%{$search}%")
                            ->orWhere('floor', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('vehicle_type')) {
            $query->whereHas('vehicle', function ($vehicle) use ($request) {
                $vehicle->where('type', $request->vehicle_type);
            });
        }

        if ($request->filled('location')) {
            $query->whereHas('parkingSpot', function ($spot) use ($request) {
                $spot->where('parking_location_id', $request->location);
            });
        }

        $activeSessions = $query->paginate(12)->withQueryString();

        $totalActive = ParkingSession::where('status', 'active')->count();

        $todayEntries = ParkingSession::whereDate('entry_time', today())
            ->count();

        $longStayCount = ParkingSession::where('status', 'active')
            ->where('entry_time', '<=', now()->subHours(6))
            ->count();

        $locations = ParkingSession::where('status', 'active')
            ->with('parkingSpot.parkingLocation')
            ->get()
            ->pluck('parkingSpot.parkingLocation')
            ->filter()
            ->unique('id')
            ->sortBy('name')
            ->values();

        $vehicleTypes = ParkingSession::where('status', 'active')
            ->with('vehicle')
            ->get()
            ->pluck('vehicle.type')
            ->filter()
            ->unique()
            ->sort()
            ->values();

        return view('parkflow.active_sessions.index', compact(
            'user',
            'activeSessions',
            'totalActive',
            'todayEntries',
            'longStayCount',
            'locations',
            'vehicleTypes'
        ));
    }
}
