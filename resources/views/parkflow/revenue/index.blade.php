@extends('parkflow.layouts.app')

@section('title', 'Revenue')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/revenue_page/revenue_base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/revenue_page/revenue_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/revenue_page/revenue_stats.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/revenue_page/revenue_toolbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/revenue_page/revenue_table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/revenue_page/revenue_badges.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/revenue_page/revenue_footer_responsive.css') }}">
    <div class="revenue-page">

        <div class="revenue-header">

            <div class="revenue-title">

                <div class="revenue-title-icon">
                    <i class="fa-solid fa-chart-line"></i>
                </div>

                <div>
                    <h1>Revenue</h1>
                    <p>Track parking payments and monitor your business revenue.</p>
                </div>

            </div>

            <a href="{{ route('parking_sessions.index') }}" class="revenue-action">
                <i class="fa-solid fa-clock-rotate-left"></i>
                View Parking Sessions
            </a>

        </div>

        <div class="revenue-stats">

            <div class="revenue-stat">

                <div class="revenue-stat-top">
                    <span class="revenue-stat-label">Total Revenue</span>

                    <div class="revenue-stat-icon">
                        <i class="fa-solid fa-bangladeshi-taka-sign"></i>
                    </div>
                </div>

                <div class="revenue-stat-value">
                    ৳{{ number_format($totalRevenue, 2) }}
                </div>

                <div class="revenue-stat-meta">
                    All paid parking transactions
                </div>

            </div>

            <div class="revenue-stat today">

                <div class="revenue-stat-top">
                    <span class="revenue-stat-label">Today's Revenue</span>

                    <div class="revenue-stat-icon">
                        <i class="fa-solid fa-calendar-day"></i>
                    </div>
                </div>

                <div class="revenue-stat-value">
                    ৳{{ number_format($todayRevenue, 2) }}
                </div>

                <div class="revenue-stat-meta">
                    Collected today
                </div>

            </div>

            <div class="revenue-stat month">

                <div class="revenue-stat-top">
                    <span class="revenue-stat-label">This Month</span>

                    <div class="revenue-stat-icon">
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>
                </div>

                <div class="revenue-stat-value">
                    ৳{{ number_format($monthlyRevenue, 2) }}
                </div>

                <div class="revenue-stat-meta">
                    {{ now()->format('F Y') }}
                </div>

            </div>

            <div class="revenue-stat transactions">

                <div class="revenue-stat-top">
                    <span class="revenue-stat-label">Paid Transactions</span>

                    <div class="revenue-stat-icon">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                </div>

                <div class="revenue-stat-value">
                    {{ number_format($paidCount) }}
                </div>

                <div class="revenue-stat-meta">
                    {{ $pendingCount }} pending · {{ $failedCount }} failed
                </div>

            </div>

        </div>

        <form method="GET" action="{{ route('revenue.index') }}" class="revenue-toolbar">

            <div class="revenue-search">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search transaction or vehicle...">

            </div>

            <select name="payment_method" class="revenue-filter">

                <option value="">All Payment Methods</option>

                @foreach ($paymentMethods as $method)
                    <option value="{{ $method }}" @selected(request('payment_method') === $method)>
                        {{ ucfirst($method) }}
                    </option>
                @endforeach

            </select>

            <select name="status" class="revenue-filter">

                <option value="">All Status</option>

                <option value="paid" @selected(request('status') === 'paid')>
                    Paid
                </option>

                <option value="pending" @selected(request('status') === 'pending')>
                    Pending
                </option>

                <option value="failed" @selected(request('status') === 'failed')>
                    Failed
                </option>

                <option value="cancelled" @selected(request('status') === 'cancelled')>
                    Cancelled
                </option>

            </select>

            <input type="date" name="date" value="{{ request('date') }}" class="revenue-filter">

            <button type="submit" class="revenue-filter-btn">
                <i class="fa-solid fa-filter"></i>
                Filter
            </button>

            @if (request()->hasAny(['search', 'payment_method', 'status', 'date']))
                <a href="{{ route('revenue.index') }}" class="revenue-clear">
                    Clear
                </a>
            @endif

        </form>

        <div class="revenue-card">

            <div class="revenue-card-header">

                <div>
                    <div class="revenue-card-title">
                        Payment Transactions
                    </div>

                    <div class="revenue-card-subtitle">
                        Recent parking payment records
                    </div>
                </div>

                <div class="revenue-count">
                    {{ $payments->total() }} Transactions
                </div>

            </div>

            @if ($payments->count())

                <div class="revenue-table-wrapper">

                    <table class="revenue-table">

                        <thead>
                            <tr>
                                <th>Transaction</th>
                                <th>Vehicle</th>
                                <th>Location</th>
                                <th>Payment Method</th>
                                <th>Amount</th>
                                <th>Paid At</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($payments as $payment)
                                @php
                                    $method = strtolower($payment->payment_method ?? '');
                                    $status = strtolower($payment->status ?? '');
                                @endphp

                                <tr>

                                    <td>

                                        <div class="transaction-info">

                                            <span class="transaction-id">
                                                {{ $payment->transaction_id ?? 'N/A' }}
                                            </span>

                                            <span class="transaction-number">
                                                Payment #{{ $payment->id }}
                                            </span>

                                        </div>

                                    </td>

                                    <td>

                                        <div class="vehicle-info">

                                            <div class="vehicle-icon">

                                                @if ($payment->parkingSession?->vehicle?->type === 'motorcycle')
                                                    <i class="fa-solid fa-motorcycle"></i>
                                                @elseif($payment->parkingSession?->vehicle?->type === 'cng')
                                                    <i class="fa-solid fa-taxi"></i>
                                                @else
                                                    <i class="fa-solid fa-car-side"></i>
                                                @endif

                                            </div>

                                            <div>

                                                <div class="vehicle-number">
                                                    {{ $payment->parkingSession?->vehicle?->registration_number ?? 'Unknown Vehicle' }}
                                                </div>

                                                <div class="vehicle-type">
                                                    {{ $payment->parkingSession?->vehicle?->type ?? 'Vehicle' }}
                                                </div>

                                            </div>

                                        </div>

                                    </td>

                                    <td>

                                        <div class="location-info">

                                            <span class="location-name">
                                                {{ $payment->parkingSession?->parkingSpot?->parkingLocation?->name ?? 'Main Parking' }}
                                            </span>

                                            <span class="spot-name">
                                                Spot {{ $payment->parkingSession?->parkingSpot?->spot_number ?? '-' }}
                                            </span>

                                        </div>

                                    </td>

                                    <td>

                                        <span class="method-badge {{ $method }}">

                                            @if ($method === 'cash')
                                                <i class="fa-solid fa-money-bill-wave"></i>
                                            @elseif($method === 'bkash')
                                                <i class="fa-solid fa-mobile-screen-button"></i>
                                            @elseif($method === 'nagad')
                                                <i class="fa-solid fa-mobile-screen-button"></i>
                                            @elseif($method === 'card')
                                                <i class="fa-solid fa-credit-card"></i>
                                            @else
                                                <i class="fa-solid fa-wallet"></i>
                                            @endif

                                            {{ ucfirst($payment->payment_method ?? 'Unknown') }}

                                        </span>

                                    </td>

                                    <td>

                                        <span class="payment-amount">
                                            ৳{{ number_format($payment->amount, 2) }}
                                        </span>

                                    </td>

                                    <td>

                                        <div class="payment-date">

                                            <strong>
                                                {{ $payment->paid_at?->format('h:i A') ?? '-' }}
                                            </strong>

                                            <span>
                                                {{ $payment->paid_at?->format('d M Y') ?? '-' }}
                                            </span>

                                        </div>

                                    </td>

                                    <td>

                                        <span class="status-badge {{ $status }}">

                                            @if ($status === 'paid')
                                                <i class="fa-solid fa-circle-check"></i>
                                            @elseif($status === 'pending')
                                                <i class="fa-solid fa-clock"></i>
                                            @else
                                                <i class="fa-solid fa-circle-xmark"></i>
                                            @endif

                                            {{ ucfirst($payment->status ?? 'Unknown') }}

                                        </span>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

                @if ($payments->hasPages())
                    <div class="revenue-pagination">
                        {{ $payments->links() }}
                    </div>
                @endif
            @else
                <div class="revenue-empty">

                    <div class="revenue-empty-icon">
                        <i class="fa-solid fa-receipt"></i>
                    </div>

                    <h3>No payment transactions found</h3>

                    <p>
                        Try changing your search or filter options.
                    </p>

                </div>

            @endif

        </div>

    </div>

@endsection
