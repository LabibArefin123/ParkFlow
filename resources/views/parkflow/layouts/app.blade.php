<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
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
    <link rel="stylesheet" href="{{ asset('css/custom_backend/global_layout/global_sidebar.css') }}">

    {{-- Notification CSS --}}
    <link rel="stylesheet" href="{{ asset('css/custom_backend/notification_part/notifications.css') }}">

    @stack('styles')
</head>

<body>
    <div class="parkflow-app">
        {{-- Mobile Sidebar Overlay --}}
        @include('parkflow.partials.mobile_sidebar')
        {{-- Sidebar --}}
        @include('parkflow.partials.sidebar')
        <div class="parkflow-content-area">
            {{-- Navbar --}}
            @include('parkflow.partials.navbar')
            {{-- Main Content --}}
            <main class="parkflow-main">
                <div class="parkflow-container">
                    @yield('content')
                </div>
            </main>
            {{-- Footer --}}
            @include('parkflow.partials.footer')
        </div>
    </div>

    {{-- Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- ParkFlow Notification Engine --}}
    <script src="{{ asset('js/parkflow/swal_notification.js') }}"></script>
    {{-- Notification Messages --}}
    @include('parkflow.partials.swal_notification')
    {{-- Page Scripts --}}
    @stack('scripts')
    {{-- Sidebar Behaviour --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('parkflowSidebar');
            const overlay = document.getElementById('parkflowSidebarOverlay');
            const toggle = document.getElementById('parkflowSidebarToggle');
            const close = document.getElementById('parkflowSidebarClose');

            function openSidebar() {
                if (sidebar) sidebar.classList.add('open');
                if (overlay) overlay.classList.add('show');
                document.body.classList.add('sidebar-open');
            }

            function closeSidebar() {
                if (sidebar) sidebar.classList.remove('open');
                if (overlay) overlay.classList.remove('show');
                document.body.classList.remove('sidebar-open');
            }

            if (toggle) {
                toggle.addEventListener('click', openSidebar);
            }

            if (close) {
                close.addEventListener('click', closeSidebar);
            }

            if (overlay) {
                overlay.addEventListener('click', closeSidebar);
            }

            document.querySelectorAll('.parkflow-sidebar-link').forEach(function(link) {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        closeSidebar();
                    }
                });
            });

            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    closeSidebar();
                }
            });
        });
    </script>
</body>

</html>
