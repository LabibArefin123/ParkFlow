<div class="admin-header">
    <div>
        <h1>Administration</h1>
        <p>Manage your ParkFlow system, configuration and business data.</p>
    </div>

    @if ($user)
        <div class="admin-user-badge">
            <div class="admin-user-avatar">
                {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
            </div>
            <div>
                <div class="admin-user-name"> {{ $user->name ?? 'User' }} </div>
                <div class="admin-user-role">ParkFlow Administrator </div>
            </div>
        </div>
    @endif
</div>
