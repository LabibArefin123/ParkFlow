  <div class="parkflow-sidebar-section">
      <div class="parkflow-sidebar-heading"> Overview </div>
      <a href="{{ route('dashboard') }}"
          class="parkflow-sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
          <span class="parkflow-sidebar-icon">
              <i class="fa-solid fa-chart-pie"></i>
          </span>

          <span class="parkflow-sidebar-label">
              Dashboard
          </span>
      </a>

      <a href="{{ route('parking.map') }}"
          class="parkflow-sidebar-link {{ request()->routeIs('parking.map') ? 'active' : '' }}">
          <span class="parkflow-sidebar-icon">
              <i class="fa-solid fa-map-location-dot"></i>
          </span>
          <span class="parkflow-sidebar-label">Parking Map</span>
      </a>
  </div>
