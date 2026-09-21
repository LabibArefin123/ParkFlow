  <div class="panel">
      <div class="panel-header">
          <h2 class="panel-title">Quick Actions</h2>
      </div>

      <div class="panel-body">
          <div class="quick-actions">
              <a href="{{ route('vehicle_entries.index') }}" class="quick-action">
                  <div class="quick-icon">
                      <i class="fas fa-sign-in-alt"></i>
                  </div>

                  <div class="quick-text">
                      <strong>Vehicle Entry</strong>
                      <span>Register a new parking vehicle</span>
                  </div>
              </a>

              <a href="{{ route('vehicle_exits.index') }}" class="quick-action">
                  <div class="quick-icon">
                      <i class="fas fa-sign-out-alt"></i>
                  </div>

                  <div class="quick-text">
                      <strong>Vehicle Exit</strong>
                      <span>Complete an active parking session</span>
                  </div>
              </a>

              <a href="{{ route('parking.map') }}" class="quick-action">
                  <div class="quick-icon">
                      <i class="fas fa-map-marked-alt"></i>
                  </div>

                  <div class="quick-text">
                      <strong>Parking Map</strong>
                      <span>Check available parking spaces</span>
                  </div>
              </a>
          </div>
      </div>
  </div>
