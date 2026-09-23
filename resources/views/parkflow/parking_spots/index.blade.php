@extends('parkflow.layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_spot/index_page/spot_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_spot/index_page/spot_stats.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_spot/index_page/spot_card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_spot/index_page/spot_table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_spot/index_page/spot_alert.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/parking_spot/index_page/spot_resp.css') }}">
    <div class="spot-page">
        <div class="spot-header">
            <div class="spot-title">
                <h1>Parking Spots</h1>
                <p>Manage parking spaces, vehicle types and availability.</p>
            </div>

            <a href="{{ route('parking_spots.create') }}" class="spot-add-btn">
                <i class="fa-solid fa-plus"></i>
                <span>Add Parking Spot</span>
            </a>

        </div>

        @if (session('success'))
            <div class="spot-alert success">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="spot-alert error">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <div class="spot-stats">
            <div class="spot-stat">
                <div class="spot-stat-icon">
                    <i class="fa-solid fa-square-parking"></i>
                </div>
                <div>
                    <div class="spot-stat-value">{{ $stats['total'] }}</div>
                    <div class="spot-stat-label">Total Spots</div>
                </div>
            </div>

            <div class="spot-stat">
                <div class="spot-stat-icon">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div>
                    <div class="spot-stat-value">{{ $stats['available'] }}</div>
                    <div class="spot-stat-label">Available</div>
                </div>
            </div>

            <div class="spot-stat">
                <div class="spot-stat-icon">
                    <i class="fa-solid fa-car"></i>
                </div>
                <div>
                    <div class="spot-stat-value">{{ $stats['occupied'] }}</div>
                    <div class="spot-stat-label">Occupied</div>
                </div>
            </div>

            <div class="spot-stat">
                <div class="spot-stat-icon">
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                </div>
                <div>
                    <div class="spot-stat-value">{{ $stats['maintenance'] }}</div>
                    <div class="spot-stat-label">Maintenance</div>
                </div>
            </div>
        </div>

        <div class="spot-card">
            <div class="spot-card-header">
                <div class="spot-card-title">
                    <h2>All Parking Spots</h2>
                    <p>View and manage every parking space in ParkFlow.</p>
                </div>
                <select class="spot-filter" id="locationFilter">
                    <option value="">All Locations</option>

                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}">
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            @if ($parkingSpots->count())
                <div class="spot-table-wrapper">
                    <table class="spot-table">
                        <thead>
                            <tr>
                                <th>Parking Spot</th>
                                <th>Location</th>
                                <th>Vehicle Type</th>
                                <th>Status</th>
                                <th>Availability</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody id="parkingSpotTable">
                            @foreach ($parkingSpots as $spot)
                                <tr data-location="{{ $spot->parking_location_id }}">
                                    <td>
                                        <div class="spot-number">
                                            <div class="spot-icon">
                                                <i class="fa-solid fa-square-parking"></i>
                                            </div>

                                            <div>
                                                <strong>{{ $spot->spot_number }}</strong>
                                                <small>{{ $spot->floor }}</small>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="spot-location">
                                            <strong>{{ $spot->parkingLocation->name }}</strong>
                                            <small>{{ $spot->parkingLocation->city }}</small>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="spot-type">
                                            @if ($spot->vehicle_type === 'motorcycle')
                                                <i class="fa-solid fa-motorcycle"></i>
                                            @elseif($spot->vehicle_type === 'microbus')
                                                <i class="fa-solid fa-van-shuttle"></i>
                                            @elseif($spot->vehicle_type === 'cng')
                                                <i class="fa-solid fa-car-side"></i>
                                            @else
                                                <i class="fa-solid fa-car"></i>
                                            @endif

                                            {{ ucfirst($spot->vehicle_type) }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="spot-status {{ $spot->status }}">
                                            <span class="spot-dot"></span>
                                            {{ ucfirst($spot->status) }}
                                        </span>
                                    </td>

                                    <td>
                                        @if ($spot->is_active)
                                            <span class="spot-active">
                                                <i class="fa-solid fa-circle-check"></i>
                                                Active
                                            </span>
                                        @else
                                            <span class="spot-inactive">
                                                <i class="fa-solid fa-circle-xmark"></i>
                                                Inactive
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="spot-actions">
                                            <a href="{{ route('parking_spots.show', $spot) }}" class="spot-action" title="View">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>

                                            <a href="{{ route('parking_spots.edit', $spot) }}" class="spot-action" title="Edit">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>

                                            <form action="{{ route('parking_spots.destroy', $spot) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this parking spot?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="spot-action" title="Delete">
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

                <div class="spot-pagination">
                    {{ $parkingSpots->links() }}
                </div>
            @else
                <div class="spot-empty">
                    <div class="spot-empty-icon">
                        <i class="fa-solid fa-square-parking"></i>
                    </div>
                    <h3>No parking spots yet</h3>
                    <p>Create your first parking spot to start managing parking capacity.</p>
                    <a href="{{ route('parking_spots.create') }}" class="spot-add-btn">
                        <i class="fa-solid fa-plus"></i>
                        Add Parking Spot
                    </a>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.getElementById('locationFilter')?.addEventListener('change', function() {
            const location = this.value;
            document.querySelectorAll('#parkingSpotTable tr').forEach(row => {
                row.style.display = !location || row.dataset.location === location ? '' : 'none';
            });
        });
    </script>

@endsection
