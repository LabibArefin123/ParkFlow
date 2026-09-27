<div class="admin-stats">

    <div class="admin-stat admin-stat-users">
        <div class="admin-stat-glow"></div>

        <div class="admin-stat-top">
            <div class="admin-stat-icon">
                <i class="fa-solid fa-users"></i>
            </div>

            <span class="admin-stat-status">
                <i class="fa-solid fa-circle"></i>
                Active
            </span>
        </div>

        <div class="admin-stat-content">
            <span class="admin-stat-label">System Users</span>

            <div class="admin-stat-value">
                {{ $stats['users'] }}
            </div>

            <p class="admin-stat-description">
                People managing your ParkFlow operations.
            </p>
        </div>

        <div class="admin-stat-footer">
            <span>
                <i class="fa-solid fa-shield-halved"></i>
                Access managed
            </span>

            <i class="fa-solid fa-arrow-up-right"></i>
        </div>
    </div>

    <div class="admin-stat admin-stat-locations">
        <div class="admin-stat-glow"></div>

        <div class="admin-stat-top">
            <div class="admin-stat-icon">
                <i class="fa-solid fa-location-dot"></i>
            </div>

            <span class="admin-stat-status">
                <i class="fa-solid fa-circle"></i>
                Online
            </span>
        </div>

        <div class="admin-stat-content">
            <span class="admin-stat-label">Parking Locations</span>

            <div class="admin-stat-value">
                {{ $stats['parking_locations'] }}
            </div>

            <p class="admin-stat-description">
                Parking facilities currently connected to ParkFlow.
            </p>
        </div>

        <div class="admin-stat-footer">
            <span>
                <i class="fa-solid fa-map-location-dot"></i>
                Locations monitored
            </span>

            <i class="fa-solid fa-arrow-up-right"></i>
        </div>
    </div>

    <div class="admin-stat admin-stat-spots">
        <div class="admin-stat-glow"></div>

        <div class="admin-stat-top">
            <div class="admin-stat-icon">
                <i class="fa-solid fa-square-parking"></i>
            </div>

            <span class="admin-stat-status">
                <i class="fa-solid fa-circle"></i>
                Managed
            </span>
        </div>

        <div class="admin-stat-content">
            <span class="admin-stat-label">Parking Spots</span>

            <div class="admin-stat-value">
                {{ $stats['parking_spots'] }}
            </div>

            <p class="admin-stat-description">
                Parking spaces available across all locations.
            </p>
        </div>

        <div class="admin-stat-footer">
            <span>
                <i class="fa-solid fa-layer-group"></i>
                Space capacity
            </span>

            <i class="fa-solid fa-arrow-up-right"></i>
        </div>
    </div>

    <div class="admin-stat admin-stat-vehicles">
        <div class="admin-stat-glow"></div>

        <div class="admin-stat-top">
            <div class="admin-stat-icon">
                <i class="fa-solid fa-car"></i>
            </div>

            <span class="admin-stat-status">
                <i class="fa-solid fa-circle"></i>
                Registered
            </span>
        </div>

        <div class="admin-stat-content">
            <span class="admin-stat-label">Registered Vehicles</span>

            <div class="admin-stat-value">
                {{ $stats['vehicles'] }}
            </div>

            <p class="admin-stat-description">
                Vehicles registered in your parking system.
            </p>
        </div>

        <div class="admin-stat-footer">
            <span>
                <i class="fa-solid fa-car-side"></i>
                Vehicle records
            </span>

            <i class="fa-solid fa-arrow-up-right"></i>
        </div>
    </div>

</div>
