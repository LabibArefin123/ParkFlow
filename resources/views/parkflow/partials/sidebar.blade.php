<aside class="parkflow-sidebar" id="parkflowSidebar">

    <div class="parkflow-sidebar-brand">

        <a href="{{ route('dashboard') }}" class="parkflow-sidebar-brand-link">

            <div class="parkflow-sidebar-logo">
                <img src="{{ asset('images/logo.png') }}" alt="ParkFlow Logo">
            </div>

            <div class="parkflow-sidebar-brand-text">
                <strong>ParkFlow</strong>
                <span>Parking Management</span>
            </div>

        </a>

        <button type="button" class="parkflow-sidebar-close" id="parkflowSidebarClose">
            <i class="fa-solid fa-xmark"></i>
        </button>

    </div>

    <div class="parkflow-sidebar-scroll">

        {{-- Overview --}}
        <div class="parkflow-sidebar-section">

            <div class="parkflow-sidebar-heading">
                Overview
            </div>

            <a href="{{ route('dashboard') }}"
                class="parkflow-sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">

                <span class="parkflow-sidebar-icon">
                    <i class="fa-solid fa-chart-pie"></i>
                </span>

                <span class="parkflow-sidebar-label">
                    Dashboard
                </span>

            </a>

            <a href="{{ route('parking.map') }}"
                class="parkflow-sidebar-link {{ request()->routeIs('parking.map') ? 'active' : '' }}">

                <span class="parkflow-sidebar-icon">
                    <i class="fa-solid fa-map-location-dot"></i>
                </span>

                <span class="parkflow-sidebar-label">
                    Parking Map
                </span>

            </a>

        </div>

        {{-- Operations --}}
        <div class="parkflow-sidebar-section">

            <div class="parkflow-sidebar-heading">
                Operations
            </div>

            <a href="{{ route('vehicle_entries.index') }}"
                class="parkflow-sidebar-link {{ request()->routeIs('vehicle_entries.*') ? 'active' : '' }}">

                <span class="parkflow-sidebar-icon">
                    <i class="fa-solid fa-right-to-bracket"></i>
                </span>

                <span class="parkflow-sidebar-label">
                    Vehicle Entry
                </span>

            </a>

            <a href="{{ route('sessions.active') }}"
                class="parkflow-sidebar-link {{ request()->routeIs('sessions.active') ? 'active' : '' }}">

                <span class="parkflow-sidebar-icon">
                    <i class="fa-solid fa-car-on"></i>
                </span>

                <span class="parkflow-sidebar-label">
                    Active Sessions
                </span>

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

                <span class="parkflow-sidebar-label">
                    Vehicle Exit
                </span>

            </a>

            <a href="{{ route('parking_sessions.index') }}"
                class="parkflow-sidebar-link {{ request()->routeIs('parking_sessions.*') ? 'active' : '' }}">

                <span class="parkflow-sidebar-icon">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </span>

                <span class="parkflow-sidebar-label">
                    Parking Sessions
                </span>

            </a>

        </div>

        {{-- Parking Setup --}}
        <div class="parkflow-sidebar-section">

            <div class="parkflow-sidebar-heading">
                Parking Setup
            </div>

            <a href="{{ route('parking_locations.index') }}"
                class="parkflow-sidebar-link {{ request()->routeIs('parking_locations.*') ? 'active' : '' }}">

                <span class="parkflow-sidebar-icon">
                    <i class="fa-solid fa-location-dot"></i>
                </span>

                <span class="parkflow-sidebar-label">
                    Parking Locations
                </span>

            </a>

            <a href="{{ route('parking_spots.index') }}"
                class="parkflow-sidebar-link {{ request()->routeIs('parking_spots.*') ? 'active' : '' }}">

                <span class="parkflow-sidebar-icon">
                    <i class="fa-solid fa-square-parking"></i>
                </span>

                <span class="parkflow-sidebar-label">
                    Parking Spots
                </span>

            </a>

        </div>

        {{-- Finance --}}
        <div class="parkflow-sidebar-section">

            <div class="parkflow-sidebar-heading">
                Finance & Reports
            </div>

            <a href="{{ route('revenue.index') }}"
                class="parkflow-sidebar-link {{ request()->routeIs('revenue.index') ? 'active' : '' }}">

                <span class="parkflow-sidebar-icon">
                    <i class="fa-solid fa-wallet"></i>
                </span>

                <span class="parkflow-sidebar-label">
                    Revenue
                </span>

            </a>

            <a href="{{ route('reports.index') }}"
                class="parkflow-sidebar-link {{ request()->routeIs('reports.index') ? 'active' : '' }}">

                <span class="parkflow-sidebar-icon">
                    <i class="fa-solid fa-chart-column"></i>
                </span>

                <span class="parkflow-sidebar-label">
                    Reports
                </span>

            </a>

        </div>

        {{-- Administration --}}
        <div class="parkflow-sidebar-section">

            <div class="parkflow-sidebar-heading">
                Administration
            </div>

            <a href="{{ route('administration') }}"
                class="parkflow-sidebar-link {{ request()->routeIs('administration') ? 'active' : '' }}">

                <span class="parkflow-sidebar-icon">
                    <i class="fa-solid fa-shield-halved"></i>
                </span>

                <span class="parkflow-sidebar-label">
                    Administration
                </span>

            </a>

            <a href="{{ url('/admin') }}" class="parkflow-sidebar-link">

                <span class="parkflow-sidebar-icon">
                    <i class="fa-solid fa-sliders"></i>
                </span>

                <span class="parkflow-sidebar-label">
                    Admin Panel
                </span>

            </a>

        </div>

    </div>

    {{-- Sidebar User --}}
    <div class="parkflow-sidebar-footer">

        @if ($user)
            <a href="{{ route('profile.index') }}"
                class="parkflow-sidebar-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">

                <span class="parkflow-sidebar-icon">
                    <i class="fa-solid fa-user-circle"></i>
                </span>

                <span class="parkflow-sidebar-label">
                    My Profile
                </span>

            </a>
            <div class="parkflow-sidebar-user">

                <div class="parkflow-sidebar-avatar">
                    {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                </div>

                <div class="parkflow-sidebar-user-info">
                    <strong>{{ $user->name ?? 'User' }}</strong>
                    <span>ParkFlow Operator</span>
                </div>

                <span class="parkflow-online-dot"></span>

            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="parkflow-logout">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span>Sign Out</span>
                </button>

            </form>
        @endif

    </div>

</aside>
