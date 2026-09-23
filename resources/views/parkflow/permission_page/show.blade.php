@extends('parkflow.layouts.app')

@section('title', 'View User')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/user_page/show_page/user_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/user_page/show_page/user_form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/user_page/show_page/user_fields.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/user_page/show_page/user_roles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/user_page/show_page/user_footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/user_page/show_page/user_resp.css') }}">
@endpush

@section('content')
    <div class="rp-page">
        <div class="rp-header">
            <div>
                <div class="rp-eyebrow">
                    <i class="fa-solid fa-user"></i>
                    User Management
                </div>

                <h1>View User</h1>

                <p>
                    Review this ParkFlow user's account details and assigned access role.
                </p>
            </div>

            <a href="{{ route('users.index') }}" class="rp-secondary-btn">
                <i class="fa-solid fa-arrow-left"></i>
                Back
            </a>
        </div>

        <div class="rp-form-panel">
            <div class="rp-form-header">
                <div class="rp-form-icon user-icon">
                    <i class="fa-solid fa-user"></i>
                </div>

                <div>
                    <h2>{{ $user->name }}</h2>
                    <p>User account information and access details. </p>
                </div>
            </div>

            <div class="rp-form-grid">
                <div class="rp-field">
                    <label> Full Name</label>
                    <div class="rp-input">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" value="{{ $user->name }}" readonly>
                    </div>
                </div>

                <div class="rp-field">
                    <label> Email Address </label>
                    <div class="rp-input">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="text" value="{{ $user->email }}" readonly>
                    </div>
                </div>

                <div class="rp-field">
                    <label>Account Created</label>
                    <div class="rp-input">
                        <i class="fa-solid fa-calendar"></i>
                        <input type="text" value="{{ $user->created_at?->format('d M Y, h:i A') }}" readonly>
                    </div>
                </div>

                <div class="rp-field">
                    <label> Last Updated </label>
                    <div class="rp-input">
                        <i class="fa-solid fa-clock"></i>

                        <input type="text" value="{{ $user->updated_at?->format('d M Y, h:i A') }}" readonly>
                    </div>
                </div>

            </div>

            <div class="rp-role-section">
                <div class="rp-role-header">
                    <div>
                        <h3>
                            <i class="fa-solid fa-user-shield"></i>
                            Assigned Role
                        </h3>

                        <p>Access role currently assigned to this user.</p>
                    </div>
                </div>

                <div class="rp-role-grid">
                    @forelse ($user->roles as $role)
                        <div class="rp-role-item rp-role-item-static">
                            <span class="rp-role-check">
                                <i class="fa-solid fa-check"></i>
                            </span>

                            <span class="rp-role-content">
                                <strong>{{ $role->name }}</strong>

                                <small> {{ $role->permissions->count() }} permissions </small>
                            </span>
                        </div>
                    @empty
                        <div class="rp-empty rp-empty-small">
                            <div class="rp-empty-icon">
                                <i class="fa-solid fa-user-slash"></i>
                            </div>

                            <h3>No role assigned</h3>

                            <p>This user does not currently have an assigned role. </p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="rp-form-footer">
                <a href="{{ route('users.index') }}" class="rp-secondary-btn">
                    <i class="fa-solid fa-arrow-left"></i>
                    Back
                </a>

                <a href="{{ route('users.edit', $user) }}" class="rp-primary-btn">
                    <i class="fa-solid fa-pen"></i>
                    Edit User
                </a>
            </div>
        </div>
    </div>
@endsection
