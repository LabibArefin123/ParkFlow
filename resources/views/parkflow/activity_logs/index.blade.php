@extends('parkflow.layouts.app')

@section('title', 'Activity Log')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/activity_log/activity_base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/activity_log/activity_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/activity_log/activity_stats.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/activity_log/activity_timeline.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/activity_log/activity_table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/activity_log/activity_resp.css') }}">
@endpush

@section('content')
    <div class="container-fluid py-4">
        <div class="parkflow-activity">

            <section class="activity-header">
                <div class="activity-header-content">
                    <div class="activity-eyebrow">
                        <span class="activity-eyebrow-dot"></span>
                        SECURITY & ACCOUNT CENTER
                    </div>

                    <h1>Activity & Session History</h1>

                    <p>
                        Stay informed about your account activity, active sessions, and recent
                        sign-in events. Your ParkFlow workspace, all in one place.
                    </p>

                    <div class="activity-header-meta">
                        <span><i class="fas fa-shield-halved"></i> Account activity</span>
                        <span><i class="fas fa-clock"></i> Session monitoring</span>
                    </div>
                </div>

                <div class="activity-header-visual">
                    <div class="activity-visual-orbit orbit-one"></div>
                    <div class="activity-visual-orbit orbit-two"></div>
                    <div class="activity-visual-icon">
                        <i class="fas fa-shield-heart"></i>
                    </div>
                    <span class="activity-visual-check">
                        <i class="fas fa-check"></i>
                    </span>
                </div>
            </section>

            <section class="activity-stats">
                <div class="activity-stat-card">
                    <div class="activity-stat-icon stat-blue">
                        <i class="fas fa-laptop"></i>
                    </div>
                    <div class="activity-stat-info">
                        <span>Active Sessions</span>
                        <h3>{{ $sessions->total() }}</h3>
                        <small>Registered account sessions</small>
                    </div>
                </div>

                <div class="activity-stat-card">
                    <div class="activity-stat-icon stat-green">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div class="activity-stat-info">
                        <span>Current Session</span>
                        <h3>1</h3>
                        <small>This device is connected</small>
                    </div>
                </div>

                <div class="activity-stat-card">
                    <div class="activity-stat-icon stat-purple">
                        <i class="fas fa-list-check"></i>
                    </div>
                    <div class="activity-stat-info">
                        <span>Recorded Activities</span>
                        <h3>{{ $activities->total() }}</h3>
                        <small>Events in your activity history</small>
                    </div>
                </div>

                <div class="activity-stat-card">
                    <div class="activity-stat-icon stat-orange">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="activity-stat-info">
                        <span>Account Status</span>
                        <h3 class="activity-status-text">Protected</h3>
                        <small>Keep your sign-in details private</small>
                    </div>
                </div>
            </section>

            <section class="activity-panel">
                <div class="activity-panel-heading">
                    <div>
                        <span class="activity-section-kicker">YOUR ACCOUNT</span>
                        <h2>Recent Activity</h2>
                        <p>A quick look at events recorded for your account.</p>
                    </div>
                    <span class="activity-panel-icon">
                        <i class="fas fa-clock-rotate-left"></i>
                    </span>
                </div>

                <div class="activity-timeline">
                    @forelse($activities as $activity)
                        <div class="activity-timeline-item">
                            <div class="activity-timeline-marker">
                                <i class="fas fa-bolt"></i>
                            </div>

                            <div class="activity-timeline-content">
                                <div class="activity-timeline-top">
                                    <h3>{{ $activity->description }}</h3>
                                    <span class="activity-event-time">
                                        {{ $activity->created_at->format('d M Y, h:i A') }}
                                    </span>
                                </div>

                                <p>
                                    {{ $activity->log_name ?: 'Account activity' }}
                                    @if ($activity->properties && $activity->properties->has('ip'))
                                        <span class="activity-event-ip">
                                            <i class="fas fa-location-dot"></i>
                                            {{ $activity->properties->get('ip') }}
                                        </span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="activity-empty">
                            <div class="activity-empty-icon">
                                <i class="fas fa-leaf"></i>
                            </div>
                            <h3>Your activity timeline is clear</h3>
                            <p>When account events are recorded, you'll find them here.</p>
                        </div>
                    @endforelse
                </div>

                <div class="activity-pagination">
                    {{ $activities->links() }}
                </div>
            </section>

            <section class="activity-panel activity-session-panel">
                <div class="activity-panel-heading">
                    <div>
                        <span class="activity-section-kicker">DEVICE MANAGEMENT</span>
                        <h2>Logged-in Sessions</h2>
                        <p>Review the sessions associated with your account.</p>
                    </div>
                    <span class="activity-panel-icon">
                        <i class="fas fa-desktop"></i>
                    </span>
                </div>

                <div class="activity-table-wrap">
                    <table class="activity-table">
                        <thead>
                            <tr>
                                <th>Device / Browser</th>
                                <th>IP Address</th>
                                <th>Last Activity</th>
                                <th>Session Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($sessions as $session)
                                <tr>
                                    <td>
                                        <div class="activity-device">
                                            <span class="activity-device-icon">
                                                <i class="fas fa-laptop"></i>
                                            </span>
                                            <div>
                                                <strong>
                                                    {{ $session->id === session()->getId() ? 'This Device' : 'Other Session' }}
                                                </strong>
                                                <small>ParkFlow account session</small>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="activity-ip">
                                            {{ $session->ip_address ?? 'Unavailable' }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="activity-last-seen">
                                            {{ \Carbon\Carbon::createFromTimestamp($session->last_activity)->diffForHumans() }}
                                        </span>
                                        <small class="activity-date">
                                            {{ \Carbon\Carbon::createFromTimestamp($session->last_activity)->format('d M Y, h:i A') }}
                                        </small>
                                    </td>

                                    <td>
                                        @if ($session->id === session()->getId())
                                            <span class="activity-session-badge current">
                                                <span></span> Current
                                            </span>
                                        @else
                                            <span class="activity-session-badge active">
                                                <span></span> Active
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        <div class="activity-empty table-empty">
                                            <i class="fas fa-desktop"></i>
                                            <h3>No session records found</h3>
                                            <p>Your session information will appear here.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="activity-pagination">
                    {{ $sessions->links() }}
                </div>
            </section>

            <footer class="activity-footer-note">
                <span class="activity-footer-icon">
                    <i class="fas fa-shield-halved"></i>
                </span>
                <div>
                    <strong>Your account deserves a little attention.</strong>
                    <p>If you notice a session or activity you don't recognize, sign out of other devices and update your
                        password.</p>
                </div>
            </footer>

        </div>
    </div>
@endsection
