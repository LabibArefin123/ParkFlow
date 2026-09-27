<?php

namespace App\Http\Controllers;

use App\Models\ParkingLocation;
use App\Models\ParkingSpot;
use App\Models\ParkingSession;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VehicleEntryController extends Controller
{
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
        $vehicleEntries = ParkingSession::with([
            'vehicle',
            'parkingSpot.parkingLocation'
        ])
            ->where('status', 'active')
            ->latest()
            ->get();
        return view('parkflow.vehicle_entry.index', compact(
            'user',
            'locations',
            'availableSpots',
            'occupiedSpots',
            'totalVehicles',
            'vehicleEntries'
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
        $vehicles = Vehicle::latest()->take(20)->get();
        return view('parkflow.vehicle_entry.create', compact('user', 'locations', 'vehicles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'registration_number' => 'required|string|max:50',
            'type' => 'required|in:car,motorcycle,microbus,cng',
            'parking_location_id' => 'required|exists:parking_locations,id',
            'parking_spot_id' => 'required|exists:parking_spots,id',
            'notes' => 'nullable|string|max:1000',
        ]);
        try {
            DB::transaction(function () use ($validated) {
                $spot = ParkingSpot::where('id', $validated['parking_spot_id'])
                    ->where('parking_location_id', $validated['parking_location_id'])
                    ->where('is_active', true)
                    ->where('status', 'available')
                    ->lockForUpdate()
                    ->first();
                if (!$spot) {
                    throw new \RuntimeException('This parking spot is no longer available.');
                }
                $vehicle = Vehicle::firstOrCreate(
                    ['registration_number' => strtoupper($validated['registration_number'])],
                    ['vehicle_type' => $validated['type']]
                );
                $vehicle->update([
                    'vehicle_type' => $validated['type'],
                ]);
                $spot->update([
                    'status' => 'occupied',
                ]);
                ParkingSession::create([
                    'vehicle_id' => $vehicle->id,
                    'parking_slot_id' => $spot->id,
                    'entry_time' => now(),
                    'status' => 'active',
                    'notes' => $validated['notes'] ?? null,
                ]);
            });
        } catch (\RuntimeException $e) {
            return back()->withInput()->withErrors([
                'parking_spot_id' => $e->getMessage(),
            ]);
        }
        return redirect()->route('sessions.active')->with('success', 'Vehicle entry recorded successfully.');
    }

    public function show(ParkingSession $vehicleEntry)
    {
        $user = auth()->user();
        $vehicleEntry->load([
            'vehicle',
            'parkingSpot.parkingLocation',
        ]);
        return view('parkflow.vehicle_entry.show', compact('vehicleEntry', 'user'));
    }

    public function edit(ParkingSession $vehicleEntry)
    {
        $vehicleEntry->load([
            'vehicle',
            'parkingSpot.parkingLocation',
        ]);
        $locations = ParkingLocation::where('is_active', true)
            ->with(['parkingSpots' => function ($query) use ($vehicleEntry) {
                $query->where('is_active', true)
                    ->where(function ($query) use ($vehicleEntry) {
                        $query->where('status', 'available')
                            ->orWhere('id', $vehicleEntry->parking_slot_id);
                    })
                    ->orderBy('floor')
                    ->orderBy('spot_number');
            }])
            ->orderBy('name')
            ->get();
        return view('parkflow.vehicle_entry.edit', compact('vehicleEntry', 'locations'));
    }

    public function update(Request $request, ParkingSession $vehicleEntry)
    {
        $validated = $request->validate([
            'registration_number' => 'required|string|max:50',
            'type' => 'required|in:car,motorcycle,microbus,cng',
            'parking_location_id' => 'required|exists:parking_locations,id',
            'parking_spot_id' => 'required|exists:parking_spots,id',
            'notes' => 'nullable|string|max:1000',
        ]);
        try {
            DB::transaction(function () use ($validated, $vehicleEntry) {
                $vehicleEntry->load('vehicle');
                $oldSpot = ParkingSpot::lockForUpdate()->find($vehicleEntry->parking_slot_id);
                $newSpot = ParkingSpot::where('id', $validated['parking_spot_id'])
                    ->where('parking_location_id', $validated['parking_location_id'])
                    ->where('is_active', true)
                    ->where(function ($query) use ($vehicleEntry) {
                        $query->where('status', 'available')
                            ->orWhere('id', $vehicleEntry->parking_slot_id);
                    })
                    ->lockForUpdate()
                    ->first();
                if (!$newSpot) {
                    throw new \RuntimeException('This parking spot is no longer available.');
                }
                $vehicleEntry->vehicle->update([
                    'registration_number' => strtoupper($validated['registration_number']),
                    'vehicle_type' => $validated['type'],
                ]);
                if ($oldSpot && $oldSpot->id !== $newSpot->id) {
                    $oldSpot->update([
                        'status' => 'available',
                    ]);
                    $newSpot->update([
                        'status' => 'occupied',
                    ]);
                } elseif ($newSpot->status !== 'occupied') {
                    $newSpot->update([
                        'status' => 'occupied',
                    ]);
                }
                $vehicleEntry->update([
                    'parking_slot_id' => $newSpot->id,
                    'notes' => $validated['notes'] ?? null,
                ]);
            });
        } catch (\RuntimeException $e) {
            return back()->withInput()->withErrors([
                'parking_spot_id' => $e->getMessage(),
            ]);
        }
        return redirect()->route('vehicle_entries.show', $vehicleEntry)->with('success', 'Vehicle entry updated successfully.');
    }

    public function destroy(ParkingSession $vehicleEntry)
    {
        DB::transaction(function () use ($vehicleEntry) {
            $vehicleEntry->load('parkingSpot');
            if ($vehicleEntry->parkingSpot) {
                $vehicleEntry->parkingSpot->update([
                    'status' => 'available',
                ]);
            }
            $vehicleEntry->update([
                'status' => 'cancelled',
                'exit_time' => now(),
            ]);
        });
        return redirect()->route('vehicle_entries.index')->with('success', 'Vehicle entry cancelled successfully.');
    }
}
