<?php

namespace App\Http\Controllers;

use App\Models\ParkingSession;
use Illuminate\Http\Request;

class ParkingSessionController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = ParkingSession::with([
            'parkingSpot.parkingLocation',
            'vehicle'
        ])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;

            // $query->where(function ($q) use ($search) {
            //     $q->whereHas('vehicle', function ($vehicle) use ($search) {
            //         $vehicle->where('registration_number', 'like', "%{$search}%");
            //     })
            //         ->orWhereHas('customer', function ($customer) use ($search) {
            //             $customer->where('name', 'like', "%{$search}%")
            //                 ->orWhere('phone', 'like', "%{$search}%");
            //         })
            //         ->orWhere('entry_gate', 'like', "%{$search}%");
            // });
        }

        $parkingSessions = $query->paginate(12)->withQueryString();

        $stats = [
            'total' => ParkingSession::count(),
            'active' => ParkingSession::where('status', 'active')->count(),
            'completed' => ParkingSession::where('status', 'completed')->count(),
            'cancelled' => ParkingSession::where('status', 'cancelled')->count(),
        ];

        return view('parkflow.parking_sessions.index', compact(
            'user',
            'parkingSessions',
            'stats'
        ));
    }

    public function show(ParkingSession $parkingSession)
    {
        $user = auth()->user();

        $parkingSession->load([
            'parkingSpot.parkingLocation',
            'vehicle',
            'customer',
            'payment'
        ]);

        return view('parkflow.parking_sessions.show', compact(
            'user',
            'parkingSession'
        ));
    }
}
