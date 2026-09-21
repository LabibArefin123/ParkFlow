@extends('parkflow.layouts.app')

@section('title', 'Register Vehicle')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_entry/create_page/vehicle_entry_layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_entry/create_page/vehicle_entry_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_entry/create_page/vehicle_entry_form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_entry/create_page/vehicle_entry_parking.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_entry/create_page/vehicle_entry_alert_actions.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/vehicle_entry/create_page/vehicle_entry_responsive.css') }}">
    <div class="vehicle-entry-page">

        <div class="vehicle-entry-header">
            <div>
                <div class="vehicle-entry-eyebrow">
                    <i class="fas fa-car-side"></i>
                    NEW PARKING SESSION
                </div>

                <h1>Register Vehicle</h1>

                <p>
                    Enter vehicle details and assign an available parking space.
                </p>
            </div>

            <a href="{{ route('vehicle_entries.index') }}" class="entry-back-btn">
                <i class="fas fa-arrow-left"></i>
                Back to Vehicle Entry
            </a>
        </div>

        @if ($errors->any())

            <div class="entry-alert">
                <div class="entry-alert-icon">
                    <i class="fas fa-triangle-exclamation"></i>
                </div>

                <div>
                    <strong>Please check the form</strong>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

        @endif

        <form action="{{ route('vehicle_entries.store') }}" method="POST" class="vehicle-entry-form">
            @csrf

            <div class="entry-form-layout">

                <div class="entry-form-card">

                    <div class="entry-form-header">
                        <div class="form-section-icon">
                            <i class="fas fa-car"></i>
                        </div>

                        <div>
                            <span>VEHICLE INFORMATION</span>
                            <h2>Vehicle Details</h2>
                        </div>
                    </div>

                    <div class="form-fields-grid">

                        <div class="entry-field">
                            <label for="registration_number">
                                Registration Number
                                <span>*</span>
                            </label>

                            <div class="entry-input">
                                <i class="fas fa-id-card"></i>

                                <input type="text" id="registration_number" name="registration_number"
                                    value="{{ old('registration_number') }}" placeholder="e.g. DHAKA METRO-GA-11-4587"
                                    required>
                            </div>

                            @error('registration_number')
                                <small class="field-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="entry-field">
                            <label for="type">
                                Vehicle Type
                                <span>*</span>
                            </label>

                            <div class="entry-input">
                                <i class="fas fa-car-side"></i>

                                <select id="type" name="type" required>
                                    <option value="">Select vehicle type</option>
                                    <option value="car" @selected(old('type') === 'car')>Car</option>
                                    <option value="motorcycle" @selected(old('type') === 'motorcycle')>Motorcycle</option>
                                    <option value="microbus" @selected(old('type') === 'microbus')>Microbus</option>
                                    <option value="cng" @selected(old('type') === 'cng')>CNG</option>
                                </select>
                            </div>

                            @error('type')
                                <small class="field-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="entry-field">
                            <label for="customer_name">Customer Name</label>

                            <div class="entry-input">
                                <i class="fas fa-user"></i>

                                <input type="text" id="customer_name" name="customer_name"
                                    value="{{ old('customer_name') }}" placeholder="Enter customer name">
                            </div>

                            @error('customer_name')
                                <small class="field-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="entry-field">
                            <label for="customer_phone">Phone Number</label>

                            <div class="entry-input">
                                <i class="fas fa-phone"></i>

                                <input type="text" id="customer_phone" name="customer_phone"
                                    value="{{ old('customer_phone') }}" placeholder="01XXXXXXXXX">
                            </div>

                            @error('customer_phone')
                                <small class="field-error">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                </div>

                <div class="entry-form-card">

                    <div class="entry-form-header">
                        <div class="form-section-icon location">
                            <i class="fas fa-location-dot"></i>
                        </div>

                        <div>
                            <span>PARKING ASSIGNMENT</span>
                            <h2>Choose Parking Space</h2>
                        </div>
                    </div>

                    <div class="parking-selection">

                        <div class="entry-field">
                            <label for="parking_location_id">
                                Parking Location
                                <span>*</span>
                            </label>

                            <div class="entry-input">
                                <i class="fas fa-building"></i>

                                <select id="parking_location_id" name="parking_location_id" required>
                                    <option value="">Select parking location</option>

                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id }}" @selected(old('parking_location_id', request('location')) == $location->id)>
                                            {{ $location->name }} — {{ $location->city }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            @error('parking_location_id')
                                <small class="field-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="entry-field">
                            <label for="parking_spot_id">
                                Parking Spot
                                <span>*</span>
                            </label>

                            <div class="entry-input">
                                <i class="fas fa-square-parking"></i>

                                <select id="parking_spot_id" name="parking_spot_id" required>
                                    <option value="">Select parking spot</option>

                                    @foreach ($locations as $location)
                                        @foreach ($location->parkingSpots as $spot)
                                            <option value="{{ $spot->id }}" data-location="{{ $location->id }}"
                                                @selected(old('parking_spot_id') == $spot->id)>
                                                {{ $spot->spot_number }} — {{ $spot->floor }}
                                            </option>
                                        @endforeach
                                    @endforeach

                                </select>
                            </div>

                            @error('parking_spot_id')
                                <small class="field-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="spot-preview" id="spotPreview">

                            <div class="spot-preview-icon">
                                <i class="fas fa-square-parking"></i>
                            </div>

                            <div>
                                <strong>Select a parking space</strong>
                                <span>Available spaces will appear after selecting a location.</span>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="entry-form-card">

                    <div class="entry-form-header">
                        <div class="form-section-icon gate">
                            <i class="fas fa-door-open"></i>
                        </div>

                        <div>
                            <span>ENTRY DETAILS</span>
                            <h2>Gate Information</h2>
                        </div>
                    </div>

                    <div class="form-fields-grid">

                        <div class="entry-field">
                            <label for="entry_gate">Entry Gate</label>

                            <div class="entry-input">
                                <i class="fas fa-door-open"></i>

                                <input type="text" id="entry_gate" name="entry_gate" value="{{ old('entry_gate') }}"
                                    placeholder="e.g. Main Gate">
                            </div>

                            @error('entry_gate')
                                <small class="field-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="entry-field">
                            <label for="notes">Notes</label>

                            <div class="entry-input textarea">
                                <i class="fas fa-note-sticky"></i>

                                <textarea id="notes" name="notes" rows="3" placeholder="Optional entry notes...">{{ old('notes') }}</textarea>
                            </div>

                            @error('notes')
                                <small class="field-error">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                </div>

            </div>

            <div class="entry-form-actions">

                <a href="{{ route('vehicle_entries.index') }}" class="entry-cancel-btn">
                    Cancel
                </a>

                <button type="submit" class="entry-submit-btn">
                    <i class="fas fa-right-to-bracket"></i>
                    Confirm Vehicle Entry
                </button>

            </div>

        </form>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const locationSelect = document.getElementById('parking_location_id');
            const spotSelect = document.getElementById('parking_spot_id');
            const spotPreview = document.getElementById('spotPreview');
            const options = [...spotSelect.querySelectorAll('option[data-location]')];

            function filterSpots() {
                const locationId = locationSelect.value;
                const selectedSpot = spotSelect.value;

                options.forEach(option => {
                    option.hidden = locationId !== option.dataset.location;
                });

                if (!locationId) {
                    spotSelect.value = '';
                    updatePreview();
                    return;
                }

                if (!options.some(option => option.dataset.location === locationId && option.value ===
                        selectedSpot)) {
                    spotSelect.value = '';
                }

                updatePreview();
            }

            function updatePreview() {
                const option = spotSelect.options[spotSelect.selectedIndex];

                if (!option || !option.value) {
                    spotPreview.innerHTML = `
                <div class="spot-preview-icon">
                    <i class="fas fa-square-parking"></i>
                </div>
                <div>
                    <strong>Select a parking space</strong>
                    <span>Available spaces will appear after selecting a location.</span>
                </div>
            `;
                    return;
                }

                spotPreview.innerHTML = `
            <div class="spot-preview-icon selected">
                <i class="fas fa-check"></i>
            </div>
            <div>
                <strong>${option.textContent.trim()}</strong>
                <span>This parking space is available for entry.</span>
            </div>
        `;
            }

            locationSelect.addEventListener('change', filterSpots);
            spotSelect.addEventListener('change', updatePreview);

            filterSpots();
        });
    </script>
@endsection
