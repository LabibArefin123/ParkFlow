<header class="parkflow-navbar">
    <div class="parkflow-navbar-inner">
        <div class="parkflow-navbar-left">
            <button type="button" class="parkflow-mobile-toggle" id="parkflowSidebarToggle">

                <i class="fa-solid fa-bars"></i>

            </button>

            <div class="parkflow-page-heading">
                <span>PARKFLOW</span>
                <strong>{{ $title ?? 'Dashboard' }}</strong>
            </div>
        </div>

        <div class="parkflow-navbar-right">
            <div class="parkflow-system-status">
                <span class="parkflow-status-dot"></span>
                <span>System Online</span>
            </div>

            <div class="parkflow-navbar-divider"></div>
            @if ($user)
                <a href="{{ route('profile.index') }}" class="parkflow-user">

                    <div class="parkflow-user-avatar">
                        {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                    </div>

                    <div class="parkflow-user-info">
                        <span class="parkflow-user-name">{{ $user->name ?? 'User' }}</span>
                        <span class="parkflow-user-role">ParkFlow Operator</span>
                    </div>
                </a>
            @endif
        </div>
    </div>
</header>
