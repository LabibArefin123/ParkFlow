<div class="report-panel">
    <div class="report-panel-header">
        <div>
            <h2>Recent Completed Sessions</h2>
            <p>Latest parking sessions completed in this period.</p>
        </div>
        <a href="{{ route('parking_sessions.index') }}" class="report-view-link">
            View Sessions
            <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>

    @if ($recentSessions->count())
        <div class="report-table-wrapper">
            <table class="report-table session-report-table">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Vehicle</th>
                        <th>Location</th>
                        <th>Duration</th>
                        <th>Amount</th>
                        <th>Exit Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recentSessions as $session)
                        @php
                            $durationMinutes =
                                $session->entry_time && $session->exit_time
                                    ? $session->entry_time->diffInMinutes($session->exit_time)
                                    : 0;
                            $durationHours = floor($durationMinutes / 60);
                            $durationRemaining = $durationMinutes % 60;
                        @endphp

                        <tr>
                            <td>
                                <span class="report-sl">{{ $loop->iteration }}</span>
                            </td>

                            <td>
                                <div class="vehicle-report">
                                    <div class="vehicle-report-icon">
                                        <i class="fa-solid fa-car-side"></i>
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
                                <div class="session-location">
                                    <strong>
                                        {{ $session->parkingSpot?->parkingLocation?->name ?? 'Unknown' }}
                                    </strong>
                                    <small>
                                        Spot {{ $session->parkingSpot?->spot_number ?? '-' }}
                                    </small>
                                </div>
                            </td>

                            <td>
                                <span class="duration-badge">
                                    @if ($durationHours > 0)
                                        {{ $durationHours }}h
                                    @endif
                                    {{ $durationRemaining }}m
                                </span>
                            </td>

                            <td>
                                <strong class="report-amount">
                                    ৳{{ number_format($session->payment?->amount ?? ($session->total_amount ?? 0), 2) }}
                                </strong>
                            </td>

                            <td>
                                <div class="report-time">
                                    <strong>
                                        {{ $session->exit_time?->format('h:i A') ?? '-' }}
                                    </strong>
                                    <small>
                                        {{ $session->exit_time?->format('d M Y') ?? '-' }}
                                    </small>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="report-empty">
            <i class="fa-solid fa-file-circle-xmark"></i>
            <strong>No completed sessions</strong>
            <span>Completed sessions will appear here for the selected period.</span>
        </div>
    @endif
</div>
