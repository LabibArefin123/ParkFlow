@extends('parkflow.layouts.app')

@section('title', 'Vehicle Entry')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_entry/index_page/vehicle_entry_layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_entry/index_page/vehicle_entry_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_entry/index_page/vehicle_entry_stats.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_entry/index_page/vehicle_entry_locations.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_entry/index_page/vehicle_entry_sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_entry/index_page/vehicle_entry_table.css') }}">
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

            <div class="vehicle-entry-header-actions">
                <a href="{{ route('vehicle_entries.create') }}" class="entry-primary-btn">
                    <i class="fas fa-car-side"></i>
                    <span>Register Vehicle</span>
                </a>
                <div class="vehicle-view-toggle" role="group" aria-label="Vehicle entry view">
                    <button type="button" class="view-toggle-btn active" data-view="normal">
                        <i class="fas fa-grip"></i>
                        <span>Normal View</span>
                    </button>
                    <button type="button" class="view-toggle-btn" data-view="table">
                        <i class="fas fa-table-list"></i>
                        <span>Table View</span>
                    </button>
                </div>
            </div>
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
        <div class="vehicle-entry-normal-view">
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

                            <p>Create and activate a parking location before registering vehicles. </p>

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
        <div class="vehicle-entry-table-view">
            <div class="vehicle-entry-table-card">
                <div class="vehicle-entry-table-header">
                    <div>
                        <span class="entry-card-kicker">ACTIVE VEHICLES</span>
                        <h2>Current Parking Sessions</h2>
                        <p>Vehicles currently parked across your parking locations.</p>
                    </div>
                    <span class="vehicle-entry-table-count">{{ $vehicleEntries->count() }}</span>
                </div>
                <div class="vehicle-table-wrapper">
                    <table class="vehicle-entry-table">
                        <thead>
                            <tr>
                                <th>Vehicle</th>
                                <th>Parking Location</th>
                                <th>Parking Spot</th>
                                <th>Entry Time</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($vehicleEntries as $entry)
                                <tr>
                                    <td>
                                        <div class="vehicle-table-vehicle">
                                            <div class="vehicle-table-icon">
                                                <i class="fas fa-car-side"></i>
                                            </div>
                                            <div>
                                                <span
                                                    class="vehicle-table-name">{{ $entry->vehicle->registration_number }}</span>
                                                <span class="vehicle-table-type">{{ $entry->vehicle->vehicle_type }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="vehicle-table-location">
                                            <strong>{{ $entry->parkingSpot?->parkingLocation?->name ?? 'Unassigned' }}</strong>
                                            <span>{{ $entry->parkingSpot?->parkingLocation?->city ?? '—' }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="vehicle-table-spot">
                                            <i class="fas fa-square-parking"></i>
                                            {{ $entry->parkingSpot?->spot_number ?? '—' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="vehicle-table-time">
                                            {{ optional($entry->entry_time)->format('d M Y, h:i A') }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="vehicle-status">
                                            <span class="vehicle-status-dot"></span>
                                            Active
                                        </span>
                                    </td>
                                    <td>
                                        <div class="vehicle-table-actions">
                                            <a href="{{ route('vehicle_entries.show', $entry) }}"
                                                class="vehicle-table-action" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('vehicle_entries.edit', $entry) }}"
                                                class="vehicle-table-action" title="Edit">
                                                <i class="fas fa-pen-to-square"></i>
                                            </a>
                                            <form action="{{ route('vehicle_entries.destroy', $entry) }}" method="POST"
                                                class="vehicle-table-delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="vehicle-table-action vehicle-table-delete"
                                                    title="Delete"
                                                    onclick="return confirm('Are you sure you want to delete this parking entry?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="vehicle-table-empty">
                                        <div class="vehicle-table-empty-icon">
                                            <i class="fas fa-car-side"></i>
                                        </div>
                                        <strong>No active vehicles</strong>
                                        <span>There are currently no active parking sessions.</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/parkflow/vehicle_entry/index_page/toggle_switch.js') }}"></script>
@endsection
