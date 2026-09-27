<div class="show-location-footer">
    <a href="{{ route('parking_locations.index') }}" class="show-location-btn show-location-cancel">
        Back
    </a>

    <a href="{{ route('parking_locations.edit', $parkingLocation) }}" class="show-location-btn show-location-submit">
        <i class="fa-solid fa-pen"></i>
        Edit Location
    </a>
</div>
