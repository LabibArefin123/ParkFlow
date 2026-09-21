<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Sign In | ParkFlow</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/auth/login_base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/auth/login_background.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/auth/login_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/auth/login_form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/auth/login_footer.css') }}">
</head>

<body>

    <div class="parkflow-login">

        <div class="parkflow-login-background">
            <span class="login-orb login-orb-one"></span>
            <span class="login-orb login-orb-two"></span>
            <span class="login-grid"></span>
        </div>

        <div class="parkflow-login-card">

            <div class="parkflow-login-brand">
                <div class="parkflow-login-logo">
                    @if (file_exists(public_path('images/logo.png')))
                        <img src="{{ asset('images/logo.png') }}" alt="ParkFlow">
                    @else
                        <i class="fa-solid fa-square-parking"></i>
                    @endif
                </div>

                <div class="parkflow-login-brand-text">
                    <strong>ParkFlow</strong>
                    <span>Parking Management System</span>
                </div>
            </div>

            <div class="parkflow-login-heading">
                <span class="parkflow-login-eyebrow">
                    <i class="fa-solid fa-shield-halved"></i>
                    Secure Access
                </span>

                <h1>Welcome back</h1>

                <p>
                    Sign in to manage your parking operations,
                    sessions and revenue.
                </p>
            </div>

            @if (session('success'))
                <div class="login-alert login-alert-success">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="login-alert login-alert-danger">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <div>
                        {{ $errors->first() }}
                    </div>
                </div>
            @endif

            <form action="{{ route('login.submit') }}" method="POST" class="parkflow-login-form">
                @csrf

                <div class="login-field">
                    <label for="email">
                        Email Address
                    </label>

                    <div class="login-input">
                        <i class="fa-regular fa-envelope"></i>

                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="you@example.com" autocomplete="email" autofocus required>
                    </div>

                    @error('email')
                        <small class="login-field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="login-field">
                    <div class="login-label-row">
                        <label for="password">
                            Password
                        </label>
                    </div>

                    <div class="login-input">
                        <i class="fa-solid fa-lock"></i>

                        <input type="password" id="password" name="password" placeholder="Enter your password"
                            autocomplete="current-password" required>

                        <button type="button" class="password-toggle" id="passwordToggle" aria-label="Show password">
                            <i class="fa-regular fa-eye"></i>
                        </button>
                    </div>

                    @error('password')
                        <small class="login-field-error">{{ $message }}</small>
                    @enderror
                </div>

                <label class="login-remember">
                    <input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>

                    <span class="login-checkmark">
                        <i class="fa-solid fa-check"></i>
                    </span>

                    <span>Keep me signed in</span>
                </label>

                <button type="submit" class="parkflow-login-button">
                    <span>Sign In to ParkFlow</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
            </form>

            <div class="parkflow-login-footer">
                <span>
                    <i class="fa-solid fa-circle"></i>
                    ParkFlow System
                </span>

                <span>Secure operational access</span>
            </div>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.getElementById('passwordToggle');
            const password = document.getElementById('password');

            if (toggle && password) {
                toggle.addEventListener('click', function() {
                    const isPassword = password.type === 'password';

                    password.type = isPassword ? 'text' : 'password';

                    this.innerHTML = isPassword ?
                        '<i class="fa-regular fa-eye-slash"></i>' :
                        '<i class="fa-regular fa-eye"></i>';

                    this.setAttribute(
                        'aria-label',
                        isPassword ? 'Hide password' : 'Show password'
                    );
                });
            }
        });
    </script>

</body>

</html>
