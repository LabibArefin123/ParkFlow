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

                            <td> {{ $location->phone ?? '—' }}</td>
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
                                    <a href="{{ route('parking_locations.show', $location) }}"
                                        class="location-action" title="View">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    <a href="{{ route('parking_locations.edit', $location) }}"
                                        class="location-action" title="Edit">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    <form action="{{ route('parking_locations.destroy', $location) }}" method="POST"
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
