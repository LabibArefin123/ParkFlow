@extends('parkflow.layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_location/create_page/parking_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_location/create_page/parking_card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_location/create_page/parking_form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_location/create_page/parking_switch.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_location/create_page/parking_footer.css') }}">

    <div class="create-location-page">
        <div class="create-location-header">
            <a href="{{ route('parking_locations.index') }}" class="back-location-btn">
                <i class="fa-solid fa-arrow-left"></i>
            </a>

            <div>
                <h1>Add Parking Location</h1>
                <p>Create a new parking facility for ParkFlow.</p>
            </div>
        </div>

        <div class="create-location-card">

            <div class="create-location-card-header">
                <h2>Location Information</h2>
                <p>Enter the basic information for this parking facility.</p>
            </div>

            <form action="{{ route('parking_locations.store') }}" method="POST">

                @csrf

                <div class="create-location-form">

                    <div class="location-form-grid">

                        <div class="location-form-group full">

                            <label class="location-form-label">
                                Location Name <span class="required">*</span>
                            </label>

                            <input type="text" name="name" value="{{ old('name') }}"
                                class="location-form-control @error('name') is-invalid @enderror"
                                placeholder="e.g. Bashundhara City Parking" required>

                            @error('name')
                                <span class="location-form-error">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="location-form-group full">

                            <label class="location-form-label">
                                Address <span class="required">*</span>
                            </label>

                            <textarea name="address" class="location-form-control @error('address') is-invalid @enderror"
                                placeholder="e.g. Panthapath, Dhaka" required>{{ old('address') }}</textarea>

                            @error('address')
                                <span class="location-form-error">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="location-form-group">

                            <label class="location-form-label">
                                City <span class="required">*</span>
                            </label>

                            <input type="text" name="city" value="{{ old('city', 'Dhaka') }}"
                                class="location-form-control @error('city') is-invalid @enderror" placeholder="Dhaka"
                                required>

                            @error('city')
                                <span class="location-form-error">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="location-form-group">

                            <label class="location-form-label">
                                Phone
                            </label>

                            <input type="text" name="phone" value="{{ old('phone') }}"
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

                            <input type="number" name="total_spots" value="{{ old('total_spots', 24) }}" min="1"
                                max="10000" class="location-form-control @error('total_spots') is-invalid @enderror"
                                placeholder="120" required>

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
                                        {{ old('is_active', true) ? 'checked' : '' }}>

                                    <span class="location-slider"></span>
                                </label>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="create-location-footer">

                    <a href="{{ route('parking_locations.index') }}" class="create-location-btn create-location-cancel">
                        Cancel
                    </a>

                    <button type="submit" class="create-location-btn create-location-submit">
                        <i class="fa-solid fa-plus"></i>
                        Create Location
                    </button>

                </div>

            </form>

        </div>

    </div>
@endsection
