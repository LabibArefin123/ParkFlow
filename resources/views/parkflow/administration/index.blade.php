@extends('parkflow.layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/admin_page/admin_layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/admin_page/admin_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/admin_page/admin_stats.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/admin_page/admin_modules.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/admin_page/admin_respp.css') }}">

    <div class="admin-page">

        <div class="admin-header">

            <div>
                <h1>Administration</h1>
                <p>Manage your ParkFlow system, configuration and business data.</p>
            </div>

            @if ($user)
                <div class="admin-user-badge">

                    <div class="admin-user-avatar">
                        {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                    </div>

                    <div>
                        <div class="admin-user-name">
                            {{ $user->name ?? 'User' }}
                        </div>

                        <div class="admin-user-role">
                            ParkFlow Administrator
                        </div>
                    </div>

                </div>
            @endif

        </div>

        <div class="admin-stats">

            <div class="admin-stat">
                <div class="admin-stat-icon">
                    <i class="fa-solid fa-users"></i>
                </div>

                <div class="admin-stat-value">
                    {{ $stats['users'] }}
                </div>

                <div class="admin-stat-label">
                    System Users
                </div>
            </div>

            <div class="admin-stat">
                <div class="admin-stat-icon">
                    <i class="fa-solid fa-location-dot"></i>
                </div>

                <div class="admin-stat-value">
                    {{ $stats['parking_locations'] }}
                </div>

                <div class="admin-stat-label">
                    Parking Locations
                </div>
            </div>

            <div class="admin-stat">
                <div class="admin-stat-icon">
                    <i class="fa-solid fa-square-parking"></i>
                </div>

                <div class="admin-stat-value">
                    {{ $stats['parking_spots'] }}
                </div>

                <div class="admin-stat-label">
                    Parking Spots
                </div>
            </div>

            <div class="admin-stat">
                <div class="admin-stat-icon">
                    <i class="fa-solid fa-car"></i>
                </div>

                <div class="admin-stat-value">
                    {{ $stats['vehicles'] }}
                </div>

                <div class="admin-stat-label">
                    Registered Vehicles
                </div>
            </div>

        </div>

        <div class="admin-section-title">
            <h2>Management</h2>
            <p>Access the core ParkFlow management modules.</p>
        </div>

        <div class="admin-modules">

            @foreach ($modules as $module)
                @if ($module['route'] === '#')
                    <a href="#" class="admin-module">
                    @else
                        <a href="{{ route($module['route']) }}" class="admin-module">
                @endif

                <div class="admin-module-top">

                    <div class="admin-module-icon">
                        <i class="fa-solid {{ $module['icon'] }}"></i>
                    </div>

                    <div class="admin-module-count">
                        {{ $module['count'] }}
                    </div>

                </div>

                <h3>{{ $module['title'] }}</h3>

                <p>
                    {{ $module['description'] }}
                </p>

                <div class="admin-module-footer">
                    <span>Manage</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </div>

                </a>
            @endforeach

        </div>

    </div>
@endsection
