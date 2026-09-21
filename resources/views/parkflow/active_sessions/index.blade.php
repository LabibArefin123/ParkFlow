@extends('parkflow.layouts.app')

@section('title','Active Sessions')

@section('content')
<link rel="stylesheet" href="{{ asset('css/custom_backend/active_sessions/active_sessions_layout.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom_backend/active_sessions/active_sessions_header.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom_backend/active_sessions/active_sessions_stats.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom_backend/active_sessions/active_sessions_filter.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom_backend/active_sessions/active_sessions_table.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom_backend/active_sessions/active_sessions_empty.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom_backend/active_sessions/active_sessions_responsive.css') }}">
<div class="active-sessions-page">
    <div class="active-session-header">
        <div>
            <div class="active-session-eyebrow">
                <i class="fas fa-clock"></i>
                PARKING OPERATIONS
            </div>

            <h1>Active Sessions</h1>

            <p>
                Monitor vehicles currently parked across your parking locations.
            </p>
        </div>

        <div class="live-status">
            <span></span>
            Live Sessions
        </div>

    </div>

    <div class="session-stats">

        <div class="session-stat-card">
            <div class="session-stat-icon active">
                <i class="fas fa-car"></i>
            </div>

            <div>
                <span>Active Sessions</span>
                <strong>{{ $totalActive }}</strong>
                <small>Currently parked</small>
            </div>
        </div>

        <div class="session-stat-card">
            <div class="session-stat-icon entry">
                <i class="fas fa-right-to-bracket"></i>
            </div>

            <div>
                <span>Today's Entries</span>
                <strong>{{ $todayEntries }}</strong>
                <small>Vehicles entered today</small>
            </div>
        </div>

        <div class="session-stat-card">
            <div class="session-stat-icon long">
                <i class="fas fa-hourglass-half"></i>
            </div>

            <div>
                <span>Long Stay</span>
                <strong>{{ $longStayCount }}</strong>
                <small>Over 6 hours</small>
            </div>
        </div>

    </div>

    <div class="sessions-panel">

        <div class="sessions-panel-header">

            <div>
                <span class="panel-kicker">CURRENT PARKING</span>
                <h2>Active Parking Sessions</h2>
                <p>Vehicles that have not completed their parking session.</p>
            </div>

            <div class="active-count">
                <i class="fas fa-circle"></i>
                {{ $totalActive }} Active
            </div>

        </div>

        <form method="GET" action="{{ route('sessions.active') }}" class="session-filters">

            <div class="session-search">
                <i class="fas fa-magnifying-glass"></i>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search vehicle, customer, phone or parking spot..."
                >
            </div>

            <select name="vehicle_type" class="session-select">
                <option value="">All Vehicles</option>

                @foreach($vehicleTypes as $type)
                    <option value="{{ $type }}" @selected(request('vehicle_type')===$type)>
                        {{ ucfirst($type) }}
                    </option>
                @endforeach
            </select>

            <select name="location" class="session-select">
                <option value="">All Locations</option>

                @foreach($locations as $location)
                    <option value="{{ $location->id }}" @selected(request('location')==$location->id)>
                        {{ $location->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="filter-btn">
                <i class="fas fa-filter"></i>
                Filter
            </button>

            @if(request()->hasAny(['search','vehicle_type','location']))
                <a href="{{ route('sessions.active') }}" class="clear-filter">
                    <i class="fas fa-xmark"></i>
                </a>
            @endif

        </form>

        @if($activeSessions->count())

            <div class="sessions-table-wrapper">

                <table class="active-sessions-table">

                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Vehicle</th>
                            <th>Parking Location</th>
                            <th>Spot</th>
                            <th>Customer</th>
                            <th>Entry Time</th>
                            <th>Duration</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($activeSessions as $session)

                            @php
                                $entryTime=$session->entry_time;
                                $durationMinutes=$entryTime
                                    ? $entryTime->diffInMinutes(now())
                                    : 0;
                                $durationHours=floor($durationMinutes/60);
                                $durationRemaining=$durationMinutes%60;
                                $isLongStay=$durationMinutes>=360;
                            @endphp

                            <tr>

                                <td>
                                    <span class="session-sl">
                                        {{ $loop->iteration }}
                                    </span>
                                </td>

                                <td>
                                    <div class="vehicle-cell">

                                        <div class="vehicle-cell-icon">
                                            @if(strtolower($session->vehicle?->type??'')==='motorcycle')
                                                <i class="fas fa-motorcycle"></i>
                                            @else
                                                <i class="fas fa-car-side"></i>
                                            @endif
                                        </div>

                                        <div>
                                            <strong>
                                                {{ $session->vehicle?->registration_number ?? 'Unknown' }}
                                            </strong>

                                            <small>
                                                {{ ucfirst($session->vehicle?->type ?? 'Vehicle') }}
                                            </small>
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    <div class="location-cell">
                                        <strong>
                                            {{ $session->parkingSpot?->parkingLocation?->name ?? '-' }}
                                        </strong>

                                        <small>
                                            {{ $session->parkingSpot?->parkingLocation?->city ?? '' }}
                                        </small>
                                    </div>
                                </td>

                                <td>
                                    <span class="spot-badge">
                                        {{ $session->parkingSpot?->spot_number ?? '-' }}
                                    </span>
                                </td>

                                <td>
                                    <div class="customer-cell">

                                        <strong>
                                            {{ $session->customer?->name ?? 'Walk-in Customer' }}
                                        </strong>

                                        @if($session->customer?->phone)
                                            <small>
                                                {{ $session->customer->phone }}
                                            </small>
                                        @endif

                                    </div>
                                </td>

                                <td>
                                    <div class="entry-time-cell">

                                        <strong>
                                            {{ $entryTime?->format('h:i A') ?? '-' }}
                                        </strong>

                                        <small>
                                            {{ $entryTime?->format('d M Y') ?? '-' }}
                                        </small>

                                    </div>
                                </td>

                                <td>

                                    <div class="duration-cell {{ $isLongStay?'long-stay':'' }}">

                                        <strong>
                                            {{ $durationHours }}h {{ $durationRemaining }}m
                                        </strong>

                                        @if($isLongStay)
                                            <small>
                                                <i class="fas fa-clock"></i>
                                                Long stay
                                            </small>
                                        @else
                                            <small>
                                                Active
                                            </small>
                                        @endif

                                    </div>

                                </td>

                                <td>
                                    <a
                                        href="{{ route('vehicle_exits.create',['session'=>$session->id]) }}"
                                        class="session-exit-btn"
                                    >
                                        <i class="fas fa-right-from-bracket"></i>
                                        Exit
                                    </a>
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            @if($activeSessions->hasPages())
                <div class="active-session-pagination">
                    {{ $activeSessions->links() }}
                </div>
            @endif

        @else

            <div class="sessions-empty">

                <div class="sessions-empty-icon">
                    <i class="fas fa-square-parking"></i>
                </div>

                <h3>No Active Sessions</h3>

                @if(request()->hasAny(['search','vehicle_type','location']))
                    <p>
                        No active parking session matches your current filters.
                    </p>

                    <a href="{{ route('sessions.active') }}" class="empty-action">
                        <i class="fas fa-rotate-left"></i>
                        Clear Filters
                    </a>
                @else
                    <p>
                        There are currently no vehicles parked in active sessions.
                    </p>

                    <a href="{{ route('vehicle.entry') }}" class="empty-action">
                        <i class="fas fa-car"></i>
                        Vehicle Entry
                    </a>
                @endif

            </div>

        @endif

    </div>

</div>
@endsection