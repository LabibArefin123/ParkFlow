 <div class="report-panel">
     <div class="report-panel-header">
         <div>
             <h2>Vehicle Types</h2>
             <p>Vehicles entering the parking system.</p>
         </div>
         <div class="report-panel-icon">
             <i class="fa-solid fa-car"></i>
         </div>
     </div>

     @if ($vehicleTypes->count())
         <div class="breakdown-list">
             @foreach ($vehicleTypes as $type => $count)
                 <div class="breakdown-row">
                     <div class="breakdown-name">
                         <div class="breakdown-icon">
                             @if (strtolower($type) === 'motorcycle')
                                 <i class="fa-solid fa-motorcycle"></i>
                             @elseif(strtolower($type) === 'cng')
                                 <i class="fa-solid fa-car-side"></i>
                             @elseif(strtolower($type) === 'microbus')
                                 <i class="fa-solid fa-van-shuttle"></i>
                             @else
                                 <i class="fa-solid fa-car"></i>
                             @endif
                         </div>
                         <span>{{ $type }}</span>
                     </div>
                     <strong>{{ number_format($count) }}</strong>
                 </div>
             @endforeach
         </div>
     @else
         <div class="mini-empty">
             <i class="fa-solid fa-car"></i>
             No vehicle data available.
         </div>
     @endif
 </div>
