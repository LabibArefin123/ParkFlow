@extends('parkflow.layouts.app')

@section('content')

<style>
    .create-spot-page{
        max-width:1050px;
        margin:0 auto;
    }

    .create-spot-header{
        display:flex;
        align-items:center;
        gap:15px;
        margin-bottom:25px;
    }

    .spot-back{
        width:40px;
        height:40px;
        display:flex;
        align-items:center;
        justify-content:center;
        border:1px solid #e5e9ef;
        border-radius:10px;
        background:#fff;
        color:#64748b;
        transition:.2s ease;
    }

    .spot-back:hover{
        color:#d97706;
        border-color:#f5c76b;
        background:#fffbeb;
    }

    .create-spot-header h1{
        margin:0;
        color:#172033;
        font-size:27px;
        font-weight:800;
        letter-spacing:-.6px;
    }

    .create-spot-header p{
        margin:5px 0 0;
        color:#8992a3;
        font-size:13px;
    }

    .create-spot-card{
        overflow:hidden;
        background:#fff;
        border:1px solid #e8ebf1;
        border-radius:17px;
        box-shadow:0 5px 20px rgba(15,23,42,.035);
    }

    .create-spot-card-header{
        padding:21px 25px;
        border-bottom:1px solid #edf0f4;
    }

    .create-spot-card-header h2{
        margin:0;
        color:#172033;
        font-size:16px;
        font-weight:800;
    }

    .create-spot-card-header p{
        margin:5px 0 0;
        color:#8992a3;
        font-size:12px;
    }

    .create-spot-form{
        padding:25px;
    }

    .spot-form-grid{
        display:grid;
        grid-template-columns:repeat(2,1fr);
        gap:20px;
    }

    .spot-form-group{
        display:flex;
        flex-direction:column;
    }

    .spot-form-group.full{
        grid-column:1/-1;
    }

    .spot-label{
        margin-bottom:8px;
        color:#344054;
        font-size:12px;
        font-weight:700;
    }

    .required{
        color:#dc2626;
    }

    .spot-control{
        width:100%;
        min-height:45px;
        padding:0 13px;
        border:1px solid #dfe4eb;
        border-radius:10px;
        outline:none;
        background:#fff;
        color:#172033;
        font-family:inherit;
        font-size:13px;
        transition:.2s ease;
    }

    .spot-control:focus{
        border-color:#f59e0b;
        box-shadow:0 0 0 3px rgba(245,158,11,.1);
    }

    .spot-control.is-invalid{
        border-color:#ef4444;
    }

    .spot-error{
        margin-top:6px;
        color:#dc2626;
        font-size:11px;
        font-weight:600;
    }

    .spot-help{
        margin-top:6px;
        color:#98a1b1;
        font-size:10px;
    }

    .spot-info{
        display:flex;
        align-items:flex-start;
        gap:12px;
        padding:14px;
        border:1px solid #fde68a;
        border-radius:11px;
        background:#fffbeb;
    }

    .spot-info-icon{
        color:#d97706;
        font-size:15px;
        margin-top:2px;
    }

    .spot-info-text{
        color:#92400e;
        font-size:11px;
        line-height:1.6;
    }

    .spot-switch-row{
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:20px;
        min-height:45px;
        padding:0 13px;
        border:1px solid #dfe4eb;
        border-radius:10px;
        background:#fff;
    }

    .spot-switch-text{
        color:#344054;
        font-size:12px;
        font-weight:700;
    }

    .spot-switch{
        position:relative;
        width:45px;
        height:24px;
        flex-shrink:0;
    }

    .spot-switch input{
        width:0;
        height:0;
        opacity:0;
    }

    .spot-slider{
        position:absolute;
        inset:0;
        cursor:pointer;
        border-radius:30px;
        background:#cbd5e1;
        transition:.2s ease;
    }

    .spot-slider:before{
        content:"";
        position:absolute;
        width:18px;
        height:18px;
        left:3px;
        top:3px;
        border-radius:50%;
        background:#fff;
        box-shadow:0 1px 3px rgba(0,0,0,.2);
        transition:.2s ease;
    }

    .spot-switch input:checked+.spot-slider{
        background:#f59e0b;
    }

    .spot-switch input:checked+.spot-slider:before{
        transform:translateX(21px);
    }

    .create-spot-footer{
        display:flex;
        align-items:center;
        justify-content:flex-end;
        gap:10px;
        padding:18px 25px;
        border-top:1px solid #edf0f4;
        background:#fafbfc;
    }

    .spot-form-btn{
        min-height:42px;
        padding:0 17px;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        gap:8px;
        border-radius:10px;
        font-size:12px;
        font-weight:700;
        cursor:pointer;
        transition:.2s ease;
    }

    .spot-cancel{
        border:1px solid #e1e6ed;
        background:#fff;
        color:#64748b;
    }

    .spot-cancel:hover{
        background:#f8fafc;
        color:#172033;
    }

    .spot-submit{
        border:0;
        background:#f59e0b;
        color:#fff;
        box-shadow:0 6px 15px rgba(245,158,11,.18);
    }

    .spot-submit:hover{
        background:#d97706;
        transform:translateY(-1px);
    }

    @media(max-width:700px){
        .spot-form-grid{
            grid-template-columns:1fr;
        }

        .spot-form-group.full{
            grid-column:auto;
        }

        .create-spot-form{
            padding:18px;
        }

        .create-spot-footer{
            padding:16px 18px;
        }
    }
</style>

