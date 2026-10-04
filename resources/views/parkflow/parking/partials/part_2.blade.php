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
                                    <div class="spot-number"> {{ $spot->spot_number }} </div>
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

                                    <div class="spot-type"> {{ ucfirst($spot->vehicle_type) }} </div>
                                    <div class="spot-status"> {{ ucfirst($spot->status) }} </div>
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
