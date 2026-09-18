@extends('parkflow.layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_location/index_page/parking_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_location/index_page/parking_stats.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_location/index_page/parking_table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_location/index_page/parking_actions.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_location/index_page/parking_alert.css') }}">
    <div class="location-page">
        <div class="location-header">
            <div class="location-title">
                <h1>Parking Locations</h1>
                <p>Manage your parking facilities and location capacity.</p>
            </div>

            <div class="location-actions">
                <a href="{{ route('parking_locations.create') }}" class="location-btn location-btn-primary">
                    <i class="fa-solid fa-plus"></i>
                    <span>Add Location</span>
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="location-alert success">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="location-alert error">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <div class="location-stats">
            <div class="location-stat">
                <div class="location-stat-icon">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <div>
                    <div class="location-stat-value">{{ $stats['total'] }}</div>
                    <div class="location-stat-label">Total Locations</div>
                </div>
            </div>

            <div class="location-stat">
                <div class="location-stat-icon">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div>
                    <div class="location-stat-value">{{ $stats['active'] }}</div>
                    <div class="location-stat-label">Active Locations</div>
                </div>
            </div>

            <div class="location-stat">
                <div class="location-stat-icon">
                    <i class="fa-solid fa-circle-xmark"></i>
                </div>
                <div>
                    <div class="location-stat-value">{{ $stats['inactive'] }}</div>
                    <div class="location-stat-label">Inactive Locations</div>
                </div>
            </div>

            <div class="location-stat">
                <div class="location-stat-icon">
                    <i class="fa-solid fa-square-parking"></i>
                </div>
                <div>
                    <div class="location-stat-value">{{ $stats['spots'] }}</div>
                    <div class="location-stat-label">Parking Spots</div>
                </div>
            </div>
        </div>

        <div class="location-card">

            <div class="location-card-header">
                <div>
                    <h2>All Parking Locations</h2>
                    <span>Manage your registered parking facilities.</span>
                </div>
            </div>

            @if ($parkingLocations->count())
                <div class="location-table-wrapper">
                    <table class="location-table">
                        <thead>
                            <tr>
                                <th>Location</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Spots</th>
                                <th>Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($parkingLocations as $location)
                                <tr>
                                    <td>
                                        <div class="location-name">
                                            <div class="location-icon">
                                                <i class="fa-solid fa-location-dot"></i>
                                            </div>

                                            <div>
                                                <strong>{{ $location->name }}</strong>
                                                <small>{{ $location->city }}</small>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="location-address">
                                            {{ $location->address }}
                                        </div>
                                    </td>

                                    <td>
                                        {{ $location->phone ?? '—' }}
                                    </td>

                                    <td>
                                        <span class="location-spots">
                                            <i class="fa-solid fa-square-parking"></i>
                                            {{ $location->parking_spots_count }}/{{ $location->total_spots }}
                                        </span>
                                    </td>

                                    <td>
                                        @if ($location->is_active)
                                            <span class="location-status active">
                                                <span class="status-dot"></span>
                                                Active
                                            </span>
                                        @else
                                            <span class="location-status inactive">
                                                <span class="status-dot"></span>
                                                Inactive
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="location-actions-cell">
                                            <a href="#" class="location-action" title="View">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>

                                            <a href="#" class="location-action" title="Edit">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>

                                            <form action="{{ route('parking_locations.destroy', $location) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this parking location?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="location-action location-delete"
                                                    title="Delete">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if ($parkingLocations->hasPages())
                    <div class="location-pagination">
                        {{ $parkingLocations->links() }}
                    </div>
                @endif
            @else
                <div class="location-empty">
                    <div class="location-empty-icon">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <h3>No parking locations yet</h3>
                    <p>Create your first parking location to start managing your facilities.</p>
                    <a href="{{ route('parking_locations.create') }}" class="location-btn location-btn-primary">
                        <i class="fa-solid fa-plus"></i>
                        Add Parking Location
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