<div class="create-spot-page">

    <div class="create-spot-header">

        <a href="{{ route('parking_spots.index') }}" class="spot-back">
            <i class="fa-solid fa-arrow-left"></i>
        </a>

        <div>
            <h1>Add Parking Spot</h1>
            <p>Create a new parking space and assign it to a facility.</p>
        </div>

    </div>

    <div class="create-spot-card">

        <div class="create-spot-card-header">
            <h2>Parking Spot Information</h2>
            <p>Configure the location, capacity type and current status.</p>
        </div>

        <form action="{{ route('parking_spots.store') }}" method="POST">

            @csrf

            <div class="create-spot-form">

                <div class="spot-form-grid">

                    <div class="spot-form-group full">

                        <label class="spot-label">
                            Parking Location <span class="required">*</span>
                        </label>

                        <select
                            name="parking_location_id"
                            class="spot-control @error('parking_location_id') is-invalid @enderror"
                            required
                        >
                            <option value="">Select Parking Location</option>

                            @foreach($parkingLocations as $location)

                                <option
                                    value="{{ $location->id }}"
                                    {{ old('parking_location_id')==$location->id?'selected':'' }}
                                >
                                    {{ $location->name }} — {{ $location->city }}
                                </option>

                            @endforeach

                        </select>

                        @error('parking_location_id')
                            <span class="spot-error">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="spot-form-group">

                        <label class="spot-label">
                            Floor <span class="required">*</span>
                        </label>

                        <select
                            name="floor"
                            class="spot-control @error('floor') is-invalid @enderror"
                            required
                        >
                            <option value="">Select Floor</option>
                            <option value="Ground Floor" {{ old('floor')==='Ground Floor'?'selected':'' }}>Ground Floor</option>
                            <option value="Level 1" {{ old('floor')==='Level 1'?'selected':'' }}>Level 1</option>
                            <option value="Level 2" {{ old('floor')==='Level 2'?'selected':'' }}>Level 2</option>
                            <option value="Level 3" {{ old('floor')==='Level 3'?'selected':'' }}>Level 3</option>
                            <option value="Basement 1" {{ old('floor')==='Basement 1'?'selected':'' }}>Basement 1</option>
                            <option value="Basement 2" {{ old('floor')==='Basement 2'?'selected':'' }}>Basement 2</option>
                        </select>

                        @error('floor')
                            <span class="spot-error">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="spot-form-group">

                        <label class="spot-label">
                            Spot Number <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            name="spot_number"
                            value="{{ old('spot_number') }}"
                            class="spot-control @error('spot_number') is-invalid @enderror"
                            placeholder="A-001"
                            required
                        >

                        <span class="spot-help">
                            Example: A-001, B-015 or G-024.
                        </span>

                        @error('spot_number')
                            <span class="spot-error">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="spot-form-group">

                        <label class="spot-label">
                            Vehicle Type <span class="required">*</span>
                        </label>

                        <select
                            name="vehicle_type"
                            class="spot-control @error('vehicle_type') is-invalid @enderror"
                            required
                        >
                            <option value="">Select Vehicle Type</option>
                            <option value="car" {{ old('vehicle_type')==='car'?'selected':'' }}>Car</option>
                            <option value="motorcycle" {{ old('vehicle_type')==='motorcycle'?'selected':'' }}>Motorcycle</option>
                            <option value="microbus" {{ old('vehicle_type')==='microbus'?'selected':'' }}>Microbus</option>
                            <option value="cng" {{ old('vehicle_type')==='cng'?'selected':'' }}>CNG</option>
                        </select>

                        @error('vehicle_type')
                            <span class="spot-error">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="spot-form-group">

                        <label class="spot-label">
                            Initial Status <span class="required">*</span>
                        </label>

                        <select
                            name="status"
                            class="spot-control @error('status') is-invalid @enderror"
                            required
                        >
                            <option value="available" {{ old('status','available')==='available'?'selected':'' }}>Available</option>
                            <option value="occupied" {{ old('status')==='occupied'?'selected':'' }}>Occupied</option>
                            <option value="reserved" {{ old('status')==='reserved'?'selected':'' }}>Reserved</option>
                            <option value="maintenance" {{ old('status')==='maintenance'?'selected':'' }}>Maintenance</option>
                        </select>

                        @error('status')
                            <span class="spot-error">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="spot-form-group full">

                        <div class="spot-info">
                            <div class="spot-info-icon">
                                <i class="fa-solid fa-circle-info"></i>
                            </div>

                            <div class="spot-info-text">
                                A parking spot can only have one spot number within the same parking location.
                                The same spot number can still be used at another location.
                            </div>
                        </div>

                    </div>

                    <div class="spot-form-group">

                        <label class="spot-label">
                            Availability
                        </label>

                        <div class="spot-switch-row">

                            <span class="spot-switch-text">
                                Active Parking Spot
                            </span>

                            <label class="spot-switch">

                                <input
                                    type="checkbox"
                                    name="is_active"
                                    value="1"
                                    {{ old('is_active',true)?'checked':'' }}
                                >

                                <span class="spot-slider"></span>

                            </label>

                        </div>

                    </div>

                </div>

            </div>

            <div class="create-spot-footer">

                <a
                    href="{{ route('parking_spots.index') }}"
                    class="spot-form-btn spot-cancel"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="spot-form-btn spot-submit"
                >
                    <i class="fa-solid fa-plus"></i>
                    Create Parking Spot
                </button>

            </div>

        </form>

    </div>

</div>

@endsection