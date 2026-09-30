@extends('parkflow.layouts.app')

@section('title', 'Permission Details')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/permission_page/show_page/permission_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/permission_page/show_page/permission_card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/permission_page/show_page/permission_details.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/permission_page/show_page/permission_status.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/permission_page/show_page/permission_actions.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/permission_page/show_page/permission_resp.css') }}">
@endpush

@section('content')
    <div class="permission-header">
        <div>
            <div class="permission-eyebrow"> <i class="fa-solid fa-key"></i>
                Access Control </div>


            <h1>Permission Details</h1>

            <p>Review the capability configuration and access-control information.</p>
        </div>

        <a href="{{ route('permissions.index') }}" class="permission-secondary-btn">
            <i class="fa-solid fa-arrow-left"></i>
            Back to Permissions
        </a>
    </div>

    <div class="permission-show-card">
        <div class="permission-card-top">
            <div class="permission-identity">
                <div class="permission-icon">
                    <i class="fa-solid fa-key"></i>
                </div>

                <div>
                    <span class="permission-label">Permission</span>

                    <h2>{{ $permission->name }}</h2>

                    <p>
                        Capability ID #{{ $permission->id }}
                    </p>
                </div>
            </div>

            <div class="permission-status">
                <span class="permission-status-dot"></span>
                Active
            </div>
        </div>

        <div class="permission-details">
            <div class="permission-detail">
                <div class="permission-detail-icon">
                    <i class="fa-solid fa-key"></i>
                </div>

                <div>
                    <span>Permission Name</span>
                    <strong>{{ $permission->name }}</strong>
                </div>
            </div>

            <div class="permission-detail">
                <div class="permission-detail-icon">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>

                <div>
                    <span>Guard Name</span>
                    <strong>{{ $permission->guard_name }}</strong>
                </div>
            </div>

            <div class="permission-detail">
                <div class="permission-detail-icon">
                    <i class="fa-solid fa-fingerprint"></i>
                </div>

                <div>
                    <span>Permission ID</span>
                    <strong>#{{ $permission->id }}</strong>
                </div>
            </div>

            <div class="permission-detail">
                <div class="permission-detail-icon">
                    <i class="fa-solid fa-calendar-plus"></i>
                </div>

                <div>
                    <span>Created</span>
                    <strong>{{ $permission->created_at->format('d M Y, h:i A') }}</strong>
                </div>
            </div>

            <div class="permission-detail">
                <div class="permission-detail-icon">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </div>

                <div>
                    <span>Last Updated</span>
                    <strong>{{ $permission->updated_at->format('d M Y, h:i A') }}</strong>
                </div>
            </div>

            <div class="permission-detail">
                <div class="permission-detail-icon">
                    <i class="fa-solid fa-user-shield"></i>
                </div>

                <div>
                    <span>Authentication</span>
                    <strong>Web Guard</strong>
                </div>
            </div>
        </div>

        <div class="permission-info">
            <div class="permission-info-icon">
                <i class="fa-solid fa-circle-info"></i>
            </div>

            <div>
                <strong>Access Control Capability</strong>

                <p>
                    This permission represents a specific capability within ParkFlow.
                    It can be assigned to one or more roles to control access to protected
                    application features.
                </p>
            </div>
        </div>

        <div class="permission-actions">
            <a href="{{ route('permissions.edit', $permission) }}" class="permission-primary-btn">
                <i class="fa-solid fa-pen-to-square"></i>
                Edit Permission
            </a>

            <a href="{{ route('permissions.index') }}" class="permission-secondary-btn">
                <i class="fa-solid fa-list"></i>
                All Permissions
            </a>
        </div>
    </div>
@endsection
