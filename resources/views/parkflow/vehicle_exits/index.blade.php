@extends('parkflow.layouts.app')

@section('title', 'Vehicle Exit')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_exit/index_page/vehicle_exit_layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_exit/index_page/vehicle_exit_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_exit/index_page/vehicle_exit_summary.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_exit/index_page/vehicle_exit_card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_exit/index_page/vehicle_exit_search.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_exit/index_page/vehicle_exit_sessions.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_exit/index_page/vehicle_exit_responsive.css') }}">

    <div class="vehicle-exit-index">

        <div class="exit-index-header">
            <div>
                <div class="exit-eyebrow">
                    <i class="fas fa-right-from-bracket"></i>
                    PARKING OPERATIONS
                </div>

                <h1>Vehicle Exit</h1>

                <p>
                    Find an active parking session and complete the vehicle exit.
                </p>
            </div>

            <div class="exit-header-status">
                <span class="status-dot"></span>
                Parking Operations
            </div>
        </div>

        @if (session('success'))
            <div class="exit-alert success">
                <i class="fas fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="exit-alert error">
                <i class="fas fa-circle-exclamation"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <div class="exit-summary-grid">

            <div class="exit-summary-card">
                <div class="summary-icon active">
                    <i class="fas fa-car"></i>
                </div>

                <div>
                    <span>Active Sessions</span>
                    <strong>{{ $totalActive }}</strong>
                    <small>Vehicles currently parked</small>
                </div>
            </div>

            <div class="exit-summary-card">
                <div class="summary-icon entry">
                    <i class="fas fa-right-to-bracket"></i>
                </div>

                <div>
                    <span>Today's Entries</span>
                    <strong>{{ $todayEntries }}</strong>
                    <small>Vehicles entered today</small>
                </div>
            </div>

            <div class="exit-summary-card">
                <div class="summary-icon exit">
                    <i class="fas fa-right-from-bracket"></i>
                </div>

                <div>
                    <span>Today's Exits</span>
                    <strong>{{ $todayExits }}</strong>
                    <small>Completed exits today</small>
                </div>
            </div>

        </div>

        <div class="exit-session-card">

            <div class="exit-card-header">

                <div>
                    <span class="exit-card-label">ACTIVE PARKING</span>
                    <h2>Vehicles Ready for Exit</h2>
                    <p>Select a vehicle to continue with the exit process.</p>
                </div>

                <div class="active-session-badge">
                    <i class="fas fa-circle"></i>
                    {{ $totalActive }} Active
                </div>

            </div>

            <form method="GET" action="{{ route('vehicle_exits.index') }}" class="exit-search">

                <div class="exit-search-input">
                    <i class="fas fa-magnifying-glass"></i>

                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search registration, customer or phone...">
                </div>

                <button type="submit" class="exit-search-btn">
                    <i class="fas fa-search"></i>
                    Search
                </button>

                @if (request('search'))
                    <a href="{{ route('vehicle_exits.index') }}" class="exit-clear-btn">
                        <i class="fas fa-xmark"></i>
                        Clear
                    </a>
                @endif

            </form>

            @if ($activeSessions->count())

                <div class="exit-session-list">

                    @foreach ($activeSessions as $session)
                        <div class="exit-session-row">

                            <div class="exit-vehicle-icon">
                                @if (strtolower($session->vehicle?->type ?? '') === 'motorcycle')
                                    <i class="fas fa-motorcycle"></i>
                                @elseif(strtolower($session->vehicle?->type ?? '') === 'cng')
                                    <i class="fas fa-car-side"></i>
                                @else
                                    <i class="fas fa-car-side"></i>
                                @endif
                            </div>

                            <div class="exit-vehicle-info">

                                <strong>
                                    {{ $session->vehicle?->registration_number ?? 'Unknown Vehicle' }}
                                </strong>

                                <span>
                                    {{ ucfirst($session->vehicle?->type ?? 'Vehicle') }}
                                </span>

                            </div>

                            <div class="exit-session-detail">

                                <span class="detail-label">Parking Space</span>

                                <strong>
                                    {{ $session->parkingSpot?->spot_number ?? '-' }}
                                </strong>

                                <small>
                                    {{ $session->parkingSpot?->parkingLocation?->name ?? 'Unknown Location' }}
                                </small>

                            </div>

                            <div class="exit-session-detail">

                                <span class="detail-label">Entry Time</span>

                                <strong>
                                    {{ $session->entry_time?->format('h:i A') ?? '-' }}
                                </strong>

                                <small>
                                    {{ $session->entry_time?->format('d M Y') ?? '-' }}
                                </small>

                            </div>

                            <div class="exit-customer">

                                <span class="detail-label">Customer</span>

                                <strong>
                                    {{ $session->customer?->name ?? 'Walk-in Customer' }}
                                </strong>

                                @if ($session->customer?->phone)
                                    <small>
                                        {{ $session->customer->phone }}
                                    </small>
                                @endif

                            </div>

                            <a href="{{ route('vehicle_exits.create', ['session' => $session->id]) }}"
                                class="process-exit-btn">
                                Process Exit
                                <i class="fas fa-arrow-right"></i>
                            </a>

                        </div>
                    @endforeach

                </div>

                @if ($activeSessions->hasPages())
                    <div class="exit-pagination">
                        {{ $activeSessions->links() }}
                    </div>
                @endif
            @else
                <div class="exit-empty">

                    <div class="exit-empty-icon">
                        <i class="fas fa-square-parking"></i>
                    </div>

                    <h3>No Active Parking Sessions</h3>

                    @if (request('search'))
                        <p>
                            No active vehicle matches your search.
                        </p>

                        <a href="{{ route('vehicle_exits.index') }}" class="exit-empty-btn">
                            Clear Search
                        </a>
                    @else
                        <p>
                            All currently parked vehicles have been processed.
                        </p>

                        <a href="{{ route('vehicle.entry') }}" class="exit-empty-btn">
                            <i class="fas fa-car"></i>
                            Register Vehicle
                        </a>
                    @endif

                </div>

            @endif

        </div>

    </div>
@endsection
