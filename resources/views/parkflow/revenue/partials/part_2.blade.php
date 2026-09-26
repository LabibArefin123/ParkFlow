<form method="GET" action="{{ route('revenue.index') }}" class="revenue-toolbar">
    <div class="revenue-search">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search transaction or vehicle...">
    </div>

    <select name="payment_method" class="revenue-filter">
        <option value="">All Payment Methods</option>
        @foreach ($paymentMethods as $method)
            <option value="{{ $method }}" @selected(request('payment_method') === $method)>
                {{ ucfirst($method) }}
            </option>
        @endforeach
    </select>

    <select name="status" class="revenue-filter">
        <option value="">All Status</option>
        <option value="paid" @selected(request('status') === 'paid')>Paid</option>
        <option value="pending" @selected(request('status') === 'pending')>Pending</option>
        <option value="failed" @selected(request('status') === 'failed')>Failed</option>
        <option value="cancelled" @selected(request('status') === 'cancelled')>Cancelled</option>
    </select>

    <input type="date" name="date" value="{{ request('date') }}" class="revenue-filter">
    <button type="submit" class="revenue-filter-btn">
        <i class="fa-solid fa-filter"></i>
        Filter
    </button>
    @if (request()->hasAny(['search', 'payment_method', 'status', 'date']))
        <a href="{{ route('revenue.index') }}" class="revenue-clear">
            Clear
        </a>
    @endif
</form>
