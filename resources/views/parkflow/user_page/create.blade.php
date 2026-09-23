@extends('parkflow.layouts.app')

@section('title', 'Add System User')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/user_page/create_page/user_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/user_page/create_page/user_form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/user_page/create_page/user_fields.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/user_page/create_page/user_roles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/user_page/create_page/user_footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/user_page/create_page/user_resp.css') }}">
@endpush

@section('content')
    <div class="rp-page">
        <div class="rp-header">
            <div>
                <div class="rp-eyebrow">
                    <i class="fa-solid fa-user-plus"></i>
                    Administration
                </div>
                <h1>Add System User</h1>
                <p>Create a ParkFlow account and assign an access role.</p>
            </div>
            <a href="{{ route('users.index') }}" class="rp-secondary-btn">
                <i class="fa-solid fa-arrow-left"></i>
                Back
            </a>
        </div>

        <div class="rp-form-panel">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="rp-form-header">
                    <div class="rp-form-icon user-icon">
                        <i class="fa-solid fa-user-plus"></i>
                    </div>
                    <div>
                        <h2>User Information</h2>
                        <p>Set up the user's account details and system access.</p>
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
                            Full Name
                            <span>*</span>
                        </label>
                        <div class="rp-input">
                            <i class="fa-regular fa-user"></i>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                placeholder="e.g. Rahim Ahmed" autocomplete="name">
                        </div>
                        <small>
                            Enter the user's display name.
                        </small>
                    </div>

                    <div class="rp-field">
                        <label for="email">
                            Email Address
                            <span>*</span>
                        </label>
                        <div class="rp-input">
                            <i class="fa-regular fa-envelope"></i>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                placeholder="user@example.com" autocomplete="email">
                        </div>
                        <small>This email will be used to sign in. </small>
                    </div>

                    <div class="rp-field">
                        <label for="password"> Password<span>*</span> </label>
                        <div class="rp-input">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" id="password" name="password" placeholder="Minimum 8 characters"
                                autocomplete="new-password">

                            <button type="button" class="rp-password-toggle" data-target="password">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </div>
                        <small> Use a strong password with at least 8 characters.</small>
                    </div>

                    <div class="rp-field">
                        <label for="password_confirmation">Confirm Password <span>*</span> </label>
                        <div class="rp-input">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="Repeat the password" autocomplete="new-password">
                            <button type="button" class="rp-password-toggle" data-target="password_confirmation">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="rp-user-role-section">
                    <div class="rp-role-section-header">
                        <div>
                            <h3>
                                <i class="fa-solid fa-user-shield"></i>
                                Assign Role
                            </h3>
                            <p>
                                The selected role determines what this user can access.
                            </p>
                        </div>
                    </div>

                    <div class="rp-role-options">
                        @forelse($roles as $role)
                            <label class="rp-role-option">
                                <input type="radio" name="role" value="{{ $role->name }}"
                                    {{ old('role') === $role->name ? 'checked' : '' }}>
                                <span class="rp-role-radio">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                                <span class="rp-role-option-icon">
                                    <i class="fa-solid fa-user-shield"></i>
                                </span>
                                <span class="rp-role-option-content">
                                    <strong>
                                        {{ $role->name }}
                                    </strong>
                                    <small>
                                        {{ $role->permissions()->count() }}
                                        {{ Str::plural('permission', $role->permissions()->count()) }}
                                    </small>
                                </span>
                            </label>
                        @empty
                            <div class="rp-empty rp-empty-small">
                                <div class="rp-empty-icon">
                                    <i class="fa-solid fa-user-shield"></i>
                                </div>
                                <h3>No roles available</h3>
                                <p>Create a role before assigning access to a user.</p>
                                <a href="{{ route('roles.create') }}" class="rp-primary-btn">
                                    <i class="fa-solid fa-plus"></i>
                                    Create Role
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
                        <i class="fa-solid fa-user-plus"></i>
                        Create System User
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.rp-password-toggle').forEach(function(button) {
                    button.addEventListener('click', function() {
                        const input = document.getElementById(this.dataset.target);

                        if (!input) {
                            return;
                        }

                        const visible = input.type === 'text';

                        input.type = visible ? 'password' : 'text';

                        this.innerHTML = visible ?
                            '<i class="fa-regular fa-eye"></i>' :
                            '<i class="fa-regular fa-eye-slash"></i>';
                    });
                });
            });
        </script>
    @endpush
@endsection
