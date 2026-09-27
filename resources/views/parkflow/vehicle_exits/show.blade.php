@extends('parkflow.layouts.app')

@section('title', 'Vehicle Exit Details')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_exit/show_page/vehicle_exit_layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_exit/show_page/vehicle_exit_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_exit/show_page/vehicle_exit_session.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_exit/show_page/vehicle_exit_payment.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_exit/show_page/vehicle_exit_note.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_exit/show_page/vehicle_exit_actions.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_exit/show_page/vehicle_exit_responsive.css') }}">

    <div class="exit-create-header">
        <div>
            <div class="create-eyebrow">
                <i class="fas fa-right-from-bracket"></i>
                VEHICLE EXIT DETAILS
            </div>

            <h1>Vehicle Exit</h1>

            <p>
                Review the completed parking session and payment details.
            </p>
        </div>

        <div class="exit-header-actions">
            <a href="{{ route('vehicle_exits.edit', $vehicleExit) }}" class="edit-exit-btn">
                <i class="fas fa-pen-to-square"></i>
                Edit Exit
            </a>

            <a href="{{ route('vehicle_exits.index') }}" class="back-exit-btn">
                <i class="fas fa-arrow-left"></i>
                Back to Vehicle Exits
            </a>
        </div>
    </div>

    <div class="exit-create-layout">
        <div class="exit-session-panel">
            <div class="create-panel-header">
                <div>
                    <span>COMPLETED SESSION</span>
                    <h2>Parking Details</h2>
                </div>

                <div class="active-pill completed-pill">
                    <i class="fas fa-circle-check"></i>
                    {{ ucfirst($vehicleExit->status ?? 'Completed') }}
                </div>
            </div>

            <div class="vehicle-identity">
                <div class="vehicle-big-icon">
                    @if (strtolower($vehicleExit->vehicle?->vehicle_type ?? '') === 'motorcycle')
                        <i class="fas fa-motorcycle"></i>
                    @else
                        <i class="fas fa-car-side"></i>
                    @endif
                </div>

                <div>
                    <span>REGISTRATION NUMBER</span>
                    <h3>{{ $vehicleExit->vehicle?->registration_number ?? 'Unknown Vehicle' }}</h3>
                    <small>{{ ucfirst($vehicleExit->vehicle?->vehicle_type ?? 'Vehicle') }}</small>
                </div>
            </div>

            <div class="session-info-grid">
                <div class="session-info">
                    <span>Parking Location</span>
                    <strong>{{ $vehicleExit->parkingSpot?->parkingLocation?->name ?? '-' }}</strong>
                </div>

                <div class="session-info">
                    <span>Parking Spot</span>
                    <strong>{{ $vehicleExit->parkingSpot?->spot_number ?? '-' }}</strong>
                </div>

                <div class="session-info">
                    <span>Entry Time</span>
                    <strong>{{ $vehicleExit->entry_time?->format('d M Y') ?? '-' }}</strong>
                    <small>{{ $vehicleExit->entry_time?->format('h:i A') ?? '-' }}</small>
                </div>

                <div class="session-info">
                    <span>Exit Time</span>
                    <strong>{{ $vehicleExit->exit_time?->format('d M Y') ?? '-' }}</strong>
                    <small>{{ $vehicleExit->exit_time?->format('h:i A') ?? '-' }}</small>
                </div>

                <div class="session-info">
                    <span>Parking Duration</span>
                    <strong>{{ floor(($vehicleExit->duration_minutes ?? 0) / 60) }}
                        {{ floor(($vehicleExit->duration_minutes ?? 0) / 60) == 1 ? 'Hour' : 'Hours' }}</strong>
                    <small>{{ floor(($vehicleExit->duration_minutes ?? 0) / 60) }}h
                        {{ ($vehicleExit->duration_minutes ?? 0) % 60 }}m</small>
                </div>
            </div>

            <div class="customer-info">
                <div class="customer-info-icon">
                    <i class="fas fa-user"></i>
                </div>

                <div>
                    <span>CUSTOMER</span>
                    <strong>{{ $vehicleExit->customer?->name ?? 'Walk-in Customer' }}</strong>

                    @if ($vehicleExit->customer?->phone)
                        <small>{{ $vehicleExit->customer->phone }}</small>
                    @endif
                </div>
            </div>
        </div>

        <div class="exit-payment-panel">
            <div class="create-panel-header">
                <div>
                    <span>PAYMENT</span>
                    <h2>Payment Summary</h2>
                </div>

                <div class="payment-icon">
                    <i class="fas fa-receipt"></i>
                </div>
            </div>

            <div class="amount-box">
                <span>Parking Charge</span>

                <div class="amount-value show-amount">
                    <small>৳</small>
                    <strong>{{ number_format($vehicleExit->parking_fee ?? ($vehicleExit->payment?->amount ?? 0), 2) }}</strong>
                </div>

                <small>
                    Final parking charge collected for this session.
                </small>
            </div>

            <div class="payment-method-section">
                <label>Payment Method</label>

                <div class="payment-method-grid">
                    <div class="payment-option payment-option-static">
                        <span>
                            @if (($vehicleExit->payment?->payment_method ?? 'cash') === 'cash')
                                <i class="fas fa-money-bill-wave"></i>
                                Cash
                            @elseif (($vehicleExit->payment?->payment_method ?? '') === 'bkash')
                                <i class="fas fa-mobile-screen-button"></i>
                                bKash
                            @elseif (($vehicleExit->payment?->payment_method ?? '') === 'nagad')
                                <i class="fas fa-mobile-screen-button"></i>
                                Nagad
                            @else
                                <i class="fas fa-credit-card"></i>
                                Card
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <div class="payment-total">
                <span>Total Collected</span>
                <strong>
                    ৳{{ number_format($vehicleExit->payment?->amount ?? ($vehicleExit->parking_fee ?? 0), 2) }}
                </strong>
            </div>

            @if ($vehicleExit->notes)
                <div class="exit-note-field show-note">
                    <label>Exit Notes</label>

                    <div class="exit-note-display">
                        <i class="fas fa-note-sticky"></i>
                        <p>{{ $vehicleExit->notes }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="exit-show-actions">
        <a href="{{ route('vehicle_exits.index') }}" class="back-exit-btn">
            <i class="fas fa-arrow-left"></i>
            Back to Vehicle Exits
        </a>

        <a href="{{ route('vehicle_exits.edit', $vehicleExit) }}" class="complete-exit-btn">
            <i class="fas fa-pen-to-square"></i>
            Edit Vehicle Exit
        </a>
    </div>


@endsection
