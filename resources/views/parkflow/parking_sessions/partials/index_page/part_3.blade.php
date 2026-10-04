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
                                    {{ $session->vehicle?->owner_name ?? 'Walk-in Customer' }}
                                </div>

                                @if ($session->customer?->phone)
                                    <div class="customer-phone">
                                        {{ $session->vehicle->phone }}
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
