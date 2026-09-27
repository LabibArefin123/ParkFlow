<?php

namespace App\Http\Controllers;

use App\Models\ParkingSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleExitController extends Controller
{
    /**
     * Display a listing of active parking sessions.
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
                    $vehicle->where(
                        'registration_number',
                        'like',
                        "%{$search}%"
                    );
                })
                    ->orWhere('entry_gate', 'like', "%{$search}%");
            });
        }

        $activeSessions = $query
            ->paginate(12)
            ->withQueryString();

        $totalActive = ParkingSession::where('status', 'active')->count();

        $todayEntries = ParkingSession::whereDate(
            'entry_time',
            today()
        )->count();

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

    /**
     * Show the vehicle exit form.
     */
    public function create(Request $request)
    {
        $user = auth()->user();

        $query = ParkingSession::with([
            'vehicle',
            'parkingSpot.parkingLocation',
            'payment',
        ])
            ->where('status', 'active');

        if ($request->filled('session')) {
            $query->where('id', $request->session);
        }

        $parkingSession = $query->first();

        if (!$parkingSession) {
            return redirect()
                ->route('vehicle_exits.index')
                ->with(
                    'error',
                    'The selected parking session is no longer active.'
                );
        }

        $entryTime = $parkingSession->entry_time;

        $durationMinutes = $entryTime
            ? $entryTime->diffInMinutes(now())
            : 0;

        $durationHours = max(
            1,
            ceil($durationMinutes / 60)
        );

        /*
         * Replace this with your actual
         * parking rate calculation later.
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

    /**
     * Complete an active parking session.
     */
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
        ])->findOrFail(
            $validated['parking_session_id']
        );

        if ($parkingSession->status !== 'active') {
            return back()
                ->withInput()
                ->withErrors([
                    'parking_session_id' =>
                    'This parking session has already been completed.'
                ]);
        }

        DB::transaction(function () use (
            $parkingSession,
            $validated
        ) {
            $parkingSession->update([
                'status' => 'completed',
                'exit_time' => now(),
                'total_amount' => $validated['amount'],
                'notes' => $validated['notes'] ?? null,
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
                    'transaction_id' =>
                    'PF-' .
                        now()->format('YmdHis') .
                        '-' .
                        strtoupper(substr(uniqid(), -5)),
                    'amount' => $validated['amount'],
                    'payment_method' => $validated['payment_method'],
                    'status' => 'paid',
                    'paid_at' => now(),
                ]);
            }
        });

        return redirect()
            ->route('vehicle_exits.index')
            ->with(
                'success',
                'Vehicle exit completed successfully.'
            );
    }

    /**
     * Display the completed vehicle exit.
     */
    public function show(string $id)
    {
        $user = auth()->user();

        $vehicleExit = ParkingSession::with([
            'vehicle',
            'parkingSpot.parkingLocation',
            'payment',
        ])
            ->where('status', 'completed')
            ->findOrFail($id);

        $durationMinutes = 0;

        if (
            $vehicleExit->entry_time &&
            $vehicleExit->exit_time
        ) {
            $durationMinutes = $vehicleExit->entry_time
                ->diffInMinutes($vehicleExit->exit_time);
        }

        $durationHours = floor($durationMinutes / 60);

        return view(
            'parkflow.vehicle_exits.show',
            compact(
                'user',
                'vehicleExit',
                'durationMinutes',
                'durationHours'
            )
        );
    }

    /**
     * Show the form for editing a completed vehicle exit.
     */
    public function edit(string $id)
    {
        $user = auth()->user();

        $vehicleExit = ParkingSession::with([
            'vehicle',
            'parkingSpot.parkingLocation',
            'payment',
        ])
            ->where('status', 'completed')
            ->findOrFail($id);

        $durationMinutes = 0;

        if (
            $vehicleExit->entry_time &&
            $vehicleExit->exit_time
        ) {
            $durationMinutes = $vehicleExit->entry_time
                ->diffInMinutes($vehicleExit->exit_time);
        }

        $durationHours = floor($durationMinutes / 60);

        return view(
            'parkflow.vehicle_exits.edit',
            compact(
                'user',
                'vehicleExit',
                'durationMinutes',
                'durationHours'
            )
        );
    }

    /**
     * Update a completed vehicle exit.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'payment_method' => 'required|in:cash,bkash,nagad,card',
            'amount' => 'required|numeric|min:0',
            'notes' => 'nullable|string|max:1000',
        ]);

        $vehicleExit = ParkingSession::with([
            'vehicle',
            'parkingSpot',
            'payment',
        ])
            ->where('status', 'completed')
            ->findOrFail($id);

        DB::transaction(function () use (
            $vehicleExit,
            $validated
        ) {
            $vehicleExit->update([
                'total_amount' => $validated['amount'],
                'notes' => $validated['notes'] ?? null,
            ]);

            if ($vehicleExit->payment) {
                $vehicleExit->payment->update([
                    'amount' => $validated['amount'],
                    'payment_method' => $validated['payment_method'],
                    'status' => 'paid',
                    'paid_at' => $vehicleExit->payment->paid_at
                        ?? now(),
                ]);
            } else {
                $vehicleExit->payment()->create([
                    'transaction_id' =>
                    'PF-' .
                        now()->format('YmdHis') .
                        '-' .
                        strtoupper(substr(uniqid(), -5)),
                    'amount' => $validated['amount'],
                    'payment_method' => $validated['payment_method'],
                    'status' => 'paid',
                    'paid_at' => now(),
                ]);
            }
        });

        return redirect()
            ->route('vehicle_exits.show', $vehicleExit)
            ->with(
                'success',
                'Vehicle exit updated successfully.'
            );
    }

    /**
     * Remove the specified vehicle exit.
     */
    public function destroy(string $id)
    {
        $vehicleExit = ParkingSession::where(
            'status',
            'completed'
        )->findOrFail($id);

        return back()->with(
            'error',
            'Completed vehicle exits cannot be deleted.'
        );
    }
}
