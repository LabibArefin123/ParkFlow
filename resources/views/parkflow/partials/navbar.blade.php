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
                <div class="parkflow-account-wrapper" id="parkflowAccountWrapper">
                    <button type="button" class="parkflow-user" id="parkflowAccountToggle" aria-expanded="false"
                        aria-haspopup="true">
                        <div class="parkflow-user-avatar">{{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}</div>
                        <div class="parkflow-user-info">
                            <span class="parkflow-user-name">{{ $user->name ?? 'User' }}</span>
                            <span class="parkflow-user-role">ParkFlow Operator</span>
                        </div>
                        <i class="fa-solid fa-chevron-down parkflow-account-arrow"></i>
                    </button>
                    <div class="parkflow-account-dropdown" id="parkflowAccountDropdown">
                        <div class="parkflow-dropdown-header">
                            <div class="parkflow-dropdown-avatar">{{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}</div>
                            <div class="parkflow-dropdown-user">
                                <strong>{{ $user->name }}</strong>
                                <span>{{ $user->email }}</span>
                                <small><i class="fa-solid fa-circle"></i> Active Account</small>
                            </div>
                        </div>
                        <div class="parkflow-dropdown-divider"></div>
                        <ul class="parkflow-dropdown-list">
                            <li>
                                <a href="{{ route('profile.show') }}" class="parkflow-dropdown-item">
                                    <span class="parkflow-dropdown-icon profile-icon"><i
                                            class="fa-regular fa-user"></i></span>
                                    <span class="parkflow-dropdown-text">
                                        <strong>My Profile</strong>
                                        <small>Manage your account details</small>
                                    </span>
                                    <i class="fa-solid fa-arrow-up-right-from-square parkflow-dropdown-end"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('activity-logs.index') }}" class="parkflow-dropdown-item">
                                    <span class="parkflow-dropdown-icon activity-icon"><i
                                            class="fa-solid fa-clock-rotate-left"></i></span>
                                    <span class="parkflow-dropdown-text">
                                        <strong>Activity Log</strong>
                                        <small>View your login sessions</small>
                                    </span>
                                    <i class="fa-solid fa-arrow-up-right-from-square parkflow-dropdown-end"></i>
                                </a>
                            </li>
                        </ul>
                        <div class="parkflow-dropdown-divider"></div>
                        <form action="{{ route('logout') }}" method="POST" class="parkflow-logout-form">
                            @csrf
                            <button type="submit" class="parkflow-dropdown-item parkflow-logout-item">
                                <span class="parkflow-dropdown-icon logout-icon"><i
                                        class="fa-solid fa-arrow-right-from-bracket"></i></span>
                                <span class="parkflow-dropdown-text">
                                    <strong>Log Out</strong>
                                    <small>Securely end your session</small>
                                </span>
                                <i class="fa-solid fa-arrow-right parkflow-dropdown-end"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</header>
