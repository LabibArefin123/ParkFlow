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
            'payment',
        ]);

        $sessionData = [
            'status' => ucfirst($parkingSession->status ?? 'Unknown'),
            'status_class' => strtolower($parkingSession->status ?? 'unknown'),
            'status_icon' => match (strtolower($parkingSession->status ?? '')) {
                'active' => 'fa-solid fa-circle',
                'completed' => 'fa-solid fa-circle-check',
                'cancelled' => 'fa-solid fa-circle-xmark',
                default => 'fa-solid fa-circle-question',
            },

            'vehicle_number' => $parkingSession->vehicle?->registration_number ?? 'Unknown Vehicle',
            'vehicle_type' => $parkingSession->vehicle?->type ?? 'Vehicle',
            'vehicle_icon' => match (strtolower($parkingSession->vehicle?->type ?? '')) {
                'motorcycle' => 'fa-solid fa-motorcycle',
                'microbus' => 'fa-solid fa-van-shuttle',
                'cng' => 'fa-solid fa-taxi',
                default => 'fa-solid fa-car-side',
            },

            'customer_name' => $parkingSession->customer?->name ?? 'Walk-in Customer',
            'customer_phone' => $parkingSession->customer?->phone ?? null,

            'spot_number' => $parkingSession->parkingSpot?->spot_number ?? '-',
            'location_name' => $parkingSession->parkingSpot?->parkingLocation?->name ?? 'Main Parking',

            'entry_time' => $parkingSession->entry_time?->format('h:i A') ?? '-',
            'entry_date' => $parkingSession->entry_time?->format('d M Y') ?? '-',

            'exit_time' => $parkingSession->exit_time?->format('h:i A') ?? '-',
            'exit_date' => $parkingSession->exit_time?->format('d M Y') ?? '-',

            'duration' => $parkingSession->duration_minutes
                ? floor($parkingSession->duration_minutes / 60) . 'h ' .
                ($parkingSession->duration_minutes % 60) . 'm'
                : ($parkingSession->status === 'active' && $parkingSession->entry_time
                    ? $parkingSession->entry_time->diffForHumans(now(), true)
                    : '-'),

            'amount' => number_format(
                $parkingSession->total_amount ?? $parkingSession->parking_fee ?? 0,
                2
            ),

            'payment_method' => $parkingSession->payment?->payment_method
                ? ucfirst($parkingSession->payment->payment_method)
                : 'Not Paid',

            'payment_status' => $parkingSession->payment?->status
                ? ucfirst($parkingSession->payment->status)
                : 'Pending',

            'transaction_id' => $parkingSession->payment?->transaction_id ?? '-',
        ];

        return view('parkflow.parking_sessions.show', compact(
            'user',
            'parkingSession',
            'sessionData'
        ));
    }
}
