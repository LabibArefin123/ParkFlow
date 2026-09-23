@extends('parkflow.layouts.app')

@section('title', 'System User')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/user_page/show_page/user_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/user_page/show_page/user_profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/user_page/show_page/user_details.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/user_page/show_page/user_roles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/user_page/show_page/user_actions.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/user_page/show_page/user_resp.css') }}">
@endpush

@section('content')
    <div class="rp-page">
        <div class="rp-header">
            <div>
                <div class="rp-eyebrow">
                    <i class="fa-solid fa-user"></i>
                    Administration
                </div>

                <h1>System User</h1>
                <p>View account information and assigned system access. </p>
            </div>

            <div class="rp-header-actions">

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

        <div class="rp-profile-card">

            <div class="rp-profile-top">

                <div class="rp-profile-avatar">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>

                <div class="rp-profile-info">

                    <h2>
                        {{ $user->name }}
                    </h2>

                    <p>
                        {{ $user->email }}
                    </p>

                    @if ($user->id === auth()->id())
                        <span class="rp-current-user">
                            <i class="fa-solid fa-circle"></i>
                            Current User
                        </span>
                    @endif

                </div>

            </div>

            <div class="rp-profile-body">

                <div class="rp-details-grid">

                    <div class="rp-detail-item">

                        <div class="rp-detail-label">
                            <i class="fa-regular fa-user"></i>
                            Full Name
                        </div>

                        <div class="rp-detail-value">
                            {{ $user->name }}
                        </div>

                    </div>

                    <div class="rp-detail-item">

                        <div class="rp-detail-label">
                            <i class="fa-regular fa-envelope"></i>
                            Email Address
                        </div>

                        <div class="rp-detail-value email">
                            {{ $user->email }}
                        </div>

                    </div>

                    <div class="rp-detail-item">

                        <div class="rp-detail-label">
                            <i class="fa-solid fa-calendar-plus"></i>
                            Joined
                        </div>

                        <div class="rp-detail-value">
                            {{ $user->created_at?->format('d M Y, h:i A') ?? '-' }}
                        </div>

                    </div>

                    <div class="rp-detail-item">

                        <div class="rp-detail-label">
                            <i class="fa-solid fa-clock"></i>
                            Last Updated
                        </div>

                        <div class="rp-detail-value">
                            {{ $user->updated_at?->format('d M Y, h:i A') ?? '-' }}
                        </div>

                    </div>

                </div>

                <div class="rp-role-section">

                    <h3>
                        <i class="fa-solid fa-user-shield"></i>
                        Assigned Roles
                    </h3>

                    @forelse($user->roles as $role)
                        <span class="rp-show-role">
                            <i class="fa-solid fa-shield-halved"></i>
                            {{ $role->name }}
                        </span>

                    @empty

                        <span class="rp-no-role">
                            No role assigned.
                        </span>
                    @endforelse

                </div>

                <div class="rp-actions-panel">
                    <a href="{{ route('users.index') }}" class="rp-secondary-btn">
                        Close
                    </a>

                    <a href="{{ route('users.edit', $user) }}" class="rp-primary-btn">
                        <i class="fa-solid fa-pen"></i>
                        Edit User
                    </a>

                    @if ($user->id !== auth()->id())
                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="delete-form">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="rp-danger-btn">
                                <i class="fa-regular fa-trash-can"></i>
                                Delete User
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
