  <div class="panel">
      <div class="panel-header">
          <h2 class="panel-title">Active Sessions</h2>
          <a href="{{ route('sessions.active') }}" class="panel-link">View All</a>
      </div>

      <div class="panel-body">
          <div class="session-list">
              @forelse ($activeSessions as $session)
                  <div class="session-item">
                      <div class="vehicle-icon">
                          @if ($session->vehicle?->type === 'Motorcycle')
                              <i class="fas fa-motorcycle"></i>
                          @elseif ($session->vehicle?->type === 'Microbus')
                              <i class="fas fa-bus"></i>
                          @else
                              <i class="fas fa-car"></i>
                          @endif
                      </div>
                      <div class="session-info">
                          <div class="vehicle-number"> {{ $session->vehicle?->registration_number ?? 'N/A' }} </div>
                          <div class="session-meta"> {{ $session->parkingSpot?->spot_number ?? 'N/A' }} ·
                              {{ $session->entry_time?->format('h:i A') ?? 'N/A' }} </div>
                      </div>
                      <div class="session-duration"> {{ $session->duration ?? '0m' }} <small>
                              {{ $session->vehicle?->type ?? 'Vehicle' }} </small> </div>
              </div> @empty <div class="session-empty">
                      <div class="session-empty-icon"> <i class="fas fa-parking"></i> </div>
                      <div class="session-empty-title"> No Active Sessions </div>
                      <div class="session-empty-text"> There are currently no vehicles parked. </div>
                  </div>
              @endforelse
          </div>
      </div>
  </div>
