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
