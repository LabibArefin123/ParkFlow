<?php

namespace App\Http\Controllers;

use App\Models\ParkingLocation;
use App\Models\ParkingSession;
use App\Models\ParkingSpot;
use App\Models\Payment;
use App\Models\Vehicle;

class AdministrationController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $stats = [
            'users' => \App\Models\User::count(),
            'parking_locations' => ParkingLocation::count(),
            'parking_spots' => ParkingSpot::count(),
            'vehicles' => Vehicle::count(),
            'active_sessions' => ParkingSession::where('status', 'active')->count(),
            'payments' => Payment::count(),
        ];

        $modules = [
            [
                'title' => 'Users',
                'description' => 'Manage system users, operators and access.',
                'icon' => 'fa-users',
                'route' => '#',
                'count' => $stats['users'],
            ],
            [
                'title' => 'Parking Locations',
                'description' => 'Manage parking locations and facilities.',
                'icon' => 'fa-location-dot',
                'route' => 'parking_locations.index',
                'count' => $stats['parking_locations'],
            ],
            [
                'title' => 'Parking Spots',
                'description' => 'Configure parking spaces and availability.',
                'icon' => 'fa-square-parking',
                'route' => 'parking_spots.index',
                'count' => $stats['parking_spots'],
            ],
            [
                'title' => 'Vehicles',
                'description' => 'Manage registered vehicles and information.',
                'icon' => 'fa-car',
                'route' => '#',
                'count' => $stats['vehicles'],
            ],
            [
                'title' => 'Parking Sessions',
                'description' => 'View and manage parking sessions.',
                'icon' => 'fa-clock',
                'route' => 'parking_sessions.index',
                'count' => $stats['active_sessions'],
            ],
            [
                'title' => 'Payments',
                'description' => 'Manage parking payments and transactions.',
                'icon' => 'fa-money-bill-transfer',
                'route' => 'revenue.index',
                'count' => $stats['payments'],
            ],
        ];

        return view('parkflow.administration.index', compact(
            'user',
            'stats',
            'modules'
        ));
    }
}
