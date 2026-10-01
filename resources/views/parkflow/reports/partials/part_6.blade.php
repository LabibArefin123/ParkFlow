 <div class="report-panel location-panel">
     <div class="report-panel-header">
         <div>
             <h2>Location Performance</h2>
             <p>Parking activity by location.</p>
         </div>
         <div class="report-panel-icon">
             <i class="fa-solid fa-location-dot"></i>
         </div>
     </div>

     @if ($locationPerformance->count())
         <div class="report-table-wrapper">
             <table class="report-table">
                 <thead>
                     <tr>
                         <th>SL</th>
                         <th>Parking Location</th>
                         <th>Total Sessions</th>
                         <th>Completed</th>
                         <th>Active</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($locationPerformance as $location => $data)
                         <tr>
                             <td>
                                 <span class="report-sl">{{ $loop->iteration }}</span>
                             </td>
                             <td>
                                 <div class="location-name">
                                     <div class="location-table-icon">
                                         <i class="fa-solid fa-location-dot"></i>
                                     </div>
                                     <strong>{{ $location }}</strong>
                                 </div>
                             </td>
                             <td>
                                 <strong>{{ number_format($data['sessions']) }}</strong>
                             </td>
                             <td>
                                 <span class="table-status completed">
                                     {{ number_format($data['completed']) }}
                                 </span>
                             </td>
                             <td>
                                 <span class="table-status active">
                                     {{ number_format($data['active']) }}
                                 </span>
                             </td>
                         </tr>
                     @endforeach
                 </tbody>
             </table>
         </div>
     @else
         <div class="report-empty">
             <i class="fa-solid fa-location-dot"></i>
             <strong>No location data</strong>
             <span>No parking sessions were recorded during this period.</span>
         </div>
     @endif
 </div>
