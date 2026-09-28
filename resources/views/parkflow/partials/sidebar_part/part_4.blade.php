<div class="parkflow-sidebar-section">
    <div class="parkflow-sidebar-heading"> Parking Setup </div>
    <a href="{{ route('parking_locations.index') }}"
        class="parkflow-sidebar-link {{ request()->routeIs('parking_locations.*') ? 'active' : '' }}">
        <span class="parkflow-sidebar-icon">
            <i class="fa-solid fa-location-dot"></i>
        </span>

        <span class="parkflow-sidebar-label">Parking Locations</span>
    </a>

    <a href="{{ route('parking_spots.index') }}"
        class="parkflow-sidebar-link {{ request()->routeIs('parking_spots.*') ? 'active' : '' }}">
        <span class="parkflow-sidebar-icon">
            <i class="fa-solid fa-square-parking"></i>
        </span>

        <span class="parkflow-sidebar-label">Parking Spots </span>
    </a>

</div>
