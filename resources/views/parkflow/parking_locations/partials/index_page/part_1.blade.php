<div class="location-stats">
    <div class="location-stat">
        <div class="location-stat-icon">
            <i class="fa-solid fa-location-dot"></i>
        </div>
        <div>
            <div class="location-stat-value">{{ $stats['total'] }}</div>
            <div class="location-stat-label">Total Locations</div>
        </div>
    </div>

    <div class="location-stat">
        <div class="location-stat-icon">
            <i class="fa-solid fa-circle-check"></i>
        </div>
        <div>
            <div class="location-stat-value">{{ $stats['active'] }}</div>
            <div class="location-stat-label">Active Locations</div>
        </div>
    </div>

    <div class="location-stat">
        <div class="location-stat-icon">
            <i class="fa-solid fa-circle-xmark"></i>
        </div>
        <div>
            <div class="location-stat-value">{{ $stats['inactive'] }}</div>
            <div class="location-stat-label">Inactive Locations</div>
        </div>
    </div>

    <div class="location-stat">
        <div class="location-stat-icon">
            <i class="fa-solid fa-square-parking"></i>
        </div>
        <div>
            <div class="location-stat-value">{{ $stats['spots'] }}</div>
            <div class="location-stat-label">Parking Spots</div>
        </div>
    </div>
</div>
