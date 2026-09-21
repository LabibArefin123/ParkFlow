<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'ParkFlow' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Global Layout CSS --}}
    <link rel="stylesheet" href="{{ asset('css/custom_backend/global_layout/global_base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/global_layout/global_navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/global_layout/global_user.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/global_layout/global_layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/global_layout/global_image.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/global_layout/global_footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/global_layout/global_resp.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/global_layout/global_sidebar.css') }}">

    @stack('styles')
</head>

<body>

    <div class="parkflow-app">

        {{-- Mobile Sidebar Overlay --}}
        <div class="parkflow-sidebar-overlay" id="parkflowSidebarOverlay"></div>

        {{-- =====================================================
         SIDEBAR
         ===================================================== --}}
        <aside class="parkflow-sidebar" id="parkflowSidebar">

            {{-- Brand --}}
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

            {{-- Navigation --}}
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

        {{-- =====================================================
         MAIN AREA
         ===================================================== --}}
        <div class="parkflow-content-area">

            {{-- Topbar --}}
            <header class="parkflow-navbar">

                <div class="parkflow-navbar-inner">

                    <div class="parkflow-navbar-left">

                        <button type="button" class="parkflow-mobile-toggle" id="parkflowSidebarToggle">

                            <i class="fa-solid fa-bars"></i>

                        </button>

                        <div class="parkflow-page-heading">

                            <span>
                                PARKFLOW
                            </span>

                            <strong>
                                {{ $title ?? 'Dashboard' }}
                            </strong>

                        </div>

                    </div>

                    <div class="parkflow-navbar-right">

                        <div class="parkflow-system-status">
                            <span class="parkflow-status-dot"></span>
                            <span>System Online</span>
                        </div>

                        <div class="parkflow-navbar-divider"></div>

                        @if ($user)
                            <div class="parkflow-user">

                                <div class="parkflow-user-avatar">
                                    {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                                </div>

                                <div class="parkflow-user-info">
                                    <span class="parkflow-user-name">
                                        {{ $user->name ?? 'User' }}
                                    </span>

                                    <span class="parkflow-user-role">
                                        ParkFlow Operator
                                    </span>
                                </div>

                            </div>
                        @endif

                    </div>

                </div>

            </header>

            {{-- Main --}}
            <main class="parkflow-main">

                <div class="parkflow-container">
                    @yield('content')
                </div>

            </main>

            {{-- Footer --}}
            <footer class="parkflow-footer">

                <div class="parkflow-footer-left">
                    © {{ date('Y') }} ParkFlow. Parking management made simple.
                </div>

                <div class="parkflow-footer-right">
                    Design and Developed by
                    <a href="https://labib.work" target="_blank" rel="noopener noreferrer">
                        Md. Labib Arefin
                    </a>
                </div>

            </footer>

        </div>

    </div>

    @stack('scripts')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const sidebar = document.getElementById('parkflowSidebar');
            const overlay = document.getElementById('parkflowSidebarOverlay');
            const toggle = document.getElementById('parkflowSidebarToggle');
            const close = document.getElementById('parkflowSidebarClose');

            function openSidebar() {
                sidebar.classList.add('open');
                overlay.classList.add('show');
                document.body.classList.add('sidebar-open');
            }

            function closeSidebar() {
                sidebar.classList.remove('open');
                overlay.classList.remove('show');
                document.body.classList.remove('sidebar-open');
            }

            if (toggle) {
                toggle.addEventListener('click', openSidebar);
            }

            if (close) {
                close.addEventListener('click', closeSidebar);
            }

            if (overlay) {
                overlay.addEventListener('click', closeSidebar);
            }

            document.querySelectorAll('.parkflow-sidebar-link').forEach(function(link) {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        closeSidebar();
                    }
                });
            });

        });
    </script>

</body>

</html>
