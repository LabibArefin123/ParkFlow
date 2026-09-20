<?php

namespace App\Http\Controllers;
use App\Models\Payment;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();

        $stats = [
            'total_spaces' => 120,
            'available_spaces' => 74,
            'occupied_spaces' => 46,
            'today_revenue' => 42850,
        ];

        $activeSessions = [
            [
                'vehicle' => 'DHAKA METRO-GA-11-4587',
                'type' => 'Car',
                'spot' => 'A-024',
                'entry_time' => '10:32 AM',
                'duration' => '2h 17m',
            ],
            [
                'vehicle' => 'DHAKA METRO-HA-13-7788',
                'type' => 'Car',
                'spot' => 'B-018',
                'entry_time' => '11:04 AM',
                'duration' => '1h 45m',
            ],
            [
                'vehicle' => 'DHAKA METRO-LA-12-6743',
                'type' => 'Motorcycle',
                'spot' => 'A-031',
                'entry_time' => '11:32 AM',
                'duration' => '1h 17m',
            ],
            [
                'vehicle' => 'DHAKA METRO-GHA-15-9021',
                'type' => 'Microbus',
                'spot' => 'C-007',
                'entry_time' => '12:05 PM',
                'duration' => '44m',
            ],
        ];

        $recentTransactions = Payment::with([
            'parkingSession.vehicle'
        ])
            ->where('status', 'paid')
            ->latest('paid_at')
            ->take(8)
            ->get();

        $parkingSpots = [
            ['number' => 'A-01', 'status' => 'available'],
            ['number' => 'A-02', 'status' => 'occupied'],
            ['number' => 'A-03', 'status' => 'available'],
            ['number' => 'A-04', 'status' => 'available'],
            ['number' => 'A-05', 'status' => 'occupied'],
            ['number' => 'A-06', 'status' => 'available'],
            ['number' => 'A-07', 'status' => 'occupied'],
            ['number' => 'A-08', 'status' => 'available'],
            ['number' => 'A-09', 'status' => 'available'],
            ['number' => 'A-10', 'status' => 'occupied'],
            ['number' => 'A-11', 'status' => 'available'],
            ['number' => 'A-12', 'status' => 'available'],
        ];

        return view('parkflow.dashboard.index', compact(
            'user',
            'stats',
            'activeSessions',
            'recentTransactions',
            'parkingSpots'
        ));
    }
}
