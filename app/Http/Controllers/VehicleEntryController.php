<?php

namespace App\Http\Controllers;

use App\Models\ParkingLocation;
use App\Models\ParkingSpot;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $locations = ParkingLocation::where('is_active', true)
            ->with(['parkingSpots' => function ($query) {
                $query->where('is_active', true)
                    ->where('status', 'available')
                    ->orderBy('floor')
                    ->orderBy('spot_number');
            }])
            ->orderBy('name')
            ->get();

        $availableSpots = ParkingSpot::where('is_active', true)
            ->where('status', 'available')
            ->count();

        $occupiedSpots = ParkingSpot::where('is_active', true)
            ->where('status', 'occupied')
            ->count();

        $totalVehicles = Vehicle::count();

        return view('parkflow.vehicle_entry.index', compact(
            'user',
            'locations',
            'availableSpots',
            'occupiedSpots',
            'totalVehicles'
        ));
    }

    public function create()
    {
        $user = auth()->user();

        $locations = ParkingLocation::where('is_active', true)
            ->with(['parkingSpots' => function ($query) {
                $query->where('is_active', true)
                    ->where('status', 'available')
                    ->orderBy('floor')
                    ->orderBy('spot_number');
            }])
            ->orderBy('name')
            ->get();

        $vehicles = Vehicle::latest()
            ->take(20)
            ->get();

        return view('parkflow.vehicle_entry.create', compact(
            'user',
            'locations',
            'vehicles'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'registration_number' => 'required|string|max:50',
            'type' => 'required|in:car,motorcycle,microbus,cng',
            'parking_location_id' => 'required|exists:parking_locations,id',
            'parking_spot_id' => 'required|exists:parking_spots,id',
            'entry_gate' => 'nullable|string|max:100',
            'customer_name' => 'nullable|string|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'notes' => 'nullable|string|max:1000',
        ]);

        $spot = ParkingSpot::where('id', $validated['parking_spot_id'])
            ->where('parking_location_id', $validated['parking_location_id'])
            ->where('is_active', true)
            ->where('status', 'available')
            ->first();

        if (!$spot) {
            return back()
                ->withInput()
                ->withErrors([
                    'parking_spot_id' => 'This parking spot is no longer available.'
                ]);
        }

        $vehicle = Vehicle::firstOrCreate(
            [
                'registration_number' => strtoupper($validated['registration_number']),
            ],
            [
                'type' => $validated['type'],
            ]
        );

        $spot->update([
            'status' => 'occupied',
        ]);

        return redirect()
            ->route('sessions.active')
            ->with('success', 'Vehicle entry recorded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
