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
                <span class="timeline-label"> Vehicle Entry</span>
                <strong> {{ $sessionData['entry_time'] }}</strong>
                <span>{{ $sessionData['entry_date'] }} </span>
            </div>
        </div>

        <div class="timeline-line"></div>

        <div class="timeline-item {{ $sessionData['status_class'] === 'completed' ? 'completed' : 'current' }}">
            <div class="timeline-marker">
                <i class="fa-solid fa-right-from-bracket"></i>
            </div>

            <div class="timeline-content">
                <span class="timeline-label">Vehicle Exit</span>
                <strong>{{ $sessionData['exit_time'] }}</strong>
                <span> {{ $sessionData['exit_date'] }} </span>
            </div>
        </div>
    </div>
</div>
