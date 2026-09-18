@extends('parkflow.layouts.app')

@section('content')

<style>
    .spot-page{
        max-width:1500px;
        margin:0 auto;
    }

    .spot-header{
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:20px;
        margin-bottom:25px;
    }

    .spot-title h1{
        margin:0;
        color:#172033;
        font-size:28px;
        font-weight:800;
        letter-spacing:-.6px;
    }

    .spot-title p{
        margin:6px 0 0;
        color:#8992a3;
        font-size:13px;
    }

    .spot-add-btn{
        display:inline-flex;
        align-items:center;
        justify-content:center;
        gap:8px;
        min-height:42px;
        padding:0 17px;
        border-radius:10px;
        background:#f59e0b;
        color:#fff;
        font-size:12px;
        font-weight:700;
        box-shadow:0 6px 16px rgba(245,158,11,.2);
        transition:.2s ease;
    }

    .spot-add-btn:hover{
        background:#d97706;
        color:#fff;
        transform:translateY(-1px);
    }

    .spot-stats{
        display:grid;
        grid-template-columns:repeat(4,1fr);
        gap:16px;
        margin-bottom:25px;
    }

    .spot-stat{
        display:flex;
        align-items:center;
        gap:14px;
        padding:18px;
        background:#fff;
        border:1px solid #e8ebf1;
        border-radius:15px;
        box-shadow:0 4px 15px rgba(15,23,42,.03);
    }

    .spot-stat-icon{
        width:44px;
        height:44px;
        display:flex;
        align-items:center;
        justify-content:center;
        flex-shrink:0;
        border-radius:11px;
        background:#fffbeb;
        color:#d97706;
        font-size:17px;
    }

    .spot-stat-value{
        color:#172033;
        font-size:22px;
        font-weight:800;
    }

    .spot-stat-label{
        margin-top:3px;
        color:#8992a3;
        font-size:11px;
        font-weight:600;
    }

    .spot-card{
        overflow:hidden;
        background:#fff;
        border:1px solid #e8ebf1;
        border-radius:16px;
        box-shadow:0 4px 18px rgba(15,23,42,.035);
    }

    .spot-card-header{
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:15px;
        padding:19px 22px;
        border-bottom:1px solid #edf0f4;
    }

    .spot-card-title h2{
        margin:0;
        color:#172033;
        font-size:16px;
        font-weight:800;
    }

    .spot-card-title p{
        margin:5px 0 0;
        color:#8992a3;
        font-size:11px;
    }

    .spot-filter{
        min-width:210px;
        height:38px;
        padding:0 11px;
        border:1px solid #e1e6ed;
        border-radius:9px;
        background:#fff;
        color:#475569;
        outline:none;
        font-family:inherit;
        font-size:11px;
    }

    .spot-filter:focus{
        border-color:#f59e0b;
        box-shadow:0 0 0 3px rgba(245,158,11,.08);
    }

    .spot-table-wrapper{
        overflow-x:auto;
    }

    .spot-table{
        width:100%;
        min-width:950px;
        border-collapse:collapse;
    }

    .spot-table th{
        padding:13px 20px;
        background:#fafbfc;
        color:#7b8496;
        font-size:10px;
        font-weight:800;
        letter-spacing:.5px;
        text-align:left;
        text-transform:uppercase;
        border-bottom:1px solid #edf0f4;
    }

    .spot-table td{
        padding:15px 20px;
        color:#475569;
        font-size:12px;
        border-bottom:1px solid #f0f2f5;
        vertical-align:middle;
    }

    .spot-table tbody tr:last-child td{
        border-bottom:0;
    }

    .spot-table tbody tr:hover{
        background:#fffdf7;
    }

    .spot-number{
        display:flex;
        align-items:center;
        gap:11px;
    }

    .spot-icon{
        width:39px;
        height:39px;
        display:flex;
        align-items:center;
        justify-content:center;
        border-radius:10px;
        background:#f8fafc;
        color:#475569;
    }

    .spot-number strong{
        display:block;
        color:#172033;
        font-size:13px;
        font-weight:800;
    }

    .spot-number small{
        display:block;
        margin-top:3px;
        color:#98a1b1;
        font-size:10px;
    }

    .spot-location{
        display:flex;
        flex-direction:column;
    }

    .spot-location strong{
        color:#344054;
        font-size:12px;
        font-weight:700;
    }

    .spot-location small{
        margin-top:3px;
        color:#98a1b1;
        font-size:10px;
    }

    .spot-type{
        display:inline-flex;
        align-items:center;
        gap:6px;
        padding:6px 9px;
        border-radius:8px;
        background:#f8fafc;
        color:#475569;
        font-size:10px;
        font-weight:700;
        text-transform:capitalize;
    }

    .spot-status{
        display:inline-flex;
        align-items:center;
        gap:6px;
        padding:6px 10px;
        border-radius:20px;
        font-size:10px;
        font-weight:800;
        text-transform:capitalize;
    }

    .spot-status.available{
        background:#ecfdf5;
        color:#047857;
    }

    .spot-status.occupied{
        background:#fff7ed;
        color:#c2410c;
    }

    .spot-status.reserved{
        background:#eff6ff;
        color:#1d4ed8;
    }

    .spot-status.maintenance{
        background:#fef2f2;
        color:#b91c1c;
    }

    .spot-dot{
        width:6px;
        height:6px;
        border-radius:50%;
        background:currentColor;
    }

    .spot-active{
        display:inline-flex;
        align-items:center;
        gap:6px;
        color:#047857;
        font-size:10px;
        font-weight:700;
    }

    .spot-inactive{
        display:inline-flex;
        align-items:center;
        gap:6px;
        color:#b91c1c;
        font-size:10px;
        font-weight:700;
    }

    .spot-actions{
        display:flex;
        align-items:center;
        justify-content:flex-end;
        gap:7px;
    }

    .spot-action{
        width:33px;
        height:33px;
        display:flex;
        align-items:center;
        justify-content:center;
        border:1px solid #e5e9ef;
        border-radius:8px;
        background:#fff;
        color:#64748b;
        cursor:pointer;
        transition:.2s ease;
    }

    .spot-action:hover{
        color:#d97706;
        border-color:#f5c76b;
        background:#fffbeb;
    }

    .spot-pagination{
        display:flex;
        justify-content:center;
        padding:18px;
        border-top:1px solid #edf0f4;
    }

    .spot-pagination svg{
        width:16px;
        height:16px;
    }

    .spot-alert{
        display:flex;
        align-items:center;
        gap:10px;
        margin-bottom:20px;
        padding:13px 15px;
        border-radius:11px;
        font-size:12px;
        font-weight:600;
    }

    .spot-alert.success{
        background:#ecfdf5;
        border:1px solid #bbf7d0;
        color:#047857;
    }

    .spot-alert.error{
        background:#fef2f2;
        border:1px solid #fecaca;
        color:#b91c1c;
    }

    .spot-empty{
        padding:60px 20px;
        text-align:center;
    }

    .spot-empty-icon{
        width:60px;
        height:60px;
        display:flex;
        align-items:center;
        justify-content:center;
        margin:0 auto 15px;
        border-radius:15px;
        background:#f8fafc;
        color:#94a3b8;
        font-size:22px;
    }

    .spot-empty h3{
        margin:0;
        color:#172033;
        font-size:16px;
        font-weight:800;
    }

    .spot-empty p{
        margin:6px 0 18px;
        color:#8992a3;
        font-size:12px;
    }

    @media(max-width:1000px){
        .spot-stats{
            grid-template-columns:repeat(2,1fr);
        }

        .spot-card-header{
            align-items:flex-start;
            flex-direction:column;
        }

        .spot-filter{
            width:100%;
        }
    }

    @media(max-width:700px){
        .spot-header{
            align-items:flex-start;
            flex-direction:column;
        }

        .spot-add-btn{
            width:100%;
        }

        .spot-stats{
            grid-template-columns:1fr;
        }
    }
</style>

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

    @if(session('success'))
        <div class="spot-alert success">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
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

                @foreach($locations as $location)
                    <option value="{{ $location->id }}">
                        {{ $location->name }}
                    </option>
                @endforeach

            </select>

        </div>

        @if($parkingSpots->count())

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

                        @foreach($parkingSpots as $spot)

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

                                        @if($spot->vehicle_type==='motorcycle')
                                            <i class="fa-solid fa-motorcycle"></i>
                                        @elseif($spot->vehicle_type==='microbus')
                                            <i class="fa-solid fa-van-shuttle"></i>
                                        @elseif($spot->vehicle_type==='cng')
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

                                    @if($spot->is_active)

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

                                        <a href="#" class="spot-action" title="View">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>

                                        <a href="#" class="spot-action" title="Edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>

                                        <form
                                            action="{{ route('parking_spots.destroy',$spot) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this parking spot?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="spot-action"
                                                title="Delete"
                                            >
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
    document.getElementById('locationFilter')?.addEventListener('change',function(){
        const location=this.value;
        document.querySelectorAll('#parkingSpotTable tr').forEach(row=>{
            row.style.display=!location||row.dataset.location===location?'':'none';
        });
    });
</script>

@endsection