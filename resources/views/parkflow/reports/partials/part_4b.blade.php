 <div class="report-panel">
     <div class="report-panel-header">
         <div>
             <h2>Session Status</h2>
             <p>Parking session breakdown.</p>
         </div>
         <div class="report-panel-icon">
             <i class="fa-solid fa-chart-pie"></i>
         </div>
     </div>

     <div class="status-list">
         @foreach ($sessionStatusRows as $status)
             <div class="status-row">
                 <div>
                     <span class="status-dot {{ $status['class'] }}"></span>
                     {{ $status['label'] }}
                 </div>
                 <strong>{{ $status['count'] }}</strong>
             </div>
         @endforeach
     </div>
 </div>
