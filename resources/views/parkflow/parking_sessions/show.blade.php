@extends('parkflow.layouts.app')

@section('title', 'Parking Session Details')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_session/show_page/parking_session_base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_session/show_page/parking_session_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_session/show_page/parking_session_vehicle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_session/show_page/parking_session_details.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_session/show_page/parking_session_payment.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_session/show_page/parking_session_resp.css') }}">
        <div class="session-show-header">

            <div class="session-show-heading">

                <a href="{{ route('parking_sessions.index') }}" class="session-back-btn">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>

                <div>
                    <div class="session-breadcrumb">
                        Parking Sessions
                        <i class="fa-solid fa-chevron-right"></i>
                        Session #{{ $parkingSession->id }}
                    </div>

                    <h1>Parking Session</h1>

                    <p>
                        Complete details and activity for this parking session.
                    </p>
                </div>

            </div>

            <div class="session-header-actions">

                <span class="session-show-status {{ $sessionData['status_class'] }}">
                    <i class="{{ $sessionData['status_icon'] }}"></i>
                    {{ $sessionData['status'] }}
                </span>

            </div>

        </div>

        <div class="session-show-grid">

            <div class="session-main-column">

                <div class="session-vehicle-card">

                    <div class="vehicle-card-top">

                        <div class="vehicle-main-icon">
                            <i class="{{ $sessionData['vehicle_icon'] }}"></i>
                        </div>

                        <div class="vehicle-main-info">

                            <span class="vehicle-label">
                                Vehicle
                            </span>

                            <h2>
                                {{ $sessionData['vehicle_number'] }}
                            </h2>

                            <span class="vehicle-type">
                                {{ $sessionData['vehicle_type'] }}
                            </span>

                        </div>

                        <div class="vehicle-session-number">
                            <span>SESSION</span>
                            <strong>#{{ $parkingSession->id }}</strong>
                        </div>

                    </div>

                    <div class="vehicle-card-divider"></div>

                    <div class="vehicle-summary">

                        <div class="summary-item">

                            <span class="summary-icon">
                                <i class="fa-solid fa-location-dot"></i>
                            </span>

                            <div>
                                <span>Parking Spot</span>
                                <strong>{{ $sessionData['spot_number'] }}</strong>
                            </div>

                        </div>

                        <div class="summary-item">

                            <span class="summary-icon">
                                <i class="fa-solid fa-building"></i>
                            </span>

                            <div>
                                <span>Location</span>
                                <strong>{{ $sessionData['location_name'] }}</strong>
                            </div>

                        </div>

                        <div class="summary-item">

                            <span class="summary-icon">
                                <i class="fa-regular fa-clock"></i>
                            </span>

                            <div>
                                <span>Duration</span>
                                <strong>{{ $sessionData['duration'] }}</strong>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="session-details-card">

                    <div class="session-card-heading">

                        <div>
                            <h3>Session Timeline</h3>
                            <p>Vehicle entry and exit activity</p>
                        </div>

                        <span class="card-heading-icon">
                            <i class="fa-solid fa-timeline"></i>
                        </span>

                    </div>

                    <div class="session-timeline">

                        <div class="timeline-item completed">

                            <div class="timeline-marker">
                                <i class="fa-solid fa-right-to-bracket"></i>
                            </div>

                            <div class="timeline-content">

                                <span class="timeline-label">
                                    Vehicle Entry
                                </span>

                                <strong>
                                    {{ $sessionData['entry_time'] }}
                                </strong>

                                <span>
                                    {{ $sessionData['entry_date'] }}
                                </span>

                            </div>

                        </div>

                        <div class="timeline-line"></div>

                        <div
                            class="timeline-item {{ $sessionData['status_class'] === 'completed' ? 'completed' : 'current' }}">

                            <div class="timeline-marker">
                                <i class="fa-solid fa-right-from-bracket"></i>
                            </div>

                            <div class="timeline-content">

                                <span class="timeline-label">
                                    Vehicle Exit
                                </span>

                                <strong>
                                    {{ $sessionData['exit_time'] }}
                                </strong>

                                <span>
                                    {{ $sessionData['exit_date'] }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="session-details-card">

                    <div class="session-card-heading">

                        <div>
                            <h3>Parking Information</h3>
                            <p>Assigned parking location details</p>
                        </div>

                        <span class="card-heading-icon">
                            <i class="fa-solid fa-square-parking"></i>
                        </span>

                    </div>

                    <div class="details-grid">

                        <div class="detail-item">
                            <span>Parking Location</span>
                            <strong>{{ $sessionData['location_name'] }}</strong>
                        </div>

                        <div class="detail-item">
                            <span>Parking Spot</span>
                            <strong>{{ $sessionData['spot_number'] }}</strong>
                        </div>

                        <div class="detail-item">
                            <span>Session Status</span>
                            <strong>{{ $sessionData['status'] }}</strong>
                        </div>

                        <div class="detail-item">
                            <span>Session ID</span>
                            <strong>#{{ $parkingSession->id }}</strong>
                        </div>

                    </div>

                </div>

            </div>

            <div class="session-side-column">

                <div class="session-customer-card">

                    <div class="session-card-heading">

                        <div>
                            <h3>Customer</h3>
                            <p>Vehicle owner information</p>
                        </div>

                        <span class="card-heading-icon">
                            <i class="fa-solid fa-user"></i>
                        </span>

                    </div>

                    <div class="customer-profile">

                        <div class="customer-avatar">
                            <i class="fa-solid fa-user"></i>
                        </div>

                        <div>
                            <strong>{{ $sessionData['customer_name'] }}</strong>

                            @if ($sessionData['customer_phone'])
                                <span>
                                    {{ $sessionData['customer_phone'] }}
                                </span>
                            @else
                                <span>
                                    No phone number
                                </span>
                            @endif
                        </div>

                    </div>

                </div>

                <div class="session-payment-card">

                    <div class="session-card-heading">

                        <div>
                            <h3>Payment</h3>
                            <p>Parking payment information</p>
                        </div>

                        <span class="card-heading-icon">
                            <i class="fa-solid fa-wallet"></i>
                        </span>

                    </div>

                    <div class="payment-total">

                        <span>Total Amount</span>

                        <strong>
                            ৳{{ $sessionData['amount'] }}
                        </strong>

                    </div>

                    <div class="payment-details">
                        <div>
                            <span>Payment Method</span>
                            <strong>{{ $sessionData['payment_method'] }}</strong>
                        </div>

                        <div>
                            <span>Payment Status</span>
                            <strong>{{ $sessionData['payment_status'] }}</strong>
                        </div>

                        <div>
                            <span>Transaction ID</span>
                            <strong>{{ $sessionData['transaction_id'] }}</strong>
                        </div>
                    </div>
                </div>

                <div class="session-actions-card">
                    <a href="{{ route('parking_sessions.index') }}" class="session-secondary-action">
                        <i class="fa-solid fa-arrow-left"></i>
                        Back to Sessions
                    </a>
                </div>
            </div>
        </div>
@endsection
