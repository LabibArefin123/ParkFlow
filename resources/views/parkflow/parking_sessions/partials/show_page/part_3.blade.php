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
