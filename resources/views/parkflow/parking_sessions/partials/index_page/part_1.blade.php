<div class="session-stats">

    <div class="session-stat">
        <div class="session-stat-top">
            <span class="session-stat-label">Total Sessions</span>
            <div class="session-stat-icon">
                <i class="fa-solid fa-list-check"></i>
            </div>
        </div>
        <div class="session-stat-value" data-count="{{ $stats['total'] }}">0</div>
    </div>

    <div class="session-stat active">
        <div class="session-stat-top">
            <span class="session-stat-label">Active Now</span>
            <div class="session-stat-icon">
                <i class="fa-solid fa-car-side"></i>
            </div>
        </div>
        <div class="session-stat-value" data-count="{{ $stats['active'] }}">0</div>
    </div>

    <div class="session-stat completed">
        <div class="session-stat-top">
            <span class="session-stat-label">Completed</span>
            <div class="session-stat-icon">
                <i class="fa-solid fa-circle-check"></i>
            </div>
        </div>
        <div class="session-stat-value" data-count="{{ $stats['completed'] }}">0</div>
    </div>

    <div class="session-stat cancelled">
        <div class="session-stat-top">
            <span class="session-stat-label">Cancelled</span>
            <div class="session-stat-icon">
                <i class="fa-solid fa-ban"></i>
            </div>
        </div>
        <div class="session-stat-value" data-count="{{ $stats['cancelled'] }}">0</div>
    </div>

</div>
