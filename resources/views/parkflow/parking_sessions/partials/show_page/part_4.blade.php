<div class="session-customer-card">
    <div class="session-card-heading">
        <div>
            <h3>Customer</h3>
            <p>Vehicle owner information</p>
        </div>

        <span class="card-heading-icon">
            <i class="fa-solid fa-user"></i>
        </span>
    </div>

    <div class="customer-profile">
        <div class="customer-avatar">
            <i class="fa-solid fa-user"></i>
        </div>
        <div>
            <strong>{{ $sessionData['customer_name'] }}</strong>
            @if ($sessionData['customer_phone'])
                <span> {{ $sessionData['customer_phone'] }}</span>
            @else
                <span> No phone number </span>
            @endif
        </div>
    </div>
</div>
