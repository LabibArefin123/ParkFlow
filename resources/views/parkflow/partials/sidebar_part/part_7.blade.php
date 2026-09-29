<div class="parkflow-sidebar-footer">
    @if ($user)
        <a href="{{ route('profile.show') }}"
            class="parkflow-sidebar-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
            <span class="parkflow-sidebar-icon">
                <i class="fa-solid fa-user-circle"></i>
            </span>
            <span class="parkflow-sidebar-label"> My Profile </span>
        </a>
        <div class="parkflow-sidebar-user">
            <div class="parkflow-sidebar-avatar"> {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }} </div>
            <div class="parkflow-sidebar-user-info">
                <strong>{{ $user->name ?? 'User' }}</strong>
                <span>ParkFlow Operator</span>
            </div>
            <span class="parkflow-online-dot"></span>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="parkflow-logout">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <span>Sign Out</span>
            </button>
        </form>
    @endif
</div>
