 <div class="session-payment-card">
     <div class="session-card-heading">
         <div>
             <h3>Payment</h3>
             <p>Parking payment information</p>
         </div>

         <span class="card-heading-icon">
             <i class="fa-solid fa-wallet"></i>
         </span>
     </div>

     <div class="payment-total">
         <span>Total Amount</span>
         <strong> ৳{{ $sessionData['amount'] }} </strong>
     </div>

     <div class="payment-details">
         <div>
             <span>Payment Method</span>
             <strong>{{ $sessionData['payment_method'] }}</strong>
         </div>

         <div>
             <span>Payment Status</span>
             <strong>{{ $sessionData['payment_status'] }}</strong>
         </div>

         <div>
             <span>Transaction ID</span>
             <strong>{{ $sessionData['transaction_id'] }}</strong>
         </div>
     </div>
 </div>
