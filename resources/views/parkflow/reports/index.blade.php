@extends('parkflow.layouts.app')

@section('title', 'Reports Page')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/report_page/report_base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/report_page/report_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/report_page/report_filter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/report_page/report_stats.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/report_page/report_panels.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/report_page/report_table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/report_page/report_responsive.css') }}">
@endpush

@section('content')
    {{-- Header Part --}}
    @include('parkflow.reports.partials.header')
    {{-- Filter Part --}}
    @include('parkflow.reports.partials.part_1')
    {{-- Report Period Part --}}
    @include('parkflow.reports.partials.part_2')
    {{-- Stat Part --}}
    @include('parkflow.reports.partials.part_3')
    <div class="report-content-grid">
        <div class="report-panel report-panel-large">
            <div class="report-panel-header">
                <div>
                    <h2>Daily Revenue</h2>
                    <p>Revenue generated during the selected period.</p>
                </div>
                <div class="report-panel-icon">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
            </div>

            @if ($dailyRevenue->count())
                <div class="daily-revenue-list">
                    @foreach ($dailyRevenue as $day)
                        <div class="daily-revenue-row">
                            <div class="daily-revenue-date">
                                <strong>{{ $day->day }}</strong>
                                <span>{{ $day->month }}</span>
                            </div>

                            <div class="daily-revenue-bar-wrapper">
                                <div class="daily-revenue-bar">
                                    <span style="width:{{ $day->bar_width }}%"></span>
                                </div>
                                <small>{{ $day->transactions }} transactions</small>
                            </div>

                            <div class="daily-revenue-amount">
                                ৳{{ $day->revenue }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="report-empty">
                    <i class="fa-solid fa-chart-line"></i>
                    <strong>No revenue data</strong>
                    <span>No paid transactions were recorded during this period.</span>
                </div>
            @endif
        </div>

        <div class="report-panel">
            <div class="report-panel-header">
                <div>
                    <h2>Session Status</h2>
                    <p>Parking session breakdown.</p>
                </div>
                <div class="report-panel-icon">
                    <i class="fa-solid fa-chart-pie"></i>
                </div>
            </div>

            <div class="status-list">
                @foreach ($sessionStatusRows as $status)
                    <div class="status-row">
                        <div>
                            <span class="status-dot {{ $status['class'] }}"></span>
                            {{ $status['label'] }}
                        </div>
                        <strong>{{ $status['count'] }}</strong>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="report-content-grid">
        <div class="report-panel">
            <div class="report-panel-header">
                <div>
                    <h2>Vehicle Types</h2>
                    <p>Vehicles entering the parking system.</p>
                </div>
                <div class="report-panel-icon">
                    <i class="fa-solid fa-car"></i>
                </div>
            </div>

            @if ($vehicleTypes->count())
                <div class="breakdown-list">
                    @foreach ($vehicleTypes as $type => $count)
                        <div class="breakdown-row">
                            <div class="breakdown-name">
                                <div class="breakdown-icon">
                                    @if (strtolower($type) === 'motorcycle')
                                        <i class="fa-solid fa-motorcycle"></i>
                                    @elseif(strtolower($type) === 'cng')
                                        <i class="fa-solid fa-car-side"></i>
                                    @elseif(strtolower($type) === 'microbus')
                                        <i class="fa-solid fa-van-shuttle"></i>
                                    @else
                                        <i class="fa-solid fa-car"></i>
                                    @endif
                                </div>
                                <span>{{ $type }}</span>
                            </div>
                            <strong>{{ number_format($count) }}</strong>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="mini-empty">
                    <i class="fa-solid fa-car"></i>
                    No vehicle data available.
                </div>
            @endif
        </div>

        <div class="report-panel">
            <div class="report-panel-header">
                <div>
                    <h2>Payment Methods</h2>
                    <p>Payment collection breakdown.</p>
                </div>
                <div class="report-panel-icon">
                    <i class="fa-solid fa-wallet"></i>
                </div>
            </div>

            @if ($paymentMethods->count())
                <div class="payment-method-list">
                    @foreach ($paymentMethods as $payment)
                        <div class="payment-method-row">
                            <div class="payment-method-info">
                                <div class="payment-method-icon {{ strtolower($payment->payment_method) }}">
                                    @if (strtolower($payment->payment_method) === 'cash')
                                        <i class="fa-solid fa-money-bill-wave"></i>
                                    @elseif(strtolower($payment->payment_method) === 'card')
                                        <i class="fa-solid fa-credit-card"></i>
                                    @else
                                        <i class="fa-solid fa-mobile-screen-button"></i>
                                    @endif
                                </div>

                                <div>
                                    <strong>{{ ucfirst($payment->payment_method) }}</strong>
                                    <small>{{ number_format($payment->total) }} transactions</small>
                                </div>
                            </div>

                            <strong class="payment-method-amount">
                                ৳{{ number_format($payment->amount, 2) }}
                            </strong>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="mini-empty">
                    <i class="fa-solid fa-wallet"></i>
                    No payment data available.
                </div>
            @endif
        </div>

    </div>

    <div class="report-panel location-panel">
        <div class="report-panel-header">
            <div>
                <h2>Location Performance</h2>
                <p>Parking activity by location.</p>
            </div>
            <div class="report-panel-icon">
                <i class="fa-solid fa-location-dot"></i>
            </div>
        </div>

        @if ($locationPerformance->count())
            <div class="report-table-wrapper">
                <table class="report-table">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Parking Location</th>
                            <th>Total Sessions</th>
                            <th>Completed</th>
                            <th>Active</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($locationPerformance as $location => $data)
                            <tr>
                                <td>
                                    <span class="report-sl">{{ $loop->iteration }}</span>
                                </td>
                                <td>
                                    <div class="location-name">
                                        <div class="location-table-icon">
                                            <i class="fa-solid fa-location-dot"></i>
                                        </div>
                                        <strong>{{ $location }}</strong>
                                    </div>
                                </td>
                                <td>
                                    <strong>{{ number_format($data['sessions']) }}</strong>
                                </td>
                                <td>
                                    <span class="table-status completed">
                                        {{ number_format($data['completed']) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="table-status active">
                                        {{ number_format($data['active']) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="report-empty">
                <i class="fa-solid fa-location-dot"></i>
                <strong>No location data</strong>
                <span>No parking sessions were recorded during this period.</span>
            </div>
        @endif
    </div>

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
@endsection
