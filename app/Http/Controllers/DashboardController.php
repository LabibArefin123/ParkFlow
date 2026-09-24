<?php

namespace App\Http\Controllers;

use App\Models\ParkingSession;
use App\Models\ParkingSpot;
use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();

        $stats = [
            'total_spaces' => ParkingSpot::count(),

            'available_spaces' => ParkingSpot::where('status', 'available')
                ->count(),

            'occupied_spaces' => ParkingSpot::where('status', 'occupied')
                ->count(),

            'today_revenue' => Payment::where('status', 'paid')
                ->whereDate('paid_at', today())
                ->sum('amount'),
        ];

        $activeSessions = ParkingSession::with([
            'vehicle',
            'parkingSpot',
            'parkingSpot.parkingLocation',
        ])
            ->where('status', 'active')
            ->latest('entry_time')
            ->take(4)
            ->get();

        $recentTransactions = Payment::with([
            'parkingSession.vehicle',
        ])
            ->where('status', 'paid')
            ->latest('paid_at')
            ->take(8)
            ->get();

        $parkingSpots = ParkingSpot::with('parkingLocation')
            ->latest()
            ->take(12)
            ->get();

        return view('parkflow.dashboard.index', compact(
            'user',
            'stats',
            'activeSessions',
            'recentTransactions',
            'parkingSpots'
        ));
    }

    
}
