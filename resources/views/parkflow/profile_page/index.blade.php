@extends('parkflow.layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/custom_backend/profile_page/profile_base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/profile_page/profile_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/profile_page/profile_card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/profile_page/profile_overview.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/profile_page/profile_form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/profile_page/profile_security.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/profile_page/profile_responsive.css') }}">
    <div class="parkflow-profile-page"> {{-- PAGE HEADER --}} <div class="profile-page-header">
            <div> <span class="profile-eyebrow"> <i class="fa-solid fa-user-shield"></i> Account Settings </span>
                <h1>My Profile</h1>
                <p> Manage your ParkFlow account information and security settings. </p>
            </div>
            <div class="profile-header-status"> <span class="profile-status-dot"></span> Account Active </div>
        </div>
        <div class="profile-grid"> {{-- PROFILE OVERVIEW --}} <div class="profile-card profile-overview-card">
                <div class="profile-card-top"> <span class="profile-card-icon"> <i class="fa-solid fa-id-card"></i> </span>
                    <div>
                        <h3>Profile Overview</h3>
                        <p>Your account information</p>
                    </div>
                </div>
                <div class="profile-identity">
                    <div class="profile-avatar"> {{ strtoupper(substr($user->name, 0, 1)) }} </div>
                    <div class="profile-identity-info">
                        <h2>{{ $user->name }}</h2> <span> <i class="fa-solid fa-shield-halved"></i> ParkFlow Operator
                        </span>
                    </div>
                </div>
                <div class="profile-info-list">
                    <div class="profile-info-item">
                        <div class="profile-info-icon"> <i class="fa-solid fa-envelope"></i> </div>
                        <div> <small>Email Address</small> <strong>{{ $user->email }}</strong> </div> <span
                            class="profile-fixed-badge"> <i class="fa-solid fa-lock"></i> Fixed </span>
                    </div>
                    <div class="profile-info-item">
                        <div class="profile-info-icon"> <i class="fa-solid fa-calendar-check"></i> </div>
                        <div> <small>Member Since</small> <strong>
                                {{ optional($user->created_at)->format('d M Y') ?? '—' }} </strong> </div>
                    </div>
                </div>
            </div> {{-- PERSONAL INFORMATION --}} <div class="profile-card profile-personal-card">
                <div class="profile-card-top"> <span class="profile-card-icon"> <i class="fa-solid fa-user-pen"></i> </span>
                    <div>
                        <h3>Personal Information</h3>
                        <p>Update your basic account details</p>
                    </div>
                </div>
                <form action="{{ route('profile.update') }}" method="POST"> @csrf @method('PUT') <div
                        class="profile-form-group"> <label for="profile_name"> Full Name <span>*</span> </label>
                        <div class="profile-input-wrapper"> <i class="fa-solid fa-user"></i> <input type="text"
                                id="profile_name" name="name" value="{{ old('name', $user->name) }}"
                                placeholder="Enter your full name" autocomplete="name" required> </div> @error('name')
                            <small class="profile-error"> <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="profile-form-group"> <label for="profile_email"> Email Address </label>
                        <div class="profile-input-wrapper profile-input-disabled"> <i class="fa-solid fa-envelope"></i>
                            <input type="email" id="profile_email" value="{{ $user->email }}" readonly> <i
                                class="fa-solid fa-lock profile-input-lock"></i>
                        </div> <small class="profile-field-note">
                            <i class="fa-solid fa-circle-info"></i> Your email address is fixed and cannot be changed.
                        </small>
                    </div>
                    <div class="profile-form-actions"> <button type="submit" class="profile-save-btn"> <i
                                class="fa-solid fa-check"></i> Save Changes </button> </div>
                </form>
            </div> {{-- PASSWORD & SECURITY --}} <div class="profile-card profile-password-card">
                <div class="profile-card-top"> <span class="profile-card-icon password-icon"> <i
                            class="fa-solid fa-shield-halved"></i> </span>
                    <div>
                        <h3>Password & Security</h3>
                        <p>Keep your ParkFlow account protected</p>
                    </div>
                </div>
                <div class="security-notice">
                    <div class="security-notice-icon"> <i class="fa-solid fa-lock"></i> </div>
                    <div> <strong>Secure your account</strong>
                        <p> Use a strong password with at least 8 characters. </p>
                    </div>
                </div>
                <form action="{{ route('profile.password.update') }}" method="POST"> @csrf @method('PUT') <div
                        class="profile-form-group"> <label for="current_password"> Current Password <span>*</span> </label>
                        <div class="profile-input-wrapper password-wrapper"> <i class="fa-solid fa-key"></i> <input
                                type="password" id="current_password" name="current_password"
                                placeholder="Enter current password" autocomplete="current-password" required> <button
                                type="button" class="password-toggle" data-target="current_password"> <i
                                    class="fa-solid fa-eye"></i> </button> </div> @error('current_password')
                            <small class="profile-error"> <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="profile-password-row">
                        <div class="profile-form-group"> <label for="password"> New Password <span>*</span> </label>
                            <div class="profile-input-wrapper password-wrapper"> <i class="fa-solid fa-lock"></i> <input
                                    type="password" id="password" name="password" placeholder="New password"
                                    autocomplete="new-password" required> <button type="button" class="password-toggle"
                                    data-target="password"> <i class="fa-solid fa-eye"></i> </button> </div>
                            @error('password')
                                <small class="profile-error"> <i class="fa-solid fa-circle-exclamation"></i>
                                    {{ $message }} </small>
                            @enderror
                        </div>
                        <div class="profile-form-group"> <label for="password_confirmation"> Confirm Password
                                <span>*</span> </label>
                            <div class="profile-input-wrapper password-wrapper"> <i class="fa-solid fa-lock"></i> <input
                                    type="password" id="password_confirmation" name="password_confirmation"
                                    placeholder="Confirm password" autocomplete="new-password" required> <button
                                    type="button" class="password-toggle" data-target="password_confirmation"> <i
                                        class="fa-solid fa-eye"></i> </button> </div>
                        </div>
                    </div>
                    <div class="password-strength" id="passwordStrength">
                        <div class="password-strength-header"> <span>Password strength</span> <strong
                                id="passwordStrengthText"> Enter password </strong> </div>
                        <div class="password-strength-bar"> <span id="passwordStrengthFill"></span> </div>
                    </div>
                    <div class="profile-form-actions"> <button type="submit" class="profile-security-btn"> <i
                                class="fa-solid fa-key"></i> Change Password </button> </div>
                </form>
            </div> {{-- SECURITY STATUS --}} <div class="profile-card profile-security-summary">
                <div class="profile-card-top"> <span class="profile-card-icon security-status-icon"> <i
                            class="fa-solid fa-circle-check"></i> </span>
                    <div>
                        <h3>Security Status</h3>
                        <p>Your ParkFlow account security</p>
                    </div>
                </div>
                <div class="security-check-list">
                    <div class="security-check-item"> <span class="security-check-icon"> <i
                                class="fa-solid fa-circle-check"></i> </span>
                        <div> <strong>Email protected</strong> <small> Your email address is locked from editing. </small>
                        </div>
                    </div>
                    <div class="security-check-item"> <span class="security-check-icon"> <i
                                class="fa-solid fa-circle-check"></i> </span>
                        <div> <strong>Password protected</strong> <small> Password changes require your current password.
                            </small> </div>
                    </div>
                    <div class="security-check-item"> <span class="security-check-icon"> <i
                                class="fa-solid fa-circle-check"></i> </span>
                        <div> <strong>Authenticated session</strong> <small> Your profile is available only to authenticated
                                users. </small> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/parkflow/profile_page/password.js') }}"></script>
@endpush
