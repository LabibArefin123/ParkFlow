<form method="GET" action="{{ route('parking_sessions.index') }}" class="session-toolbar">
    <div class="session-search">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Search vehicle, customer or gate...">
    </div>

    <select name="status" class="session-filter">
        <option value="">All Sessions</option>
        <option value="active" @selected(request('status') === 'active')>Active</option>
        <option value="completed" @selected(request('status') === 'completed')>Completed</option>
        <option value="cancelled" @selected(request('status') === 'cancelled')>Cancelled</option>
    </select>

    <button type="submit" class="session-filter-btn">
        <i class="fa-solid fa-filter me-1"></i>
        Filter
    </button>

    @if (request()->hasAny(['search', 'status']))
        <a href="{{ route('parking_sessions.index') }}" class="session-clear-btn">
            Clear
        </a>
    @endif

</form>
