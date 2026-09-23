@extends('parkflow.layouts.app')

@section('title', 'Edit System User')

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
                    Administration
                </div>
                <h1>Edit System User</h1>
                <p>Update the user's account details and system access. </p>
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
                    <div class="rp-form-icon">
                        <i class="fa-solid fa-user-pen"></i>
                    </div>

                    <div>
                        <h2>User Information</h2>
                        <p>Update the user's account details and system access. </p>
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
                        <label for="name">Full Name <span>*</span> </label>
                        <div class="rp-input">
                            <i class="fa-regular fa-user"></i>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                placeholder="e.g. Rahim Ahmed" autocomplete="name">
                        </div>

                        <small> Enter the user's display name. </small>
                    </div>

                    <div class="rp-field">
                        <label for="email">Email Address<span>*</span> </label>
                        <div class="rp-input">
                            <i class="fa-regular fa-envelope"></i>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                placeholder="user@example.com" autocomplete="email">
                        </div>

                        <small> This email will be used to sign in. </small>
                    </div>

                    <div class="rp-field">
                        <label for="password"> New Password </label>
                        <div class="rp-input">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" id="password" name="password"
                                placeholder="Leave blank to keep current password" autocomplete="new-password">

                            <button type="button" class="rp-password-toggle" data-target="password">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </div>

                        <small> Leave blank if you do not want to change the password.</small>
                    </div>

                    <div class="rp-field">
                        <label for="password_confirmation">
                            Confirm New Password
                        </label>

                        <div class="rp-input">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="Repeat the new password" autocomplete="new-password">

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

                            <p> The selected role determines what this user can access. </p>
                        </div>
                    </div>

                    <div class="rp-role-options">
                        @foreach ($roles as $role)
                            <label class="rp-role-option">
                                <input type="radio" name="role" value="{{ $role->name }}"
                                    {{ $user->hasRole($role->name) ? 'checked' : '' }}>

                                <span class="rp-role-radio">
                                    <i class="fa-solid fa-check"></i>
                                </span>

                                <span class="rp-role-option-icon">
                                    <i class="fa-solid fa-user-shield"></i>
                                </span>

                                <span class="rp-role-option-content">
                                    <strong> {{ $role->name }} </strong>

                                    <small>
                                        {{ $role->permissions()->count() }}
                                        {{ Str::plural('permission', $role->permissions()->count()) }}
                                    </small>
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="rp-form-footer">
                    <a href="{{ route('users.index') }}" class="rp-secondary-btn">
                        Cancel
                    </a>

                    <button type="submit" class="rp-primary-btn">
                        <i class="fa-solid fa-user-check"></i>
                        Update System User
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
