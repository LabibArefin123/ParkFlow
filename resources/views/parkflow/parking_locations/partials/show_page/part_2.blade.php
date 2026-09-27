<div class="show-location-form">
    <div class="location-form-grid">
        <div class="location-form-group full">
            <label class="location-form-label"> Location Name</label>
            <input type="text" value="{{ $parkingLocation->name }}" class="location-form-control" readonly>
        </div>

        <div class="location-form-group full">
            <label class="location-form-label"> Address</label>
            <textarea class="location-form-control" readonly>{{ $parkingLocation->address }}</textarea>
        </div>

        <div class="location-form-group">
            <label class="location-form-label"> City</label>
            <input type="text" value="{{ $parkingLocation->city }}" class="location-form-control" readonly>
        </div>

        <div class="location-form-group">
            <label class="location-form-label">Phone</label>
            <input type="text" value="{{ $parkingLocation->phone ?: 'Not provided' }}" class="location-form-control"
                readonly>
        </div>

        <div class="location-form-group">
            <label class="location-form-label">Total Parking Spots </label>
            <input type="number" value="{{ $parkingLocation->total_spots }}" class="location-form-control" readonly>
            <span class="location-form-help"> Total capacity of this parking facility. </span>
        </div>

        <div class="location-form-group">
            <label class="location-form-label"> Location Status</label>
            <div class="location-switch-row">
                <div>
                    <div class="location-switch-title">
                        {{ $parkingLocation->is_active ? 'Active Location' : 'Inactive Location' }}
                    </div>

                    <div class="location-switch-description">
                        {{ $parkingLocation->is_active
                            ? 'This location is currently accepting vehicles.'
                            : 'This location is currently not accepting vehicles.' }}
                    </div>
                </div>

                <label class="location-switch">
                    <input type="checkbox" disabled {{ $parkingLocation->is_active ? 'checked' : '' }}>
                    <span class="location-slider"></span>
                </label>
            </div>
        </div>
    </div>
</div>
