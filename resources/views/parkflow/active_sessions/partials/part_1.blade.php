<div class="session-stats">
    <div class="session-stat-card">
        <div class="session-stat-icon active">
            <i class="fas fa-car"></i>
        </div>

        <div>
            <span>Active Sessions</span>
            <strong>{{ $totalActive }}</strong>
            <small>Currently parked</small>
        </div>
    </div>

    <div class="session-stat-card">
        <div class="session-stat-icon entry">
            <i class="fas fa-right-to-bracket"></i>
        </div>

        <div>
            <span>Today's Entries</span>
            <strong>{{ $todayEntries }}</strong>
            <small>Vehicles entered today</small>
        </div>
    </div>

    <div class="session-stat-card">
        <div class="session-stat-icon long">
            <i class="fas fa-hourglass-half"></i>
        </div>

        <div>
            <span>Long Stay</span>
            <strong>{{ $longStayCount }}</strong>
            <small>Over 6 hours</small>
        </div>
    </div>
</div>
