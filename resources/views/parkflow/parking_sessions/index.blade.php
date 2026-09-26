@extends('parkflow.layouts.app')

@section('title', 'Parking Sessions')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_session/index_page/parking_session_base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_session/index_page/parking_session_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_session/index_page/parking_session_stats.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_session/index_page/parking_session_filter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_session/index_page/parking_session_table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_session/index_page/parking_session_status.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_session/index_page/parking_session_pagination.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_session/index_page/parking_session_resp.css') }}">
    <div class="sessions-header">
        <div class="sessions-heading">
            <div class="sessions-heading-icon">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </div>
            <div>
                <h1>Parking Sessions</h1>
                <p>Track vehicle entries, active stays and completed parking sessions.</p>
            </div>
        </div>

        <div class="session-actions">
            <a href="{{ route('vehicle_entries.index') }}" class="session-action-btn primary">
                <i class="fa-solid fa-right-to-bracket"></i>
                Vehicle Entry
            </a>
        </div>
    </div>

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

    <form method="GET" action="{{ route('parking_sessions.index') }}" class="session-toolbar">

        <div class="session-search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Search vehicle, customer or gate...">
        </div>

        <select name="status" class="session-filter">
            <option value="">All Sessions</option>
            <option value="active" @selected(request('status') === 'active')>Active</option>
            <option value="completed" @selected(request('status') === 'completed')>Completed</option>
            <option value="cancelled" @selected(request('status') === 'cancelled')>Cancelled</option>
        </select>

        <button type="submit" class="session-filter-btn">
            <i class="fa-solid fa-filter me-1"></i>
            Filter
        </button>

        @if (request()->hasAny(['search', 'status']))
            <a href="{{ route('parking_sessions.index') }}" class="session-clear-btn">
                Clear
            </a>
        @endif

    </form>

    <div class="sessions-card">

        <div class="sessions-card-header">

            <div>
                <div class="sessions-card-title">Session Activity</div>
                <div class="sessions-card-subtitle">
                    Recent vehicle parking activity
                </div>
            </div>

            <div class="session-count">
                {{ $parkingSessions->total() }} Sessions
            </div>

        </div>

        @if ($parkingSessions->count())

            <div class="sessions-table-wrap">

                <table class="sessions-table">

                    <thead>
                        <tr>
                            <th>Vehicle</th>
                            <th>Customer</th>
                            <th>Parking Spot</th>
                            <th>Entry</th>
                            <th>Duration</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($parkingSessions as $session)
                            <tr style="animation-delay:{{ $loop->index * 40 }}ms">

                                <td>
                                    <div class="vehicle-cell">

                                        <div class="vehicle-icon">
                                            @if ($session->vehicle?->type === 'motorcycle')
                                                <i class="fa-solid fa-motorcycle"></i>
                                            @elseif($session->vehicle?->type === 'microbus')
                                                <i class="fa-solid fa-van-shuttle"></i>
                                            @elseif($session->vehicle?->type === 'cng')
                                                <i class="fa-solid fa-taxi"></i>
                                            @else
                                                <i class="fa-solid fa-car-side"></i>
                                            @endif
                                        </div>

                                        <div>
                                            <div class="vehicle-number">
                                                {{ $session->vehicle?->registration_number ?? 'Unknown Vehicle' }}
                                            </div>

                                            <div class="vehicle-type">
                                                {{ $session->vehicle?->type ?? 'Vehicle' }}
                                            </div>
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    <div class="customer-name">
                                        {{ $session->customer?->name ?? 'Walk-in Customer' }}
                                    </div>

                                    @if ($session->customer?->phone)
                                        <div class="customer-phone">
                                            {{ $session->customer->phone }}
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    <span class="spot-badge">
                                        <i class="fa-solid fa-location-dot"></i>
                                        {{ $session->parkingSpot?->spot_number ?? '-' }}
                                    </span>

                                    @if ($session->parkingSpot?->parkingLocation)
                                        <div class="customer-phone">
                                            {{ $session->parkingSpot->parkingLocation->name }}
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    <div class="time-value">
                                        {{ $session->entry_time ? $session->entry_time->format('h:i A') : '-' }}
                                    </div>

                                    <div class="time-date">
                                        {{ $session->entry_time ? $session->entry_time->format('d M Y') : '-' }}
                                    </div>
                                </td>

                                <td>
                                    <span class="duration-badge">
                                        <i class="fa-regular fa-clock"></i>

                                        @if ($session->duration_minutes)
                                            {{ floor($session->duration_minutes / 60) }}h
                                            {{ $session->duration_minutes % 60 }}m
                                        @elseif($session->status === 'active' && $session->entry_time)
                                            {{ $session->entry_time->diffForHumans(now(), true) }}
                                        @else
                                            -
                                        @endif

                                    </span>
                                </td>

                                <td>
                                    <span class="amount">
                                        ৳{{ number_format($session->total_amount ?? ($session->parking_fee ?? 0), 2) }}
                                    </span>
                                </td>

                                <td>

                                    <span class="status-badge {{ $session->status }}">

                                        @if ($session->status === 'active')
                                            <i class="fa-solid fa-circle"></i>
                                        @elseif($session->status === 'completed')
                                            <i class="fa-solid fa-check"></i>
                                        @else
                                            <i class="fa-solid fa-xmark"></i>
                                        @endif

                                        {{ ucfirst($session->status) }}

                                    </span>

                                </td>

                                <td>
                                    <a href="{{ route('parking_sessions.show', $session) }}" class="session-view-btn"
                                        title="View Session">
                                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                    </a>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

            @if ($parkingSessions->hasPages())
                <div class="session-pagination">
                    {{ $parkingSessions->links() }}
                </div>
            @endif
        @else
            <div class="empty-sessions">
                <div class="empty-sessions-icon">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </div>
                <h3>No parking sessions found</h3>
                <p>
                    There are no sessions matching your current filters.
                </p>
            </div>
        @endif
    </div>
    <script src="{{ asset('js/parkflow/parking_sessions.js') }}"></script>
@endsection
