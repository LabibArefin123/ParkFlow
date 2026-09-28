 <div class="session-vehicle-card">
     <div class="vehicle-card-top">
         <div class="vehicle-main-icon">
             <i class="{{ $sessionData['vehicle_icon'] }}"></i>
         </div>
         <div class="vehicle-main-info">
             <span class="vehicle-label"> Vehicle </span>
             <h2> {{ $sessionData['vehicle_number'] }}</h2>
             <span class="vehicle-type"> {{ $sessionData['vehicle_type'] }}</span>
         </div>

         <div class="vehicle-session-number">
             <span>SESSION</span>
             <strong>#{{ $parkingSession->id }}</strong>
         </div>
     </div>

     <div class="vehicle-card-divider"></div>
     <div class="vehicle-summary">
         <div class="summary-item">
             <span class="summary-icon">
                 <i class="fa-solid fa-location-dot"></i>
             </span>

             <div>
                 <span>Parking Spot</span>
                 <strong>{{ $sessionData['spot_number'] }}</strong>
             </div>
         </div>

         <div class="summary-item">
             <span class="summary-icon">
                 <i class="fa-solid fa-building"></i>
             </span>

             <div>
                 <span>Location</span>
                 <strong>{{ $sessionData['location_name'] }}</strong>
             </div>
         </div>

         <div class="summary-item">
             <span class="summary-icon">
                 <i class="fa-regular fa-clock"></i>
             </span>

             <div>
                 <span>Duration</span>
                 <strong>{{ $sessionData['duration'] }}</strong>
             </div>
         </div>
     </div>
 </div>
