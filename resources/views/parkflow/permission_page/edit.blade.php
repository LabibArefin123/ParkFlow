@extends('parkflow.layouts.app')

@section('title', 'Edit User')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/user_page/edit_page/user_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/user_page/edit_page/user_form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/user_page/edit_page/user_fields.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/user_page/edit_page/user_roles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/user_page/edit_page/user_footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/user_page/edit_page/user_resp.css') }}">
@endpush

@section('content')
    <div class="rp-page">
        <div class="rp-header">
            <div>
                <div class="rp-eyebrow">
                    <i class="fa-solid fa-user-pen"></i>
                    User Management
                </div>

                <h1>Edit User</h1>

                <p>Update the account details and access role for this ParkFlow user.  </p>
            </div>

            <a href="{{ route('users.index') }}" class="rp-secondary-btn">
                <i class="fa-solid fa-arrow-left"></i>
                Back
            </a>
        </div>

        <div class="rp-form-panel">
            <form action="{{ route('users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="rp-form-header">
                    <div class="rp-form-icon user-icon">
                        <i class="fa-solid fa-user-pen"></i>
                    </div>

                    <div>
                        <h2>User Details</h2>
                        <p>Modify the user's profile information and assigned role. </p>
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
                        <label for="name">Full Name <span>*</span></label>

                        <div class="rp-input">
                            <i class="fa-solid fa-user"></i>

                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                placeholder="e.g. Parking Operator">
                        </div>
                    </div>

                    <div class="rp-field">
                        <label for="email">Email Address <span>*</span> </label>
                        <div class="rp-input">
                            <i class="fa-solid fa-envelope"></i>

                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                placeholder="e.g. operator@parkflow.test">
                        </div>
                    </div>

                    <div class="rp-field">
                        <label for="password"> New Password</label>

                        <div class="rp-input">
                            <i class="fa-solid fa-lock"></i>

                            <input type="password" id="password" name="password"
                                placeholder="Leave blank to keep current password">
                        </div>

                        <small>Leave this field empty if you do not want to change the password. </small>
                    </div>

                    <div class="rp-field">
                        <label for="password_confirmation">Confirm New Password</label>
                        <div class="rp-input">
                            <i class="fa-solid fa-lock"></i>

                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="Confirm new password">
                        </div>
                    </div>
                </div>

                <div class="rp-role-section">
                    <div class="rp-role-header">
                        <div>
                            <h3>
                                <i class="fa-solid fa-user-shield"></i>
                                Assign Role
                            </h3>

                            <p>Select the access role this user should have. </p>
                        </div>
                    </div>

                    <div class="rp-role-grid">
                        @forelse ($roles as $role)
                            <label class="rp-role-item">

                                <input type="radio" name="role" value="{{ $role->name }}"
                                    {{ old('role', optional($user->roles->first())->name) === $role->name ? 'checked' : '' }}>

                                <span class="rp-role-check">
                                    <i class="fa-solid fa-check"></i>
                                </span>

                                <span class="rp-role-content">
                                    <strong>{{ $role->name }}</strong>

                                    <small>
                                        {{ $role->permissions_count ?? $role->permissions->count() }}
                                        permissions
                                    </small>
                                </span>

                            </label>
                        @empty
                            <div class="rp-empty rp-empty-small">
                                <div class="rp-empty-icon">
                                    <i class="fa-solid fa-user-shield"></i>
                                </div>

                                <h3>No roles available</h3>

                                <p>Create a role before assigning access to this user.</p>

                                <a href="{{ route('roles.create') }}" class="rp-primary-btn">
                                    <i class="fa-solid fa-plus"></i>
                                    Add Role
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="rp-form-footer">
                    <a href="{{ route('users.index') }}" class="rp-secondary-btn">
                        Cancel
                    </a>

                    <button type="submit" class="rp-primary-btn">
                        <i class="fa-solid fa-check"></i>
                        Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
