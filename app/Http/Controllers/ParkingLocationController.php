<?php

namespace App\Http\Controllers;

use App\Models\ParkingLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ParkingLocationController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $parkingLocations = ParkingLocation::withCount('parkingSpots')
            ->latest()
            ->paginate(10);

        $stats = [
            'total' => ParkingLocation::count(),
            'active' => ParkingLocation::where('is_active', true)->count(),
            'inactive' => ParkingLocation::where('is_active', false)->count(),
            'spots' => ParkingLocation::with('parkingSpots')->get()->sum(function ($location) {
                return $location->parkingSpots->count();
            }),
        ];

        return view('parkflow.parking_locations.index', compact(
            'user',
            'parkingLocations',
            'stats'
        ));
    }

    public function create()
    {
        $user = auth()->user();

        return view('parkflow.parking_locations.create', compact('user'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20',
            'total_spots' => 'required|integer|min:1|max:10000',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        ParkingLocation::create($validated);

        return redirect()
            ->route('parking_locations.index')
            ->with('success', 'Parking location created successfully.');
    }

    public function show(ParkingLocation $parkingLocation)
    {
        $user = auth()->user();

        $parkingLocation->loadCount('parkingSpots');

        return view('parkflow.parking_locations.show', compact(
            'user',
            'parkingLocation'
        ));
    }

    public function edit(ParkingLocation $parkingLocation)
    {
        $user = auth()->user();

        return view('parkflow.parking_locations.edit', compact(
            'user',
            'parkingLocation'
        ));
    }

    public function update(Request $request, ParkingLocation $parkingLocation)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20',
            'total_spots' => 'required|integer|min:1|max:10000',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $parkingLocation->update($validated);

        return redirect()
            ->route('parking_locations.index')
            ->with('success', 'Parking location updated successfully.');
    }


    public function destroy(ParkingLocation $parkingLocation)
    {
        if ($parkingLocation->parkingSpots()->exists()) {
            return redirect()
                ->route('parking_locations.index')
                ->with('error', 'This parking location cannot be deleted because it has parking spots.');
        }

        $parkingLocation->delete();

        return redirect()
            ->route('parking_locations.index')
            ->with('success', 'Parking location deleted successfully.');
    }
}
