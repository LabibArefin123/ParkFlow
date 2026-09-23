@extends('parkflow.layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_spot/show_page/spot_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_spot/show_page/spot_card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_spot/show_page/spot_form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_spot/show_page/spot_switch.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_spot/show_page/spot_footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_spot/show_page/spot_resp.css') }}">

    <div class="show-spot-page">

        <div class="show-spot-header">

            <a href="{{ route('parking_spots.index') }}" class="spot-back">
                <i class="fa-solid fa-arrow-left"></i>
            </a>

            <div>
                <h1>Parking Spot Details</h1>
                <p>View the complete information for this parking space.</p>
            </div>

        </div>

        <div class="show-spot-card">

            <div class="show-spot-card-header">
                <h2>Parking Spot Information</h2>
                <p>Details about the selected parking space and its current status.</p>
            </div>

            <div class="show-spot-form">

                <div class="spot-form-grid">

                    <div class="spot-form-group full">

                        <label class="spot-label">
                            Parking Location
                        </label>

                        <select class="spot-control" disabled>

                            <option selected>
                                {{ $parkingSpot->parkingLocation?->name }}
                                — {{ $parkingSpot->parkingLocation?->city }}
                            </option>

                        </select>

                    </div>

                    <div class="spot-form-group">

                        <label class="spot-label">
                            Floor
                        </label>

                        <select class="spot-control" disabled>

                            <option selected>
                                {{ $parkingSpot->floor }}
                            </option>

                        </select>

                    </div>

                    <div class="spot-form-group">

                        <label class="spot-label">
                            Spot Number
                        </label>

                        <input type="text" value="{{ $parkingSpot->spot_number }}" class="spot-control" disabled>

                        <span class="spot-help">
                            Unique within this parking location.
                        </span>

                    </div>

                    <div class="spot-form-group">

                        <label class="spot-label">
                            Vehicle Type
                        </label>

                        <select class="spot-control" disabled>

                            <option selected>
                                {{ ucfirst($parkingSpot->vehicle_type) }}
                            </option>

                        </select>

                    </div>

                    <div class="spot-form-group">

                        <label class="spot-label">
                            Status
                        </label>

                        <select class="spot-control" disabled>

                            <option selected>
                                {{ ucfirst($parkingSpot->status) }}
                            </option>

                        </select>

                    </div>

                    <div class="spot-form-group full">

                        <div class="spot-info">

                            <div class="spot-info-icon">
                                <i class="fa-solid fa-circle-info"></i>
                            </div>

                            <div class="spot-info-text">
                                This parking spot belongs to
                                <strong>{{ $parkingSpot->parkingLocation?->name }}</strong>.
                                Its spot number is unique within that parking location.
                            </div>

                        </div>

                    </div>

                    <div class="spot-form-group">

                        <label class="spot-label">
                            Availability
                        </label>

                        <div class="spot-switch-row">

                            <span class="spot-switch-text">
                                {{ $parkingSpot->is_active ? 'Active Parking Spot' : 'Inactive Parking Spot' }}
                            </span>

                            <label class="spot-switch">

                                <input type="checkbox" disabled {{ $parkingSpot->is_active ? 'checked' : '' }}>

                                <span class="spot-slider"></span>

                            </label>

                        </div>

                    </div>

                </div>

            </div>

            <div class="show-spot-footer">

                <a href="{{ route('parking_spots.index') }}" class="spot-form-btn spot-cancel">
                    Back
                </a>

                <a href="{{ route('parking_spots.edit', $parkingSpot) }}" class="spot-form-btn spot-submit">
                    <i class="fa-solid fa-pen-to-square"></i>
                    Edit Parking Spot
                </a>

            </div>

        </div>

    </div>
@endsection
