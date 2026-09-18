<?php

namespace App\Http\Controllers;

use App\Models\ParkingLocation;
use App\Models\ParkingSpot;
use Illuminate\Http\Request;

class ParkingSpotController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $parkingSpots = ParkingSpot::with('parkingLocation')
            ->latest()
            ->paginate(12);

        $locations = ParkingLocation::where('is_active', true)
            ->orderBy('name')
            ->get();

        $stats = [
            'total' => ParkingSpot::count(),
            'available' => ParkingSpot::where('status', 'available')->count(),
            'occupied' => ParkingSpot::where('status', 'occupied')->count(),
            'maintenance' => ParkingSpot::where('status', 'maintenance')->count(),
        ];

        return view('parkflow.parking_spots.index', compact(
            'user',
            'parkingSpots',
            'locations',
            'stats'
        ));
    }

    public function create()
    {
        $user = auth()->user();

        $parkingLocations = ParkingLocation::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('parkflow.parking_spots.create', compact(
            'user',
            'parkingLocations'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'parking_location_id' => 'required|exists:parking_locations,id',
            'floor' => 'required|string|max:100',
            'spot_number' => 'required|string|max:50',
            'vehicle_type' => 'required|in:car,motorcycle,microbus,cng',
            'status' => 'required|in:available,occupied,reserved,maintenance',
            'is_active' => 'nullable|boolean',
        ]);

        $exists = ParkingSpot::where('parking_location_id', $validated['parking_location_id'])
            ->where('spot_number', $validated['spot_number'])
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'spot_number' => 'This parking spot already exists in the selected location.'
                ]);
        }

        $validated['is_active'] = $request->boolean('is_active');

        ParkingSpot::create($validated);

        $location = ParkingLocation::find($validated['parking_location_id']);

        if ($location) {
            $location->update([
                'total_spots' => $location->parkingSpots()->count(),
            ]);
        }

        return redirect()
            ->route('parking_spots.index')
            ->with('success', 'Parking spot created successfully.');
    }

    public function destroy(ParkingSpot $parkingSpot)
    {
        $location = $parkingSpot->parkingLocation;

        if ($parkingSpot->parkingSessions()->exists()) {
            return redirect()
                ->route('parking_spots.index')
                ->with('error', 'This parking spot cannot be deleted because it has parking session records.');
        }

        $parkingSpot->delete();

        if ($location) {
            $location->update([
                'total_spots' => $location->parkingSpots()->count(),
            ]);
        }

        return redirect()
            ->route('parking_spots.index')
            ->with('success', 'Parking spot deleted successfully.');
    }
}
