<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function __invoke()
    {
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

        $recentTransactions = [
            [
                'ticket' => 'PF-20260917-00124',
                'vehicle' => 'DHAKA METRO-GA-11-4587',
                'amount' => 120,
                'payment' => 'Cash',
                'time' => '12:49 PM',
            ],
            [
                'ticket' => 'PF-20260917-00123',
                'vehicle' => 'DHAKA METRO-HA-13-7788',
                'amount' => 180,
                'payment' => 'bKash',
                'time' => '12:37 PM',
            ],
            [
                'ticket' => 'PF-20260917-00122',
                'vehicle' => 'DHAKA METRO-KA-14-5567',
                'amount' => 100,
                'payment' => 'Cash',
                'time' => '12:18 PM',
            ],
            [
                'ticket' => 'PF-20260917-00121',
                'vehicle' => 'DHAKA METRO-CHA-16-2381',
                'amount' => 250,
                'payment' => 'Card',
                'time' => '11:56 AM',
            ],
        ];

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
            'stats',
            'activeSessions',
            'recentTransactions',
            'parkingSpots'
        ));
    }
}
