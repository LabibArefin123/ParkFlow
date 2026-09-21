<?php

namespace App\Http\Controllers;

use App\Models\ParkingSession;
use Illuminate\Http\Request;

class VehicleExitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = ParkingSession::with([
            'vehicle',
            'parkingSpot.parkingLocation',
            'payment',
        ])
            ->where('status', 'active')
            ->latest('entry_time');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->whereHas('vehicle', function ($vehicle) use ($search) {
                    $vehicle->where('registration_number', 'like', "%{$search}%");
                })
    
                    ->orWhere('entry_gate', 'like', "%{$search}%");
            });
        }

        $activeSessions = $query->paginate(12)->withQueryString();

        $totalActive = ParkingSession::where('status', 'active')->count();

        $todayEntries = ParkingSession::whereDate('entry_time', today())->count();

        $todayExits = ParkingSession::where('status', 'completed')
            ->whereDate('exit_time', today())
            ->count();

        return view('parkflow.vehicle_exits.index', compact(
            'user',
            'activeSessions',
            'totalActive',
            'todayEntries',
            'todayExits'
        ));
    }

    public function create(Request $request)
    {
        $user = auth()->user();

        $query = ParkingSession::with([
            'vehicle',
            'parkingSpot.parkingLocation',
            'payment',
        ])->where('status', 'active');

        if ($request->filled('session')) {
            $query->where('id', $request->session);
        }

        $parkingSession = $query->first();

        if (!$parkingSession) {
            return redirect()
                ->route('vehicle_exits.index')
                ->with('error', 'The selected parking session is no longer active.');
        }

        $entryTime = $parkingSession->entry_time;

        $durationMinutes = $entryTime
            ? $entryTime->diffInMinutes(now())
            : 0;

        $durationHours = max(1, ceil($durationMinutes / 60));

        /*
         * Replace this calculation with your actual
         * parking rate logic when the rate structure is ready.
         */
        $ratePerHour = 50;

        $estimatedAmount = $durationHours * $ratePerHour;

        return view('parkflow.vehicle_exits.create', compact(
            'user',
            'parkingSession',
            'durationMinutes',
            'durationHours',
            'ratePerHour',
            'estimatedAmount'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'parking_session_id' => 'required|exists:parking_sessions,id',
            'payment_method' => 'required|in:cash,bkash,nagad,card',
            'amount' => 'required|numeric|min:0',
            'notes' => 'nullable|string|max:1000',
        ]);

        $parkingSession = ParkingSession::with([
            'vehicle',
            'parkingSpot',
            'payment',
        ])->findOrFail($validated['parking_session_id']);

        if ($parkingSession->status !== 'active') {
            return back()
                ->withInput()
                ->withErrors([
                    'parking_session_id' => 'This parking session has already been completed.'
                ]);
        }

        $parkingSession->update([
            'status' => 'completed',
            'exit_time' => now(),
            'total_amount' => $validated['amount'],
        ]);

        if ($parkingSession->parkingSpot) {
            $parkingSession->parkingSpot->update([
                'status' => 'available',
            ]);
        }

        if ($parkingSession->payment) {
            $parkingSession->payment->update([
                'amount' => $validated['amount'],
                'payment_method' => $validated['payment_method'],
                'status' => 'paid',
                'paid_at' => now(),
            ]);
        } else {
            $parkingSession->payment()->create([
                'transaction_id' => 'PF-' . now()->format('YmdHis') . '-' . strtoupper(substr(uniqid(), -5)),
                'amount' => $validated['amount'],
                'payment_method' => $validated['payment_method'],
                'status' => 'paid',
                'paid_at' => now(),
            ]);
        }

        return redirect()
            ->route('vehicle_exits.index')
            ->with('success', 'Vehicle exit completed successfully.');
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
