  <div class="dashboard-header">
      <div>
          <h1 class="dashboard-title">Parking Dashboard</h1>
          <p class="dashboard-subtitle">Monitor your parking operations, vehicles and revenue.</p>
      </div>

      <div class="header-actions">
          <a href="{{ route('parking.map') }}" class="pf-btn">
              <i class="fas fa-map"></i>
              Parking Map
          </a>

        <a href="{{ route('vehicle_entries.index') }}" class="pf-btn pf-btn-primary">
              <i class="fas fa-car"></i>
              Vehicle Entry
          </a>
      </div>
  </div>
