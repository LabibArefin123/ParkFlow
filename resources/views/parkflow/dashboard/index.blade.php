@extends('parkflow.layouts.app')

@section('title', 'Dashboard')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/dashboard/dashboard_base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/dashboard/dashboard_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/dashboard/dashboard_card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/dashboard/dashboard_panel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/dashboard/dashboard_session.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/dashboard/dashboard_resp.css') }}">
@endpush

@section('content')

    <div class="container-fluid py-4">
        <div class="parkflow-dashboard">
            <div class="dashboard-header">
                <div>
                    <h1 class="dashboard-title">Parking Dashboard</h1>
                    <p class="dashboard-subtitle">Monitor your parking operations, vehicles and revenue.</p>
                </div>

                <div class="header-actions">
                    <a href="{{ route('parking.map') }}" class="pf-btn">
                        <i class="fas fa-map"></i>
                        Parking Map
                    </a>

                    <a href="{{ route('vehicle.entry') }}" class="pf-btn pf-btn-primary">
                        <i class="fas fa-car"></i>
                        Vehicle Entry
                    </a>
                </div>
            </div>

            <div class="stats-grid">

                <div class="stat-card">
                    <div class="stat-top">
                        <div class="stat-label">Total Spaces</div>
                        <div class="stat-icon">
                            <i class="fas fa-th-large"></i>
                        </div>
                    </div>
                    <div class="stat-value">{{ number_format($stats['total_spaces']) }}</div>
                    <div class="stat-meta">Parking spaces across the facility</div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <div class="stat-label">Available Spaces</div>
                        <div class="stat-icon">
                            <i class="fas fa-check"></i>
                        </div>
                    </div>
                    <div class="stat-value">{{ number_format($stats['available_spaces']) }}</div>
                    <div class="stat-meta">Currently available for parking</div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <div class="stat-label">Occupied Spaces</div>
                        <div class="stat-icon">
                            <i class="fas fa-car-side"></i>
                        </div>
                    </div>
                    <div class="stat-value">{{ number_format($stats['occupied_spaces']) }}</div>
                    <div class="stat-meta">Vehicles currently parked</div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <div class="stat-label">Today's Revenue</div>
                        <div class="stat-icon">
                            <i class="fas fa-bangladeshi-taka-sign"></i>
                        </div>
                    </div>
                    <div class="stat-value">৳{{ number_format($stats['today_revenue']) }}</div>
                    <div class="stat-meta">Total parking revenue today</div>
                </div>

            </div>

            <div class="dashboard-grid">

                <div class="panel">
                    <div class="panel-header">
                        <h2 class="panel-title">Parking Map</h2>
                        <a href="{{ route('parking.map') }}" class="panel-link">View Full Map</a>
                    </div>

                    <div class="panel-body">

                        <div class="map-toolbar">
                            <div class="map-floor">
                                <i class="fas fa-building"></i>
                                Ground Floor
                            </div>

                            <div class="map-legend">
                                <div class="legend-item">
                                    <span class="legend-dot legend-available"></span>
                                    Available
                                </div>

                                <div class="legend-item">
                                    <span class="legend-dot legend-occupied"></span>
                                    Occupied
                                </div>
                            </div>
                        </div>

                        <div class="parking-grid">
                            @foreach ($parkingSpots as $spot)
                                <div class="parking-spot {{ $spot['status'] }}">
                                    <div class="spot-number">{{ $spot['number'] }}</div>
                                    <div class="spot-status">
                                        {{ $spot['status'] }}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>

                <div class="panel">
                    <div class="panel-header">
                        <h2 class="panel-title">Active Sessions</h2>
                        <a href="{{ route('sessions.active') }}" class="panel-link">View All</a>
                    </div>

                    <div class="panel-body">
                        <div class="session-list">

                            @foreach ($activeSessions as $session)
                                <div class="session-item">

                                    <div class="vehicle-icon">
                                        @if ($session['type'] === 'Motorcycle')
                                            <i class="fas fa-motorcycle"></i>
                                        @elseif($session['type'] === 'Microbus')
                                            <i class="fas fa-bus"></i>
                                        @else
                                            <i class="fas fa-car"></i>
                                        @endif
                                    </div>

                                    <div class="session-info">
                                        <div class="vehicle-number">
                                            {{ $session['vehicle'] }}
                                        </div>

                                        <div class="session-meta">
                                            {{ $session['spot'] }} · {{ $session['entry_time'] }}
                                        </div>
                                    </div>

                                    <div class="session-duration">
                                        {{ $session['duration'] }}
                                        <small>{{ $session['type'] }}</small>
                                    </div>

                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

            </div>

            <div class="panel mb-4">

                <div class="panel-header">
                    <h2 class="panel-title">Recent Transactions</h2>
                    <a href="{{ route('revenue.index') }}" class="panel-link">View Revenue</a>
                </div>

                <div class="table-wrapper">

                    <table class="transactions">

                        <thead>
                            <tr>
                                <th>Ticket</th>
                                <th>Vehicle</th>
                                <th>Payment</th>
                                <th>Amount</th>
                                <th>Time</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($recentTransactions as $transaction)
                                <tr>
                                    <td>
                                        <span class="ticket">
                                            {{ $transaction['ticket'] }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $transaction['vehicle'] }}
                                    </td>

                                    <td>
                                        <span class="payment-badge">
                                            {{ $transaction['payment'] }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="amount">
                                            ৳{{ number_format($transaction['amount']) }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $transaction['time'] }}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>
            </div>

            <div class="panel">

                <div class="panel-header">
                    <h2 class="panel-title">Quick Actions</h2>
                </div>

                <div class="panel-body">

                    <div class="quick-actions">

                        <a href="{{ route('vehicle.entry') }}" class="quick-action">
                            <div class="quick-icon">
                                <i class="fas fa-sign-in-alt"></i>
                            </div>

                            <div class="quick-text">
                                <strong>Vehicle Entry</strong>
                                <span>Register a new parking vehicle</span>
                            </div>
                        </a>

                        <a href="{{ route('vehicle.exit') }}" class="quick-action">
                            <div class="quick-icon">
                                <i class="fas fa-sign-out-alt"></i>
                            </div>

                            <div class="quick-text">
                                <strong>Vehicle Exit</strong>
                                <span>Complete an active parking session</span>
                            </div>
                        </a>

                        <a href="{{ route('parking.map') }}" class="quick-action">
                            <div class="quick-icon">
                                <i class="fas fa-map-marked-alt"></i>
                            </div>

                            <div class="quick-text">
                                <strong>Parking Map</strong>
                                <span>Check available parking spaces</span>
                            </div>
                        </a>

                    </div>

                </div>

            </div>

        </div>
        
    </div>
@endsection
