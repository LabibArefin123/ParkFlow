<div class="profile-card profile-overview-card">
    <div class="profile-card-top"> <span class="profile-card-icon"> <i class="fa-solid fa-id-card"></i> </span>
        <div>
            <h3>Profile Overview</h3>
            <p>Your account information</p>
        </div>
    </div>
    <div class="profile-identity">
        <div class="profile-avatar"> {{ strtoupper(substr($user->name, 0, 1)) }} </div>
        <div class="profile-identity-info">
            <h2>{{ $user->name }}</h2> <span> <i class="fa-solid fa-shield-halved"></i> ParkFlow Operator
            </span>
        </div>
    </div>
    <div class="profile-info-list">
        <div class="profile-info-item">
            <div class="profile-info-icon"> <i class="fa-solid fa-envelope"></i> </div>
            <div> <small>Email Address</small> <strong>{{ $user->email }}</strong> </div> <span
                class="profile-fixed-badge"> <i class="fa-solid fa-lock"></i> Fixed </span>
        </div>
        <div class="profile-info-item">
            <div class="profile-info-icon"> <i class="fa-solid fa-calendar-check"></i> </div>
            <div> <small>Member Since</small> <strong>
                    {{ optional($user->created_at)->format('d M Y') ?? '—' }} </strong> </div>
        </div>
    </div>
</div>
