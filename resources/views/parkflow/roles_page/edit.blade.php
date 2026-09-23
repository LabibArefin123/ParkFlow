@extends('parkflow.layouts.app')

@section('title', 'Edit Role')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/roles_page/edit_page/role_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/roles_page/edit_page/role_form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/roles_page/edit_page/role_fields.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/roles_page/edit_page/role_permissions.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/roles_page/edit_page/role_footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/roles_page/edit_page/role_resp.css') }}">
@endpush

@section('content')
    <div class="rp-page">

        <div class="rp-header">
            <div>
                <div class="rp-eyebrow">
                    <i class="fa-solid fa-user-shield"></i>
                    Access Control
                </div>

                <h1>Edit Role</h1>

                <p>
                    Update the access profile and permissions for this ParkFlow role.
                </p>
            </div>

            <a href="{{ route('roles.index') }}" class="rp-secondary-btn">
                <i class="fa-solid fa-arrow-left"></i>
                Back
            </a>
        </div>

        <div class="rp-form-panel">

            <form action="{{ route('roles.update', $role) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="rp-form-header">

                    <div class="rp-form-icon role-icon">
                        <i class="fa-solid fa-user-pen"></i>
                    </div>

                    <div>
                        <h2>Role Details</h2>
                        <p>
                            Update the role information and manage its assigned permissions.
                        </p>
                    </div>

                </div>

                @if ($errors->any())
                    <div class="rp-error">
                        <i class="fa-solid fa-circle-exclamation"></i>

                        <div>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="rp-form-grid">

                    <div class="rp-field">

                        <label for="name">
                            Role Name
                            <span>*</span>
                        </label>

                        <div class="rp-input">
                            <i class="fa-solid fa-user-shield"></i>

                            <input type="text" id="name" name="name" value="{{ old('name', $role->name) }}"
                                placeholder="e.g. Parking Operator">
                        </div>

                    </div>

                    <div class="rp-field">

                        <label for="guard_name">
                            Guard Name
                            <span>*</span>
                        </label>

                        <div class="rp-input">

                            <i class="fa-solid fa-shield-halved"></i>

                            <select id="guard_name" name="guard_name">
                                <option value="web"
                                    {{ old('guard_name', $role->guard_name) === 'web' ? 'selected' : '' }}>
                                    web
                                </option>
                            </select>

                        </div>

                    </div>

                </div>

                <div class="rp-permission-section">

                    <div class="rp-permission-header">

                        <div>
                            <h3>
                                <i class="fa-solid fa-key"></i>
                                Assign Permissions
                            </h3>

                            <p>
                                Select the capabilities this role should have.
                            </p>
                        </div>

                        <label class="rp-select-all">

                            <input type="checkbox" id="selectAllPermissions">

                            <span>Select All</span>

                        </label>

                    </div>

                    <div class="rp-permission-grid">
                        @php
                            $selectedPermissions = old('permissions', $role->permissions->pluck('id')->toArray());
                        @endphp
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

                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            class="permission-checkbox"
                                            {{ in_array($permission->id, $selectedPermissions) ? 'checked' : '' }}>

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

                                <p> Create permissions first before updating a role. </p>

                                <a href="{{ route('permissions.create') }}" class="rp-primary-btn">
                                    <i class="fa-solid fa-plus"></i>
                                    Add Permission
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="rp-form-footer">
                    <a href="{{ route('roles.index') }}" class="rp-secondary-btn">
                        Cancel
                    </a>

                    <button type="submit" class="rp-primary-btn">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Update Role
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/parkflow/role_page/edit_page/select.js') }}"></script>
    @endpush
@endsection
