<div class="report-stat-grid">
    <div class="report-stat revenue-stat">
        <div class="report-stat-icon">
            <i class="fa-solid fa-bangladeshi-taka-sign"></i>
        </div>
        <div class="report-stat-content">
            <span>Total Revenue</span>
            <strong>৳{{ number_format($totalRevenue, 2) }}</strong>
            <small>{{ number_format($paidTransactions) }} paid transactions</small>
        </div>
    </div>

    <div class="report-stat">
        <div class="report-stat-icon">
            <i class="fa-solid fa-car-side"></i>
        </div>
        <div class="report-stat-content">
            <span>Total Sessions</span>
            <strong>{{ number_format($totalSessions) }}</strong>
            <small>{{ number_format($completedSessions) }} completed</small>
        </div>
    </div>

    <div class="report-stat">
        <div class="report-stat-icon">
            <i class="fa-solid fa-circle-check"></i>
        </div>
        <div class="report-stat-content">
            <span>Completed</span>
            <strong>{{ number_format($completedSessions) }}</strong>
            <small>{{ number_format($activeSessions) }} currently active</small>
        </div>
    </div>

    <div class="report-stat">
        <div class="report-stat-icon">
            <i class="fa-solid fa-receipt"></i>
        </div>
        <div class="report-stat-content">
            <span>Average Payment</span>
            <strong>৳{{ number_format($averageRevenue, 2) }}</strong>
            <small>Per paid transaction</small>
        </div>
    </div>

</div>
