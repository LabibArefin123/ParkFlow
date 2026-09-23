@extends('parkflow.layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_location/edit_page/parking_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_location/edit_page/parking_card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_location/edit_page/parking_form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_location/edit_page/parking_switch.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_location/edit_page/parking_footer.css') }}">

    <div class="edit-location-page">

        <div class="edit-location-header">

            <a href="{{ route('parking_locations.index') }}" class="back-location-btn">
                <i class="fa-solid fa-arrow-left"></i>
            </a>

            <div>
                <h1>Edit Parking Location</h1>
                <p>Update the information for this ParkFlow parking facility.</p>
            </div>

        </div>

        <div class="edit-location-card">

            <div class="edit-location-card-header">
                <h2>Location Information</h2>
                <p>Update the basic information for this parking facility.</p>
            </div>

            <form action="{{ route('parking_locations.update', $parkingLocation) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="edit-location-form">

                    <div class="location-form-grid">

                        <div class="location-form-group full">

                            <label class="location-form-label">
                                Location Name <span class="required">*</span>
                            </label>

                            <input type="text" name="name" value="{{ old('name', $parkingLocation->name) }}"
                                class="location-form-control @error('name') is-invalid @enderror"
                                placeholder="e.g. Bashundhara City Parking">

                            @error('name')
                                <span class="location-form-error">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="location-form-group full">

                            <label class="location-form-label">
                                Address <span class="required">*</span>
                            </label>

                            <textarea name="address" class="location-form-control @error('address') is-invalid @enderror"
                                placeholder="e.g. Panthapath, Dhaka">{{ old('address', $parkingLocation->address) }}</textarea>

                            @error('address')
                                <span class="location-form-error">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="location-form-group">

                            <label class="location-form-label">
                                City <span class="required">*</span>
                            </label>

                            <input type="text" name="city" value="{{ old('city', $parkingLocation->city) }}"
                                class="location-form-control @error('city') is-invalid @enderror" placeholder="Dhaka">

                            @error('city')
                                <span class="location-form-error">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="location-form-group">

                            <label class="location-form-label">
                                Phone
                            </label>

                            <input type="text" name="phone" value="{{ old('phone', $parkingLocation->phone) }}"
                                class="location-form-control @error('phone') is-invalid @enderror"
                                placeholder="01712345678">

                            @error('phone')
                                <span class="location-form-error">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="location-form-group">

                            <label class="location-form-label">
                                Total Parking Spots <span class="required">*</span>
                            </label>

                            <input type="number" name="total_spots"
                                value="{{ old('total_spots', $parkingLocation->total_spots) }}" min="1"
                                max="10000" class="location-form-control @error('total_spots') is-invalid @enderror"
                                placeholder="120">

                            <span class="location-form-help">
                                Total capacity of this parking facility.
                            </span>

                            @error('total_spots')
                                <span class="location-form-error">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="location-form-group">

                            <label class="location-form-label">
                                Location Status
                            </label>

                            <div class="location-switch-row">

                                <div>
                                    <div class="location-switch-title">
                                        Active Location
                                    </div>

                                    <div class="location-switch-description">
                                        Allow this location to receive vehicles.
                                    </div>
                                </div>

                                <label class="location-switch">

                                    <input type="checkbox" name="is_active" value="1"
                                        {{ old('is_active', $parkingLocation->is_active) ? 'checked' : '' }}>

                                    <span class="location-slider"></span>

                                </label>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="edit-location-footer">

                    <a href="{{ route('parking_locations.index') }}" class="edit-location-btn edit-location-cancel">
                        Cancel
                    </a>

                    <button type="submit" class="edit-location-btn edit-location-submit">
                        <i class="fa-solid fa-check"></i>
                        Update Location
                    </button>

                </div>

            </form>

        </div>

    </div>
@endsection
