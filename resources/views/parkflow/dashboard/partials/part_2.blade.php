  <div class="stats-grid">
      <div class="stat-card">
          <div class="stat-top">
              <div class="stat-label">Total Spaces</div>
              <div class="stat-icon">
                  <i class="fas fa-th-large"></i>
              </div>
          </div>
          <div class="stat-value">{{ number_format($stats['total_spaces']) }}</div>
          <div class="stat-meta">Parking spaces across the facility</div>
      </div>

      <div class="stat-card">
          <div class="stat-top">
              <div class="stat-label">Available Spaces</div>
              <div class="stat-icon">
                  <i class="fas fa-check"></i>
              </div>
          </div>
          <div class="stat-value">{{ number_format($stats['available_spaces']) }}</div>
          <div class="stat-meta">Currently available for parking</div>
      </div>

      <div class="stat-card">
          <div class="stat-top">
              <div class="stat-label">Occupied Spaces</div>
              <div class="stat-icon">
                  <i class="fas fa-car-side"></i>
              </div>
          </div>
          <div class="stat-value">{{ number_format($stats['occupied_spaces']) }}</div>
          <div class="stat-meta">Vehicles currently parked</div>
      </div>

      <div class="stat-card">
          <div class="stat-top">
              <div class="stat-label">Today's Revenue</div>
              <div class="stat-icon">
                  <i class="fas fa-bangladeshi-taka-sign"></i>
              </div>
          </div>
          <div class="stat-value">৳{{ number_format($stats['today_revenue']) }}</div>
          <div class="stat-meta">Total parking revenue today</div>
      </div>
  </div>
