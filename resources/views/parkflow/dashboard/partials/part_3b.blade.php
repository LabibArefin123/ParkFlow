  <div class="panel">
      <div class="panel-header">
          <h2 class="panel-title">Active Sessions</h2>
          <a href="{{ route('sessions.active') }}" class="panel-link">View All</a>
      </div>

      <div class="panel-body">
          <div class="session-list">

              @foreach ($activeSessions as $session)
                  <div class="session-item">

                      <div class="vehicle-icon">
                          @if ($session['type'] === 'Motorcycle')
                              <i class="fas fa-motorcycle"></i>
                          @elseif($session['type'] === 'Microbus')
                              <i class="fas fa-bus"></i>
                          @else
                              <i class="fas fa-car"></i>
                          @endif
                      </div>

                      <div class="session-info">
                          <div class="vehicle-number">
                              {{ $session['vehicle'] }}
                          </div>

                          <div class="session-meta">
                              {{ $session['spot'] }} · {{ $session['entry_time'] }}
                          </div>
                      </div>

                      <div class="session-duration">
                          {{ $session['duration'] }}
                          <small>{{ $session['type'] }}</small>
                      </div>

                  </div>
              @endforeach

          </div>
      </div>
  </div>
