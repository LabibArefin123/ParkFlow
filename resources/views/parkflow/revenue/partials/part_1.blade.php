   <div class="revenue-stats">
       <div class="revenue-stat">
           <div class="revenue-stat-top">
               <span class="revenue-stat-label">Total Revenue</span>

               <div class="revenue-stat-icon">
                   <i class="fa-solid fa-bangladeshi-taka-sign"></i>
               </div>
           </div>

           <div class="revenue-stat-value">৳{{ number_format($totalRevenue, 2) }}</div>
           <div class="revenue-stat-meta">All paid parking transactions</div>
       </div>

       <div class="revenue-stat today">
           <div class="revenue-stat-top">
               <span class="revenue-stat-label">Today's Revenue</span>

               <div class="revenue-stat-icon">
                   <i class="fa-solid fa-calendar-day"></i>
               </div>
           </div>

           <div class="revenue-stat-value">৳{{ number_format($todayRevenue, 2) }}</div>
           <div class="revenue-stat-meta">Collected today</div>
       </div>

       <div class="revenue-stat month">
           <div class="revenue-stat-top">
               <span class="revenue-stat-label">This Month</span>

               <div class="revenue-stat-icon">
                   <i class="fa-solid fa-calendar-days"></i>
               </div>
           </div>

           <div class="revenue-stat-value">৳{{ number_format($monthlyRevenue, 2) }}</div>
           <div class="revenue-stat-meta">{{ now()->format('F Y') }}</div>
       </div>

       <div class="revenue-stat transactions">

           <div class="revenue-stat-top">
               <span class="revenue-stat-label">Paid Transactions</span>

               <div class="revenue-stat-icon">
                   <i class="fa-solid fa-receipt"></i>
               </div>
           </div>

           <div class="revenue-stat-value">
               {{ number_format($paidCount) }}
           </div>

           <div class="revenue-stat-meta">
               {{ $pendingCount }} pending · {{ $failedCount }} failed
           </div>
       </div>
   </div>
