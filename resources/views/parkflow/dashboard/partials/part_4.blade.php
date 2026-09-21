<div class="panel mb-4">
    <div class="panel-header">
        <div>
            <h2 class="panel-title">Recent Transactions</h2>
            <p class="panel-subtitle">Latest completed parking payments</p>
        </div>

        <a href="{{ route('revenue.index') }}" class="panel-link">
            View Revenue
            <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>

    <div class="table-wrapper">
        @if ($recentTransactions->count())
            <table class="transactions">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Transaction</th>
                        <th>Vehicle</th>
                        <th>Payment</th>
                        <th>Amount</th>
                        <th>Time</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($recentTransactions as $transaction)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="transaction-ticket">
                                    <span class="ticket">{{ $transaction->transaction_id }}</span>
                                    <small>Payment #{{ $transaction->id }}</small>
                                </div>
                            </td>

                            <td>
                                <div class="transaction-vehicle">
                                    <div class="transaction-vehicle-icon">
                                        <i class="fa-solid fa-car-side"></i>
                                    </div>
                                    <div>
                                        <strong>
                                            {{ $transaction->parkingSession?->vehicle?->registration_number ?? 'Unknown Vehicle' }}
                                        </strong>

                                        @if ($transaction->parkingSession?->vehicle?->type)
                                            <small>
                                                {{ ucfirst($transaction->parkingSession->vehicle->type) }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="payment-badge {{ strtolower($transaction->payment_method) }}">
                                    @if (strtolower($transaction->payment_method) === 'cash')
                                        <i class="fa-solid fa-money-bill-wave"></i>
                                    @elseif(strtolower($transaction->payment_method) === 'bkash')
                                        <i class="fa-solid fa-mobile-screen-button"></i>
                                    @elseif(strtolower($transaction->payment_method) === 'nagad')
                                        <i class="fa-solid fa-mobile-screen-button"></i>
                                    @elseif(strtolower($transaction->payment_method) === 'card')
                                        <i class="fa-solid fa-credit-card"></i>
                                    @else
                                        <i class="fa-solid fa-wallet"></i>
                                    @endif

                                    {{ $transaction->payment_method }}
                                </span>
                            </td>

                            <td>
                                <span class="amount">
                                    ৳{{ number_format($transaction->amount, 2) }}
                                </span>
                            </td>

                            <td>
                                <div class="transaction-time">
                                    <strong>
                                        {{ $transaction->paid_at?->format('h:i A') ?? '-' }}
                                    </strong>
                                    <small>
                                        {{ $transaction->paid_at?->format('d M Y') ?? '-' }}
                                    </small>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="transactions-empty">
                <div class="transactions-empty-icon">
                    <i class="fa-solid fa-receipt"></i>
                </div>

                <h3>No transactions yet</h3>
                <p>
                    Completed parking payments will appear here.
                </p>
            </div>
        @endif
    </div>
</div>
