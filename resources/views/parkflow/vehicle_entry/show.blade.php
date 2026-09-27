@extends('parkflow.layouts.app')

@section('title', 'Vehicle Entry Details')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_entry/show_page/vehicle_entry_layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_entry/show_page/vehicle_entry_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_entry/show_page/vehicle_entry_details.css') }}">
    <div class="vehicle-entry-page">
        <div class="vehicle-entry-header">
            <div>
                <div class="vehicle-entry-eyebrow">
                    <i class="fas fa-car-side"></i>
                    VEHICLE ENTRY DETAILS
                </div>
                <h1>{{ $vehicleEntry->registration_number }}</h1>
                <p>View complete vehicle entry and parking assignment information.</p>
            </div>
            <div class="vehicle-entry-header-actions">
                <a href="{{ route('vehicle_entries.edit', $vehicleEntry) }}" class="entry-submit-btn">
                    <i class="fas fa-pen-to-square"></i>
                    Edit Entry
                </a>
                <a href="{{ route('vehicle_entries.index') }}" class="entry-back-btn">
                    <i class="fas fa-arrow-left"></i>
                    Back to Vehicle Entry
                </a>
            </div>
        </div>
        <div class="vehicle-show-grid">
            <div class="vehicle-show-card vehicle-show-main">
                <div class="vehicle-show-card-header">
                    <div class="form-section-icon">
                        <i class="fas fa-car"></i>
                    </div>
                    <div>
                        <span>VEHICLE INFORMATION</span>
                        <h2>Vehicle Details</h2>
                    </div>
                </div>
                <div class="vehicle-show-highlight">
                    <div class="vehicle-show-avatar">
                        <i class="fas fa-car-side"></i>
                    </div>
                    <div>
                        <strong>{{ $vehicleEntry->registration_number }}</strong>
                        <span>{{ ucfirst($vehicleEntry->type) }}</span>
                    </div>
                </div>
                <div class="vehicle-detail-grid">
                    <div class="vehicle-detail-item">
                        <span>Registration Number</span>
                        <strong>{{ $vehicleEntry->registration_number }}</strong>
                    </div>
                    <div class="vehicle-detail-item">
                        <span>Vehicle Type</span>
                        <strong>{{ ucfirst($vehicleEntry->type) }}</strong>
                    </div>
                    <div class="vehicle-detail-item">
                        <span>Customer Name</span>
                        <strong>{{ $vehicleEntry->customer_name ?: 'Not provided' }}</strong>
                    </div>
                    <div class="vehicle-detail-item">
                        <span>Phone Number</span>
                        <strong>{{ $vehicleEntry->customer_phone ?: 'Not provided' }}</strong>
                    </div>
                </div>
            </div>
            <div class="vehicle-show-card">
                <div class="vehicle-show-card-header">
                    <div class="form-section-icon location">
                        <i class="fas fa-location-dot"></i>
                    </div>
                    <div>
                        <span>PARKING ASSIGNMENT</span>
                        <h2>Parking Space</h2>
                    </div>
                </div>
                <div class="parking-detail-box">
                    <div class="parking-detail-icon">
                        <i class="fas fa-square-parking"></i>
                    </div>
                    <div>
                        <span>Parking Spot</span>
                        <strong>{{ $vehicleEntry->parkingSpot?->spot_number ?? 'Not assigned' }}</strong>
                    </div>
                </div>
                <div class="vehicle-detail-grid">
                    <div class="vehicle-detail-item">
                        <span>Parking Location</span>
                        <strong>{{ $vehicleEntry->parkingSpot?->parkingLocation?->name ?? 'Not assigned' }}</strong>
                    </div>
                    <div class="vehicle-detail-item">
                        <span>City</span>
                        <strong>{{ $vehicleEntry->parkingSpot?->parkingLocation?->city ?? 'Not available' }}</strong>
                    </div>
                    <div class="vehicle-detail-item">
                        <span>Floor</span>
                        <strong>{{ $vehicleEntry->parkingSpot?->floor ?? 'Not available' }}</strong>
                    </div>
                    <div class="vehicle-detail-item">
                        <span>Spot Number</span>
                        <strong>{{ $vehicleEntry->parkingSpot?->spot_number ?? 'Not assigned' }}</strong>
                    </div>
                </div>
            </div>
            <div class="vehicle-show-card">
                <div class="vehicle-show-card-header">
                    <div class="form-section-icon gate">
                        <i class="fas fa-door-open"></i>
                    </div>
                    <div>
                        <span>ENTRY DETAILS</span>
                        <h2>Gate Information</h2>
                    </div>
                </div>
                <div class="vehicle-detail-grid">
                    <div class="vehicle-detail-item">
                        <span>Entry Gate</span>
                        <strong>{{ $vehicleEntry->entry_gate ?: 'Not provided' }}</strong>
                    </div>
                    <div class="vehicle-detail-item">
                        <span>Entry Date</span>
                        <strong>{{ optional($vehicleEntry->created_at)->format('d M Y') }}</strong>
                    </div>
                    <div class="vehicle-detail-item">
                        <span>Entry Time</span>
                        <strong>{{ optional($vehicleEntry->created_at)->format('h:i A') }}</strong>
                    </div>
                    <div class="vehicle-detail-item">
                        <span>Last Updated</span>
                        <strong>{{ optional($vehicleEntry->updated_at)->format('d M Y, h:i A') }}</strong>
                    </div>
                </div>
                @if ($vehicleEntry->notes)
                    <div class="vehicle-notes">
                        <div class="vehicle-notes-icon">
                            <i class="fas fa-note-sticky"></i>
                        </div>
                        <div>
                            <span>NOTES</span>
                            <p>{{ $vehicleEntry->notes }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="vehicle-show-actions">
            <a href="{{ route('vehicle_entries.index') }}" class="entry-cancel-btn">
                <i class="fas fa-arrow-left"></i>
                Back to Vehicle Entry
            </a>
            <a href="{{ route('vehicle_entries.edit', $vehicleEntry) }}" class="entry-submit-btn">
                <i class="fas fa-pen-to-square"></i>
                Edit Vehicle Entry
            </a>
        </div>
    </div>
@endsection
