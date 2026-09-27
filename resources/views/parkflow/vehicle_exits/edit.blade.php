@extends('parkflow.layouts.app')

@section('title', 'Edit Vehicle Exit')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_exit/edit_page/vehicle_exit_layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_exit/edit_page/vehicle_exit_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_exit/edit_page/vehicle_exit_session.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_exit/edit_page/vehicle_exit_payment.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_exit/edit_page/vehicle_exit_note.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_exit/edit_page/vehicle_exit_actions.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_exit/edit_page/vehicle_exit_responsive.css') }}">

    <div class="exit-create-header">
        <div>
            <div class="create-eyebrow">
                <i class="fas fa-pen-to-square"></i>
                EDIT VEHICLE EXIT
            </div>

            <h1>Vehicle Exit</h1>
            <p> Review and update the vehicle exit and payment information.</p>
        </div>

        <a href="{{ route('vehicle_exits.show', $vehicleExit) }}" class="back-exit-btn">
            <i class="fas fa-arrow-left"></i>
            Back to Exit Details
        </a>
    </div>

    @if ($errors->any())
        <div class="create-error">
            <div class="create-error-icon">
                <i class="fas fa-triangle-exclamation"></i>
            </div>

            <div>
                <strong>Unable to update vehicle exit</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form action="{{ route('vehicle_exits.update', $vehicleExit) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="exit-create-layout">
            <div class="exit-session-panel">
                <div class="create-panel-header">
                    <div>
                        <span>PARKING SESSION</span>
                        <h2>Parking Details</h2>
                    </div>

                    <div class="active-pill">
                        <i class="fas fa-circle"></i>
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
                        <strong>{{ $vehicleExit->vehicle?->owner_name ?? 'Walk-in Customer' }}</strong>
                        @if ($vehicleExit->vehicle?->phone)
                            <small>{{ $vehicleExit->vehicle->phone }}</small>
                        @endif
                    </div>
                </div>
            </div>

            <div class="exit-payment-panel">
                <div class="create-panel-header">
                    <div>
                        <span>PAYMENT</span>
                        <h2>Update Payment</h2>
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
                            value="{{ old('amount', $vehicleExit->parking_fee) }}" min="0" step="0.01">
                    </div>

                    <small>
                        Parking charge for this completed session.
                    </small>
                </div>

                <div class="payment-method-section">
                    <label>Payment Method</label>
                    <div class="payment-method-grid">
                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="cash" @checked(old('payment_method', $vehicleExit->payment?->payment_method ?? 'cash') === 'cash')>
                            <span>
                                <i class="fas fa-money-bill-wave"></i>
                                Cash
                            </span>
                        </label>

                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="bkash" @checked(old('payment_method', $vehicleExit->payment?->payment_method) === 'bkash')>
                            <span>
                                <i class="fas fa-mobile-screen-button"></i>
                                bKash
                            </span>
                        </label>

                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="nagad" @checked(old('payment_method', $vehicleExit->payment?->payment_method) === 'nagad')>
                            <span>
                                <i class="fas fa-mobile-screen-button"></i>
                                Nagad
                            </span>
                        </label>

                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="card" @checked(old('payment_method', $vehicleExit->payment?->payment_method) === 'card')>
                            <span>
                                <i class="fas fa-credit-card"></i>
                                Card
                            </span>
                        </label>
                    </div>
                </div>

                <div class="exit-note-field">
                    <label for="notes">Exit Notes</label>
                    <textarea id="notes" name="notes" rows="3" placeholder="Optional notes about this vehicle exit...">{{ old('notes', $vehicleExit->notes) }}</textarea>
                </div>

                <div class="payment-total">
                    <span>Total to Collect</span>
                    <strong>৳<span
                            id="totalAmount">{{ number_format(old('amount', $vehicleExit->parking_fee), 2) }}</span></strong>
                </div>

                <div class="exit-action-group">
                    <a href="{{ route('vehicle_exits.show', $vehicleExit) }}" class="cancel-exit-btn">
                        <i class="fas fa-xmark"></i>
                        Cancel
                    </a>

                    <button type="submit" class="complete-exit-btn">
                        <i class="fas fa-check"></i>
                        Update Vehicle Exit
                    </button>
                </div>
            </div>
        </div>
    </form>

    <script src="{{ asset('js/parkflow/vehicle_exit/edit_page/amount_update.js') }}"></script>
@endsection
