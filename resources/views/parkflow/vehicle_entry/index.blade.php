@extends('parkflow.layouts.app')

@section('title', 'Vehicle Entry')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_entry/index_page/vehicle_entry_layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_entry/index_page/vehicle_entry_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_entry/index_page/vehicle_entry_stats.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_entry/index_page/vehicle_entry_locations.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_entry/index_page/vehicle_entry_sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_entry/index_page/vehicle_entry_responsive.css') }}">
    <div class="vehicle-entry-page">

        <div class="vehicle-entry-header">
            <div>
                <div class="vehicle-entry-eyebrow">
                    <i class="fas fa-right-to-bracket"></i>
                    PARKING OPERATIONS
                </div>

                <h1>Vehicle Entry</h1>

                <p>
                    Register an incoming vehicle and assign an available parking space.
                </p>
            </div>

            <a href="{{ route('vehicle_entries.create') }}" class="entry-primary-btn">
                <i class="fas fa-car-side"></i>
                <span>Register Vehicle</span>
            </a>
        </div>

        <div class="entry-stat-grid">

            <div class="entry-stat-card">
                <div class="entry-stat-icon available">
                    <i class="fas fa-square-parking"></i>
                </div>

                <div>
                    <span>Available Spaces</span>
                    <strong>{{ $availableSpots }}</strong>
                    <small>Ready for entry</small>
                </div>
            </div>

            <div class="entry-stat-card">
                <div class="entry-stat-icon occupied">
                    <i class="fas fa-car"></i>
                </div>

                <div>
                    <span>Occupied Spaces</span>
                    <strong>{{ $occupiedSpots }}</strong>
                    <small>Currently parked</small>
                </div>
            </div>

            <div class="entry-stat-card">
                <div class="entry-stat-icon vehicles">
                    <i class="fas fa-car-side"></i>
                </div>

                <div>
                    <span>Registered Vehicles</span>
                    <strong>{{ $totalVehicles }}</strong>
                    <small>Total vehicle records</small>
                </div>
            </div>

        </div>

        <div class="entry-content-grid">

            <div class="entry-main-card">

                <div class="entry-card-header">
                    <div>
                        <span class="entry-card-kicker">QUICK ENTRY</span>
                        <h2>Choose Parking Location</h2>
                        <p>Select a location to view available spaces.</p>
                    </div>

                    <div class="entry-header-icon">
                        <i class="fas fa-location-dot"></i>
                    </div>
                </div>

                @if ($locations->count())

                    <div class="location-list">

                        @foreach ($locations as $location)
                            <div class="location-entry-card">

                                <div class="location-icon">
                                    <i class="fas fa-square-parking"></i>
                                </div>

                                <div class="location-info">
                                    <h3>{{ $location->name }}</h3>

                                    <p>
                                        <i class="fas fa-location-dot"></i>
                                        {{ $location->city }}
                                    </p>

                                    <div class="location-meta">
                                        <span>
                                            <i class="fas fa-car"></i>
                                            {{ $location->parkingSpots->count() }} available
                                        </span>

                                        <span>
                                            <i class="fas fa-layer-group"></i>
                                            {{ $location->parkingSpots->pluck('floor')->unique()->count() }} floors
                                        </span>
                                    </div>
                                </div>

                                <a href="{{ route('vehicle_entries.create', ['location' => $location->id]) }}"
                                    class="location-entry-btn">
                                    Enter Vehicle
                                    <i class="fas fa-arrow-right"></i>
                                </a>

                            </div>
                        @endforeach

                    </div>
                @else
                    <div class="entry-empty-state">
                        <div class="entry-empty-icon">
                            <i class="fas fa-square-parking"></i>
                        </div>

                        <h3>No Parking Location Available</h3>

                        <p>
                            Create and activate a parking location before registering vehicles.
                        </p>

                        <a href="{{ route('parking.locations.index') }}" class="entry-secondary-btn">
                            <i class="fas fa-location-dot"></i>
                            Manage Locations
                        </a>
                    </div>

                @endif

            </div>

            <aside class="entry-side-card">

                <div class="side-card-icon">
                    <i class="fas fa-circle-info"></i>
                </div>

                <span class="entry-card-kicker">ENTRY PROCESS</span>

                <h2>How it works</h2>

                <div class="entry-process">

                    <div class="process-item">
                        <span>01</span>
                        <div>
                            <strong>Register Vehicle</strong>
                            <p>Enter the vehicle registration and type.</p>
                        </div>
                    </div>

                    <div class="process-item">
                        <span>02</span>
                        <div>
                            <strong>Select Location</strong>
                            <p>Choose where the vehicle will be parked.</p>
                        </div>
                    </div>

                    <div class="process-item">
                        <span>03</span>
                        <div>
                            <strong>Assign Space</strong>
                            <p>Select an available parking spot.</p>
                        </div>
                    </div>

                    <div class="process-item">
                        <span>04</span>
                        <div>
                            <strong>Confirm Entry</strong>
                            <p>Start the active parking session.</p>
                        </div>
                    </div>

                </div>

            </aside>

        </div>

    </div>
@endsection
