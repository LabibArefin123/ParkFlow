 <div class="report-panel">
     <div class="report-panel-header">
         <div>
             <h2>Payment Methods</h2>
             <p>Payment collection breakdown.</p>
         </div>
         <div class="report-panel-icon">
             <i class="fa-solid fa-wallet"></i>
         </div>
     </div>

     @if ($paymentMethods->count())
         <div class="payment-method-list">
             @foreach ($paymentMethods as $payment)
                 <div class="payment-method-row">
                     <div class="payment-method-info">
                         <div class="payment-method-icon {{ strtolower($payment->payment_method) }}">
                             @if (strtolower($payment->payment_method) === 'cash')
                                 <i class="fa-solid fa-money-bill-wave"></i>
                             @elseif(strtolower($payment->payment_method) === 'card')
                                 <i class="fa-solid fa-credit-card"></i>
                             @else
                                 <i class="fa-solid fa-mobile-screen-button"></i>
                             @endif
                         </div>

                         <div>
                             <strong>{{ ucfirst($payment->payment_method) }}</strong>
                             <small>{{ number_format($payment->total) }} transactions</small>
                         </div>
                     </div>

                     <strong class="payment-method-amount">
                         ৳{{ number_format($payment->amount, 2) }}
                     </strong>
                 </div>
             @endforeach
         </div>
     @else
         <div class="mini-empty">
             <i class="fa-solid fa-wallet"></i>
             No payment data available.
         </div>
     @endif
 </div>
