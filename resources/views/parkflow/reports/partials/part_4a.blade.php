 <div class="report-panel report-panel-large">
     <div class="report-panel-header">
         <div>
             <h2>Daily Revenue</h2>
             <p>Revenue generated during the selected period.</p>
         </div>
         <div class="report-panel-icon">
             <i class="fa-solid fa-chart-line"></i>
         </div>
     </div>

     @if ($dailyRevenue->count())
         <div class="daily-revenue-list">
             @foreach ($dailyRevenue as $day)
                 <div class="daily-revenue-row">
                     <div class="daily-revenue-date">
                         <strong>{{ $day->day }}</strong>
                         <span>{{ $day->month }}</span>
                     </div>

                     <div class="daily-revenue-bar-wrapper">
                         <div class="daily-revenue-bar">
                             <span style="width:{{ $day->bar_width }}%"></span>
                         </div>
                         <small>{{ $day->transactions }} transactions</small>
                     </div>

                     <div class="daily-revenue-amount">
                         ৳{{ $day->revenue }}
                     </div>
                 </div>
             @endforeach
         </div>
     @else
         <div class="report-empty">
             <i class="fa-solid fa-chart-line"></i>
             <strong>No revenue data</strong>
             <span>No paid transactions were recorded during this period.</span>
         </div>
     @endif
 </div>
