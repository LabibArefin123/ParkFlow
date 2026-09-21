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
