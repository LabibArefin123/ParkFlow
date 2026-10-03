<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign In | ParkFlow</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/auth/login_base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/auth/login_background.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/auth/login_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/auth/login_form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/auth/login_footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/auth/login_notif.css') }}">
</head>

<body>


    <div class="login-notification" id="loginNotification" data-type="{{ $notificationType }}"
        data-message="{{ $notificationMessage }}" role="status" aria-live="polite">

        <span class="login-notification-icon">
            <i class="fa-solid fa-circle-info"></i>
        </span>

        <div class="login-notification-content">
            <strong id="loginNotificationTitle">Welcome to ParkFlow</strong>
            <p id="loginNotificationMessage"></p>
        </div>

        <button type="button" class="login-notification-close" id="loginNotificationClose"
            aria-label="Close notification">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <span class="login-notification-progress"></span>
    </div>

    <main class="parkflow-login">
        <div class="parkflow-login-background">
            <span class="login-orb login-orb-one"></span>
            <span class="login-orb login-orb-two"></span>
            <span class="login-grid"></span>
        </div>

        <section class="parkflow-login-card">

            <div class="login-brand-panel">
                <div class="login-brand-top">
                    <div class="parkflow-login-logo">
                        @if (file_exists(public_path('images/logo.png')))
                            <img src="{{ asset('images/logo.png') }}" alt="ParkFlow logo">
                        @else
                            <i class="fa-solid fa-square-parking"></i>
                        @endif
                    </div>

                    <div class="parkflow-login-brand-text">
                        <strong>ParkFlow</strong>
                        <span>Parking Management System</span>
                    </div>
                </div>

                <div class="login-brand-content">

                    <h1>Every parking space.<br><span>Under control.</span></h1>

                    <p>
                        Manage vehicle entries, parking sessions, locations,
                        payments and daily operations from one intelligent workspace.
                    </p>

                    <div class="login-feature-list">
                        <div class="login-feature">
                            <span><i class="fa-solid fa-car-side"></i></span>
                            <div>
                                <strong>Vehicle Management</strong>
                                <small>Track entries and exits effortlessly.</small>
                            </div>
                        </div>

                        <div class="login-feature">
                            <span><i class="fa-solid fa-chart-line"></i></span>
                            <div>
                                <strong>Operational Insights</strong>
                                <small>Keep your parking activity organized.</small>
                            </div>
                        </div>

                        <div class="login-feature">
                            <span><i class="fa-solid fa-shield-halved"></i></span>
                            <div>
                                <strong>Secure Access</strong>
                                <small>Your workspace, protected by authentication.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="login-brand-bottom">
                    <span><i class="fa-solid fa-circle"></i> SYSTEM ONLINE</span>
                    <span>Deploy • Manage • Monitor</span>
                </div>
            </div>

            <div class="login-form-panel">
                <div class="login-form-inner">

                    <div class="login-form-top">
                        <span class="login-form-icon">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <span class="login-secure-label">
                            <i class="fa-solid fa-shield-halved"></i>
                            Secure Sign In
                        </span>
                    </div>

                    <div class="parkflow-login-heading">
                        <span class="login-form-eyebrow">YOUR WORKSPACE</span>
                        <h2>Welcome back!</h2>
                        <p>Enter your account details to continue to ParkFlow.</p>
                    </div>

                    <form action="{{ route('login.submit') }}" method="POST" class="parkflow-login-form">
                        @csrf

                        <div class="login-field">
                            <label for="email">Email Address</label>
                            <div class="login-input">
                                <span class="login-input-icon"><i class="fa-regular fa-envelope"></i></span>
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    placeholder="you@example.com" autocomplete="email" autofocus required>
                            </div>
                            @error('email')
                                <small class="login-field-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="login-field">
                            <label for="password">Password</label>
                            <div class="login-input">
                                <span class="login-input-icon"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" id="password" name="password"
                                    placeholder="Enter your password" autocomplete="current-password" required>
                                <button type="button" class="password-toggle" id="passwordToggle"
                                    aria-label="Show password">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <small class="login-field-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <label class="login-remember">
                            <input type="checkbox" name="remember" value="1"
                                {{ old('remember') ? 'checked' : '' }}>
                            <span class="login-checkmark"><i class="fa-solid fa-check"></i></span>
                            <span>Keep me signed in</span>
                        </label>

                        <button type="submit" class="parkflow-login-button">
                            <span>Sign In to ParkFlow</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </form>

                    <div class="parkflow-login-footer">
                        <span><i class="fa-solid fa-circle"></i> ParkFlow System</span>
                        <span>Secure operational access</span>
                    </div>
                </div>
            </div>

        </section>
    </main>

    <script src="{{ asset('js/parkflow/auth/login_detect_init.js') }}"></script>
    <script src="{{ asset('js/parkflow/auth/login_detect_notification.js') }}"></script>
    {{-- To Detect Email Part --}}
    <script src="{{ asset('js/parkflow/auth/login_detect_email.js') }}"></script>
    {{-- To Detect Password Part --}}
    <script src="{{ asset('js/parkflow/auth/login_detect_password.js') }}"></script>
    {{-- Start of Login Validation Part --}}
    <script src="{{ asset('js/parkflow/auth/login_detect_validation.js') }}"></script>
    <script src="{{ asset('js/parkflow/auth/login_detect_field_events.js') }}"></script>
    <script src="{{ asset('js/parkflow/auth/login_detect_email_validation.js') }}"></script>
    <script src="{{ asset('js/parkflow/auth/login_detect_password_validation.js') }}"></script>
    {{-- End of Login Validation Part --}}
    <script src="{{ asset('js/parkflow/auth/login_detect_form.js') }}"></script>
</body>

</html>
