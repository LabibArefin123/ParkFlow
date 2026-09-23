@extends('parkflow.layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_spot/edit_page/spot_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_spot/edit_page/spot_card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_spot/edit_page/spot_form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_spot/edit_page/spot_switch.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_spot/edit_page/spot_footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_spot/edit_page/spot_resp.css') }}">
    <div class="edit-spot-page">
        <div class="edit-spot-header">

            <a href="{{ route('parking_spots.index') }}" class="spot-back">
                <i class="fa-solid fa-arrow-left"></i>
            </a>

            <div>
                <h1>Edit Parking Spot</h1>
                <p>Update the parking space information and current status.</p>
            </div>

        </div>

        <div class="edit-spot-card">

            <div class="edit-spot-card-header">
                <h2>Parking Spot Information</h2>
                <p>Update the location, capacity type and current status.</p>
            </div>

            <form action="{{ route('parking_spots.update', $parkingSpot) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="edit-spot-form">
                    <div class="spot-form-grid">
                        <div class="spot-form-group full">
                            <label class="spot-label">
                                Parking Location <span class="required">*</span>
                            </label>

                            <select name="parking_location_id"
                                class="spot-control @error('parking_location_id') is-invalid @enderror">
                                <option value="">Select Parking Location</option>
                                @foreach ($parkingLocations as $location)
                                    <option value="{{ $location->id }}"
                                        {{ old('parking_location_id', $parkingSpot->parking_location_id) == $location->id ? 'selected' : '' }}>
                                        {{ $location->name }} — {{ $location->city }}
                                    </option>
                                @endforeach
                            </select>

                            @error('parking_location_id')
                                <span class="spot-error">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="spot-form-group">

                            <label class="spot-label">
                                Floor <span class="required">*</span>
                            </label>

                            <select name="floor" class="spot-control @error('floor') is-invalid @enderror">

                                <option value="">Select Floor</option>

                                <option value="Ground Floor"
                                    {{ old('floor', $parkingSpot->floor) === 'Ground Floor' ? 'selected' : '' }}>
                                    Ground Floor
                                </option>

                                <option value="Level 1"
                                    {{ old('floor', $parkingSpot->floor) === 'Level 1' ? 'selected' : '' }}>
                                    Level 1
                                </option>

                                <option value="Level 2"
                                    {{ old('floor', $parkingSpot->floor) === 'Level 2' ? 'selected' : '' }}>
                                    Level 2
                                </option>

                                <option value="Level 3"
                                    {{ old('floor', $parkingSpot->floor) === 'Level 3' ? 'selected' : '' }}>
                                    Level 3
                                </option>

                                <option value="Basement 1"
                                    {{ old('floor', $parkingSpot->floor) === 'Basement 1' ? 'selected' : '' }}>
                                    Basement 1
                                </option>

                                <option value="Basement 2"
                                    {{ old('floor', $parkingSpot->floor) === 'Basement 2' ? 'selected' : '' }}>
                                    Basement 2
                                </option>

                            </select>

                            @error('floor')
                                <span class="spot-error">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="spot-form-group">

                            <label class="spot-label">
                                Spot Number <span class="required">*</span>
                            </label>

                            <input type="text" name="spot_number"
                                value="{{ old('spot_number', $parkingSpot->spot_number) }}"
                                class="spot-control @error('spot_number') is-invalid @enderror" placeholder="A-001">

                            <span class="spot-help">
                                Example: A-001, B-015 or G-024.
                            </span>

                            @error('spot_number')
                                <span class="spot-error">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="spot-form-group">

                            <label class="spot-label">
                                Vehicle Type <span class="required">*</span>
                            </label>

                            <select name="vehicle_type" class="spot-control @error('vehicle_type') is-invalid @enderror">

                                <option value="">Select Vehicle Type</option>

                                <option value="car"
                                    {{ old('vehicle_type', $parkingSpot->vehicle_type) === 'car' ? 'selected' : '' }}>
                                    Car
                                </option>

                                <option value="motorcycle"
                                    {{ old('vehicle_type', $parkingSpot->vehicle_type) === 'motorcycle' ? 'selected' : '' }}>
                                    Motorcycle
                                </option>

                                <option value="microbus"
                                    {{ old('vehicle_type', $parkingSpot->vehicle_type) === 'microbus' ? 'selected' : '' }}>
                                    Microbus
                                </option>

                                <option value="cng"
                                    {{ old('vehicle_type', $parkingSpot->vehicle_type) === 'cng' ? 'selected' : '' }}>
                                    CNG
                                </option>

                            </select>

                            @error('vehicle_type')
                                <span class="spot-error">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="spot-form-group">

                            <label class="spot-label">
                                Status <span class="required">*</span>
                            </label>

                            <select name="status" class="spot-control @error('status') is-invalid @enderror">

                                <option value="available"
                                    {{ old('status', $parkingSpot->status) === 'available' ? 'selected' : '' }}>
                                    Available
                                </option>

                                <option value="occupied"
                                    {{ old('status', $parkingSpot->status) === 'occupied' ? 'selected' : '' }}>
                                    Occupied
                                </option>

                                <option value="reserved"
                                    {{ old('status', $parkingSpot->status) === 'reserved' ? 'selected' : '' }}>
                                    Reserved
                                </option>

                                <option value="maintenance"
                                    {{ old('status', $parkingSpot->status) === 'maintenance' ? 'selected' : '' }}>
                                    Maintenance
                                </option>

                            </select>

                            @error('status')
                                <span class="spot-error">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="spot-form-group full">

                            <div class="spot-info">

                                <div class="spot-info-icon">
                                    <i class="fa-solid fa-circle-info"></i>
                                </div>

                                <div class="spot-info-text">
                                    A parking spot can only have one spot number within the same parking location.
                                    The same spot number can still be used at another location.
                                </div>

                            </div>

                        </div>

                        <div class="spot-form-group">

                            <label class="spot-label">
                                Availability
                            </label>

                            <div class="spot-switch-row">

                                <span class="spot-switch-text">
                                    Active Parking Spot
                                </span>

                                <label class="spot-switch">

                                    <input type="checkbox" name="is_active" value="1"
                                        {{ old('is_active', $parkingSpot->is_active) ? 'checked' : '' }}>

                                    <span class="spot-slider"></span>

                                </label>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="edit-spot-footer">

                    <a href="{{ route('parking_spots.index') }}" class="spot-form-btn spot-cancel">
                        Cancel
                    </a>

                    <button type="submit" class="spot-form-btn spot-submit">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Update Parking Spot
                    </button>

                </div>

            </form>

        </div>

    </div>
@endsection
