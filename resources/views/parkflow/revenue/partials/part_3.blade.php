<div class="revenue-card">
    <div class="revenue-card-header">
        <div>
            <div class="revenue-card-title">
                Payment Transactions
            </div>

            <div class="revenue-card-subtitle">
                Recent parking payment records
            </div>
        </div>

        <div class="revenue-count">
            {{ $payments->total() }} Transactions
        </div>

    </div>

    @if ($payments->count())
        <div class="revenue-table-wrapper">
            <table class="revenue-table">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Transaction</th>
                        <th>Vehicle</th>
                        <th>Location</th>
                        <th>Payment Method</th>
                        <th>Amount</th>
                        <th>Paid At</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="transaction-info">
                                    <span class="transaction-id">{{ $payment->display_transaction_id }}</span>
                                    <span class="transaction-number">{{ $payment->display_payment_number }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="vehicle-info">
                                    <div class="vehicle-icon">
                                        <i class="{{ $payment->vehicle_icon }}"></i>
                                    </div>
                                    <div>
                                        <div class="vehicle-number">{{ $payment->display_vehicle_number }}</div>
                                        <div class="vehicle-type">{{ $payment->display_vehicle_type }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="location-info">
                                    <span class="location-name">{{ $payment->display_location }}</span>
                                    <span class="spot-name">{{ $payment->display_spot }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="method-badge {{ $payment->method_class }}">
                                    <i class="{{ $payment->method_icon }}"></i>
                                    {{ $payment->method_label }}
                                </span>
                            </td>
                            <td>
                                <span class="payment-amount">{{ $payment->display_amount }}</span>
                            </td>
                            <td>
                                <div class="payment-date">
                                    <strong>{{ $payment->display_paid_time }}</strong>
                                    <span>{{ $payment->display_paid_date }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="status-badge {{ $payment->status_class }}">
                                    <i class="{{ $payment->status_icon }}"></i>
                                    {{ $payment->status_label }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if ($payments->hasPages())
            <div class="revenue-pagination">
                {{ $payments->links() }}
            </div>
        @endif
    @else
        <div class="revenue-empty">
            <div class="revenue-empty-icon">
                <i class="fa-solid fa-receipt"></i>
            </div>
            <h3>No payment transactions found</h3>
            <p>
                Try changing your search or filter options.
            </p>
        </div>
    @endif
</div>
