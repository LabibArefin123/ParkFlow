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
            <p>Complete details and activity for this parking session. </p>
        </div>
    </div>

    <div class="session-header-actions">
        <span class="session-show-status {{ $sessionData['status_class'] }}">
            <i class="{{ $sessionData['status_icon'] }}"></i>
            {{ $sessionData['status'] }}
        </span>
    </div>
</div>
