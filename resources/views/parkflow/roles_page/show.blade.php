@extends('parkflow.layouts.app')

@section('title', 'View Role')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/roles_page/show_page/role_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/roles_page/show_page/role_form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/roles_page/show_page/role_fields.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/roles_page/show_page/role_permissions.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/roles_page/show_page/role_footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/roles_page/show_page/role_resp.css') }}">
@endpush

@section('content')
    <div class="rp-page">

        <div class="rp-header">
            <div>

                <div class="rp-eyebrow">
                    <i class="fa-solid fa-user-shield"></i>
                    Access Control
                </div>

                <h1>View Role</h1>

                <p>
                    Review role information and assigned ParkFlow permissions.
                </p>

            </div>

            <a href="{{ route('roles.index') }}" class="rp-secondary-btn">
                <i class="fa-solid fa-arrow-left"></i>
                Back
            </a>
        </div>

        <div class="rp-form-panel">

            <div class="rp-form-header">

                <div class="rp-form-icon role-icon">
                    <i class="fa-solid fa-user-shield"></i>
                </div>

                <div>
                    <h2>{{ $role->name }}</h2>

                    <p>
                        Role #{{ $role->id }}
                        ·
                        Guard: {{ $role->guard_name }}
                    </p>
                </div>

            </div>

            <div class="rp-form-grid">

                <div class="rp-field">

                    <label for="name">
                        Role Name
                    </label>

                    <div class="rp-input">

                        <i class="fa-solid fa-user-shield"></i>

                        <input type="text" id="name" value="{{ $role->name }}" readonly>

                    </div>

                </div>

                <div class="rp-field">

                    <label for="guard_name">
                        Guard Name
                    </label>

                    <div class="rp-input">

                        <i class="fa-solid fa-shield-halved"></i>

                        <input type="text" id="guard_name" value="{{ $role->guard_name }}" readonly>

                    </div>

                </div>

            </div>

            <div class="rp-permission-section">

                <div class="rp-permission-header">

                    <div>
                        <h3>
                            <i class="fa-solid fa-key"></i>
                            Assigned Permissions
                        </h3>

                        <p>
                            Permissions currently assigned to this role.
                        </p>
                    </div>

                    <div class="rp-select-all">
                        <i class="fa-solid fa-shield-check"></i>
                        <span>
                            {{ $role->permissions->count() }}
                            {{ Str::plural('Permission', $role->permissions->count()) }}
                        </span>
                    </div>

                </div>

                <div class="rp-permission-grid">

                    @forelse($permissions->groupBy(function ($permission) {
                                return explode('.', $permission->name)[0];
                            }) as $group => $groupPermissions)

                        <div class="rp-permission-group">

                            <div class="rp-permission-group-title">

                                <span>
                                    <i class="fa-solid fa-folder"></i>

                                    {{ ucwords(str_replace('_', ' ', $group)) }}
                                </span>

                                <small>
                                    {{ $groupPermissions->count() }}
                                </small>

                            </div>

                            @foreach ($groupPermissions as $permission)
                                <label class="rp-permission-item">

                                    <input type="checkbox" disabled
                                        {{ $role->permissions->contains('id', $permission->id) ? 'checked' : '' }}>

                                    <span class="rp-permission-check">
                                        <i class="fa-solid fa-check"></i>
                                    </span>

                                    <span class="rp-permission-name">
                                        {{ $permission->name }}
                                    </span>

                                </label>
                            @endforeach

                        </div>

                    @empty

                        <div class="rp-empty rp-empty-small">

                            <div class="rp-empty-icon">
                                <i class="fa-solid fa-key"></i>
                            </div>

                            <h3>No permissions available</h3>

                            <p>
                                No permissions have been created yet.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>

            <div class="rp-form-footer">

                <a href="{{ route('roles.index') }}" class="rp-secondary-btn">
                    <i class="fa-solid fa-arrow-left"></i>
                    Back
                </a>

                <a href="{{ route('roles.edit', $role) }}" class="rp-primary-btn">
                    <i class="fa-solid fa-pen"></i>
                    Edit Role
                </a>

            </div>

        </div>

    </div>
@endsection
