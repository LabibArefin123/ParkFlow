<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'ParkFlow' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Global Layout CSS --}}
    <link rel="stylesheet" href="{{ asset('css/custom_backend/global_layout/global_base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/global_layout/global_navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/global_layout/global_user.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/global_layout/global_layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/global_layout/global_image.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/global_layout/global_footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend/global_layout/global_resp.css') }}">

    {{-- Page Specific CSS --}}
    @stack('styles')

</head>

<body>
    <div class="parkflow-app">
        <header class="parkflow-navbar">
            <div class="parkflow-navbar-inner">
                <a href="{{ route('dashboard') }}" class="parkflow-brand">
                    <div class="parkflow-brand-icon">
                        <img src="{{ asset('images/logo.png') }}" alt="ParkFlow Logo">
                    </div>

                    <div class="parkflow-brand-text">
                        <span class="parkflow-brand-name">ParkFlow</span>
                        <span class="parkflow-brand-subtitle">Parking Management</span>
                    </div>
                </a>

                <div class="parkflow-navbar-right">
                    <div class="parkflow-navbar-right">

                        <a href="{{ route('administration') }}" class="parkflow-admin-link">
                            <i class="fa-solid fa-shield-halved"></i>
                            <span>Administration</span>
                        </a>

                        @if ($user)
                            <div class="parkflow-user">

                                <div class="parkflow-user-avatar">
                                    {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                                </div>

                                <div class="parkflow-user-info">
                                    <span class="parkflow-user-name">
                                        {{ $user->name ?? 'User' }}
                                    </span>

                                    <span class="parkflow-user-role">
                                        ParkFlow Operator
                                    </span>
                                </div>

                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </header>

        <main class="parkflow-main">
            <div class="parkflow-container">
                @yield('content')
            </div>
        </main>
        <footer class="parkflow-footer">
            <div class="parkflow-footer-left">
                © {{ date('Y') }} ParkFlow. Parking management made simple.
            </div>

            <div class="parkflow-footer-right">
                Design and Developed by
                <a href="https://labib.work" target="_blank" rel="noopener noreferrer">
                    Md. Labib Arefin
                </a>
            </div>
        </footer>
    </div>
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
