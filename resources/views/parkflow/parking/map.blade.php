@extends('parkflow.layouts.app')

@section('title', 'Parking Map')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_map/parking_map_base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_map/parking_map_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_map/parking_map_stats.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_map/parking_map_toolbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_map/parking_map_layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_map/parking_map_spots.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_map/parking_map_detail.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_map/parking_map_resp.css') }}">

    <div class="parking-map-page">

        <div class="parking-map-header">
            <div class="parking-map-title">
                <div class="parking-map-title-icon">
                    <i class="fa-solid fa-map-location-dot"></i>
                </div>

                <div>
                    <h1>Parking Map</h1>
                    <p>Monitor parking availability and spot occupancy in real time.</p>
                </div>
            </div>

            <div class="parking-map-actions">
                <select id="parkingLocationSelect" class="parking-location-select">
                    @forelse($locations as $location)
                        <option value="{{ $location->id }}" @selected($selectedLocation?->id == $location->id)>
                            {{ $location->name }}
                        </option>
                    @empty
                        <option>No parking location available</option>
                    @endforelse
                </select>

                <button type="button" class="map-refresh-btn" id="parkingMapRefresh">
                    <i class="fa-solid fa-arrows-rotate"></i>
                </button>
            </div>
        </div>

        <div class="parking-stats">

            <div class="parking-stat">
                <div class="parking-stat-top">
                    <span class="parking-stat-label">Total Spaces</span>
                    <div class="parking-stat-icon">
                        <i class="fa-solid fa-square-parking"></i>
                    </div>
                </div>
                <div class="parking-stat-value" data-count="{{ $stats['total'] }}">0</div>
            </div>

            <div class="parking-stat available">
                <div class="parking-stat-top">
                    <span class="parking-stat-label">Available</span>
                    <div class="parking-stat-icon">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                </div>
                <div class="parking-stat-value" data-count="{{ $stats['available'] }}">0</div>
            </div>

            <div class="parking-stat occupied">
                <div class="parking-stat-top">
                    <span class="parking-stat-label">Occupied</span>
                    <div class="parking-stat-icon">
                        <i class="fa-solid fa-car"></i>
                    </div>
                </div>
                <div class="parking-stat-value" data-count="{{ $stats['occupied'] }}">0</div>
            </div>

            <div class="parking-stat reserved">
                <div class="parking-stat-top">
                    <span class="parking-stat-label">Reserved</span>
                    <div class="parking-stat-icon">
                        <i class="fa-solid fa-bookmark"></i>
                    </div>
                </div>
                <div class="parking-stat-value" data-count="{{ $stats['reserved'] }}">0</div>
            </div>

            <div class="parking-stat maintenance">
                <div class="parking-stat-top">
                    <span class="parking-stat-label">Maintenance</span>
                    <div class="parking-stat-icon">
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                    </div>
                </div>
                <div class="parking-stat-value" data-count="{{ $stats['maintenance'] }}">0</div>
            </div>

        </div>

        <div class="parking-map-card">
            <div class="parking-map-toolbar">
                <div class="parking-map-toolbar-left">
                    <div>
                        <div class="map-section-title">Parking Overview</div>
                        <div class="map-location-name">
                            {{ $selectedLocation?->name ?? 'No location selected' }}
                        </div>
                    </div>
                </div>

                <div class="map-search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="parkingSpotSearch" placeholder="Search spot...">
                </div>

            </div>

            <div class="parking-map-content">

                @if ($selectedLocation && $floors->count())

                    <div class="floor-tabs" id="floorTabs">

                        @foreach ($floors as $index => $floor)
                            <button type="button" class="floor-tab {{ $index === 0 ? 'active' : '' }}"
                                data-floor="{{ $floor }}">
                                <i class="fa-solid fa-layer-group me-1"></i>
                                {{ $floor }}
                            </button>
                        @endforeach

                    </div>

                    @foreach ($floors as $index => $floor)
                        <div class="floor-map" data-floor-map="{{ $floor }}"
                            style="{{ $index !== 0 ? 'display:none;' : '' }}">

                            <div class="parking-layout">

                                <div class="parking-lane">
                                    <i class="fa-solid fa-arrow-right"></i>
                                    Driving Lane
                                    <i class="fa-solid fa-arrow-left"></i>
                                </div>

                                <div class="parking-grid">

                                    @foreach ($selectedLocation->parkingSpots->where('floor', $floor)->where('is_active', true) as $spot)
                                        <div class="parking-spot {{ $spot->status }}"
                                            data-spot="{{ strtolower($spot->spot_number) }}"
                                            data-number="{{ $spot->spot_number }}" data-status="{{ $spot->status }}"
                                            data-floor="{{ $spot->floor }}" data-type="{{ $spot->vehicle_type }}"
                                            data-location="{{ $selectedLocation->name }}"
                                            style="animation-delay:{{ ($loop->index % 12) * 35 }}ms">

                                            <div class="spot-number">
                                                {{ $spot->spot_number }}
                                            </div>

                                            <div class="spot-icon">
                                                @if ($spot->status === 'available')
                                                    <i class="fa-solid fa-check"></i>
                                                @elseif($spot->status === 'occupied')
                                                    <i class="fa-solid fa-car-side"></i>
                                                @elseif($spot->status === 'reserved')
                                                    <i class="fa-solid fa-bookmark"></i>
                                                @else
                                                    <i class="fa-solid fa-wrench"></i>
                                                @endif
                                            </div>

                                            <div class="spot-type">
                                                {{ ucfirst($spot->vehicle_type) }}
                                            </div>

                                            <div class="spot-status">
                                                {{ ucfirst($spot->status) }}
                                            </div>

                                        </div>
                                    @endforeach

                                </div>

                            </div>

                        </div>
                    @endforeach
                @else
                    <div class="parking-empty">
                        <i class="fa-solid fa-square-parking"></i>
                        <h3>No parking spaces available</h3>
                        <p>Create a parking location and add parking spots to see the map.</p>
                    </div>

                @endif

            </div>

            <div class="parking-legend">
                <div class="legend-item">
                    <span class="legend-dot available"></span>
                    Available
                </div>

                <div class="legend-item">
                    <span class="legend-dot occupied"></span>
                    Occupied
                </div>

                <div class="legend-item">
                    <span class="legend-dot reserved"></span>
                    Reserved
                </div>

                <div class="legend-item">
                    <span class="legend-dot maintenance"></span>
                    Maintenance
                </div>
            </div>

        </div>

    </div>

    <div class="spot-detail-panel" id="spotDetailPanel">

        <div class="spot-detail-header">
            <h3 id="detailSpotNumber">A-001</h3>

            <button type="button" class="spot-detail-close" id="closeSpotDetail">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <div id="detailSpotStatus" class="spot-detail-status">
            <i class="fa-solid fa-circle-check"></i>
            Available
        </div>

        <div class="mt-3">

            <div class="spot-detail-row">
                <span>Location</span>
                <span id="detailLocation">-</span>
            </div>

            <div class="spot-detail-row">
                <span>Floor</span>
                <span id="detailFloor">-</span>
            </div>

            <div class="spot-detail-row">
                <span>Vehicle Type</span>
                <span id="detailType">-</span>
            </div>

            <div class="spot-detail-row">
                <span>Status</span>
                <span id="detailStatus">-</span>
            </div>

        </div>

    </div>

    <script src="{{ asset('js/parkflow/parking_map.js') }}"></script>
@endsection
