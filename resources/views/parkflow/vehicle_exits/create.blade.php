@extends('parkflow.layouts.app')

@section('title', 'Complete Vehicle Exit')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_exit/create_page/vehicle_exit_layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_exit/create_page/vehicle_exit_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_exit/create_page/vehicle_exit_session.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_exit/create_page/vehicle_exit_payment.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_exit/create_page/vehicle_exit_note.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_exit/create_page/vehicle_exit_actions.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_exit/create_page/vehicle_exit_responsive.css') }}">

    <div class="vehicle-exit-create">

        <div class="exit-create-header">

            <div>
                <div class="create-eyebrow">
                    <i class="fas fa-right-from-bracket"></i>
                    COMPLETE PARKING SESSION
                </div>

                <h1>Vehicle Exit</h1>

                <p>
                    Review the parking session and collect the final payment.
                </p>
            </div>

            <a href="{{ route('vehicle_exits.index') }}" class="back-exit-btn">
                <i class="fas fa-arrow-left"></i>
                Back to Active Sessions
            </a>

        </div>

        @if ($errors->any())

            <div class="create-error">

                <div class="create-error-icon">
                    <i class="fas fa-triangle-exclamation"></i>
                </div>

                <div>
                    <strong>Unable to complete exit</strong>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

            </div>

        @endif

        <form action="{{ route('vehicle_exits.store') }}" method="POST">
            @csrf

            <input type="hidden" name="parking_session_id" value="{{ $parkingSession->id }}">

            <div class="exit-create-layout">

                <div class="exit-session-panel">

                    <div class="create-panel-header">
                        <div>
                            <span>ACTIVE SESSION</span>
                            <h2>Parking Details</h2>
                        </div>

                        <div class="active-pill">
                            <i class="fas fa-circle"></i>
                            Active
                        </div>
                    </div>

                    <div class="vehicle-identity">

                        <div class="vehicle-big-icon">
                            @if (strtolower($parkingSession->vehicle?->type ?? '') === 'motorcycle')
                                <i class="fas fa-motorcycle"></i>
                            @else
                                <i class="fas fa-car-side"></i>
                            @endif
                        </div>

                        <div>
                            <span>REGISTRATION NUMBER</span>

                            <h3>
                                {{ $parkingSession->vehicle?->registration_number ?? 'Unknown Vehicle' }}
                            </h3>

                            <small>
                                {{ ucfirst($parkingSession->vehicle?->type ?? 'Vehicle') }}
                            </small>
                        </div>

                    </div>

                    <div class="session-info-grid">

                        <div class="session-info">
                            <span>Parking Location</span>

                            <strong>
                                {{ $parkingSession->parkingSpot?->parkingLocation?->name ?? '-' }}
                            </strong>
                        </div>

                        <div class="session-info">
                            <span>Parking Spot</span>

                            <strong>
                                {{ $parkingSession->parkingSpot?->spot_number ?? '-' }}
                            </strong>
                        </div>

                        <div class="session-info">
                            <span>Entry Time</span>

                            <strong>
                                {{ $parkingSession->entry_time?->format('d M Y') ?? '-' }}
                            </strong>

                            <small>
                                {{ $parkingSession->entry_time?->format('h:i A') ?? '-' }}
                            </small>
                        </div>

                        <div class="session-info">
                            <span>Parking Duration</span>

                            <strong>
                                {{ $durationHours }} {{ $durationHours == 1 ? 'Hour' : 'Hours' }}
                            </strong>

                            <small>
                                {{ floor($durationMinutes / 60) }}h {{ $durationMinutes % 60 }}m
                            </small>
                        </div>

                    </div>

                    <div class="customer-info">

                        <div class="customer-info-icon">
                            <i class="fas fa-user"></i>
                        </div>

                        <div>
                            <span>CUSTOMER</span>

                            <strong>
                                {{ $parkingSession->customer?->name ?? 'Walk-in Customer' }}
                            </strong>

                            @if ($parkingSession->customer?->phone)
                                <small>
                                    {{ $parkingSession->customer->phone }}
                                </small>
                            @endif
                        </div>

                    </div>

                </div>

                <div class="exit-payment-panel">

                    <div class="create-panel-header">
                        <div>
                            <span>PAYMENT</span>
                            <h2>Complete Payment</h2>
                        </div>

                        <div class="payment-icon">
                            <i class="fas fa-receipt"></i>
                        </div>
                    </div>

                    <div class="amount-box">

                        <span>Parking Charge</span>

                        <div class="amount-value">
                            <small>৳</small>
                            <input type="number" name="amount" id="amount"
                                value="{{ old('amount', $estimatedAmount) }}" min="0" step="0.01" required>
                        </div>

                        <small>
                            Estimated at ৳{{ number_format($ratePerHour, 2) }} / hour
                        </small>

                    </div>

                    <div class="payment-method-section">

                        <label>Payment Method</label>

                        <div class="payment-method-grid">

                            <label class="payment-option">
                                <input type="radio" name="payment_method" value="cash" @checked(old('payment_method', 'cash') === 'cash')>

                                <span>
                                    <i class="fas fa-money-bill-wave"></i>
                                    Cash
                                </span>
                            </label>

                            <label class="payment-option">
                                <input type="radio" name="payment_method" value="bkash" @checked(old('payment_method') === 'bkash')>

                                <span>
                                    <i class="fas fa-mobile-screen-button"></i>
                                    bKash
                                </span>
                            </label>

                            <label class="payment-option">
                                <input type="radio" name="payment_method" value="nagad" @checked(old('payment_method') === 'nagad')>

                                <span>
                                    <i class="fas fa-mobile-screen-button"></i>
                                    Nagad
                                </span>
                            </label>

                            <label class="payment-option">
                                <input type="radio" name="payment_method" value="card" @checked(old('payment_method') === 'card')>

                                <span>
                                    <i class="fas fa-credit-card"></i>
                                    Card
                                </span>
                            </label>

                        </div>

                    </div>

                    <div class="exit-note-field">

                        <label for="notes">Exit Notes</label>

                        <textarea id="notes" name="notes" rows="3" placeholder="Optional notes about this vehicle exit...">{{ old('notes') }}</textarea>

                    </div>

                    <div class="payment-total">

                        <span>Total to Collect</span>

                        <strong>
                            ৳<span id="totalAmount">{{ number_format($estimatedAmount, 2) }}</span>
                        </strong>

                    </div>

                    <button type="submit" class="complete-exit-btn">
                        <i class="fas fa-check"></i>
                        Complete Vehicle Exit
                    </button>

                </div>

            </div>

        </form>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const amount = document.getElementById('amount');
            const totalAmount = document.getElementById('totalAmount');

            function updateAmount() {
                const value = parseFloat(amount.value) || 0;
                totalAmount.textContent = value.toFixed(2);
            }

            amount.addEventListener('input', updateAmount);
            updateAmount();
        });
    </script>
@endsection
