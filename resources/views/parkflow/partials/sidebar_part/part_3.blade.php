<div class="parkflow-sidebar-section">
    <div class="parkflow-sidebar-heading">Operations</div>
    <a href="{{ route('vehicle_entries.index') }}"
        class="parkflow-sidebar-link {{ request()->routeIs('vehicle_entries.*') ? 'active' : '' }}">
        <span class="parkflow-sidebar-icon">
            <i class="fa-solid fa-right-to-bracket"></i>
        </span>
        <span class="parkflow-sidebar-label"> Vehicle Entry </span>
    </a>

    <a href="{{ route('sessions.active') }}"
        class="parkflow-sidebar-link {{ request()->routeIs('sessions.active') ? 'active' : '' }}">
        <span class="parkflow-sidebar-icon">
            <i class="fa-solid fa-car-on"></i>
        </span>

        <span class="parkflow-sidebar-label"> Active Sessions </span>
        @php
            $activeSessionCount = \App\Models\ParkingSession::where('status', 'active')->count();
        @endphp

        @if ($activeSessionCount > 0)
            <span class="parkflow-sidebar-badge">
                {{ $activeSessionCount > 99 ? '99+' : $activeSessionCount }}
            </span>
        @endif
    </a>

    <a href="{{ route('vehicle_exits.index') }}"
        class="parkflow-sidebar-link {{ request()->routeIs('vehicle_exits.*') ? 'active' : '' }}">
        <span class="parkflow-sidebar-icon">
            <i class="fa-solid fa-right-from-bracket"></i>
        </span>

        <span class="parkflow-sidebar-label"> Vehicle Exit</span>
    </a>

    <a href="{{ route('parking_sessions.index') }}"
        class="parkflow-sidebar-link {{ request()->routeIs('parking_sessions.*') ? 'active' : '' }}">
        <span class="parkflow-sidebar-icon">
            <i class="fa-solid fa-clock-rotate-left"></i>
        </span>

        <span class="parkflow-sidebar-label"> Parking Sessions </span>
    </a>
</div>
