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
