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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">


    @stack('styles')

    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            min-height: 100%;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f5f7fb;
            color: #172033;
        }

        a {
            text-decoration: none;
        }

        .parkflow-app {
            min-height: 100vh;
        }

        .parkflow-navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            height: 70px;
            background: #ffffff;
            border-bottom: 1px solid #e8ebf2;
            box-shadow: 0 2px 12px rgba(15, 23, 42, .04);
        }

        .parkflow-navbar-inner {
            width: 100%;
            height: 100%;
            padding: 0 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .parkflow-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #172033;
        }

        .parkflow-brand-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            background: #f59e0b;
            color: #ffffff;
            font-size: 18px;
            box-shadow: 0 6px 16px rgba(245, 158, 11, .22);
        }

        .parkflow-brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.1;
        }

        .parkflow-brand-name {
            font-size: 18px;
            font-weight: 800;
            letter-spacing: -.3px;
        }

        .parkflow-brand-subtitle {
            margin-top: 3px;
            color: #8a94a6;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: .8px;
            text-transform: uppercase;
        }

        .parkflow-navbar-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .parkflow-admin-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-height: 40px;
            padding: 0 14px;
            border: 1px solid #e4e8ef;
            border-radius: 10px;
            background: #ffffff;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
            transition: .2s ease;
        }

        .parkflow-admin-link:hover {
            color: #111827;
            border-color: #f59e0b;
            background: #fffbeb;
        }

        .parkflow-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding-left: 10px;
        }

        .parkflow-user-avatar {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #172033;
            color: #ffffff;
            font-size: 13px;
            font-weight: 700;
        }

        .parkflow-user-info {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .parkflow-user-name {
            color: #172033;
            font-size: 13px;
            font-weight: 700;
        }

        .parkflow-user-role {
            margin-top: 3px;
            color: #8a94a6;
            font-size: 11px;
            font-weight: 500;
        }

        .parkflow-main {
            min-height: calc(100vh - 70px);
            padding: 30px;
        }

        .parkflow-container {
            width: 100%;
            max-width: 1600px;
            margin: 0 auto;
        }

        .parkflow-footer {
            padding: 22px 30px 30px;
            color: #8a94a6;
            font-size: 12px;
            text-align: center;
        }

        @media(max-width:768px) {
            .parkflow-navbar {
                height: 64px;
            }

            .parkflow-navbar-inner {
                padding: 0 16px;
            }

            .parkflow-brand-subtitle,
            .parkflow-user-info,
            .parkflow-admin-link span {
                display: none;
            }

            .parkflow-main {
                min-height: calc(100vh - 64px);
                padding: 18px 14px;
            }

            .parkflow-user {
                padding-left: 4px;
            }
        }
    </style>
</head>

<body>
    <div class="parkflow-app">

        <header class="parkflow-navbar">
            <div class="parkflow-navbar-inner">

                <a href="{{ route('dashboard') }}" class="parkflow-brand">
                    <div class="parkflow-brand-icon">
                        <i class="fa-solid fa-square-parking"></i>
                    </div>

                    <div class="parkflow-brand-text">
                        <span class="parkflow-brand-name">ParkFlow</span>
                        <span class="parkflow-brand-subtitle">Parking Management</span>
                    </div>
                </a>

                <div class="parkflow-navbar-right">

                    <a href="{{ url('/admin') }}" class="parkflow-admin-link">
                        <i class="fa-solid fa-shield-halved"></i>
                        <span>Administration</span>
                    </a>

                    @auth
                        <div class="parkflow-user">
                            <div class="parkflow-user-avatar">
                                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                            </div>

                            <div class="parkflow-user-info">
                                <span class="parkflow-user-name">
                                    {{ auth()->user()->name ?? 'User' }}
                                </span>

                                <span class="parkflow-user-role">
                                    ParkFlow Operator
                                </span>
                            </div>
                        </div>
                    @endauth

                </div>

            </div>
        </header>

        <main class="parkflow-main">
            <div class="parkflow-container">
                @yield('content')
            </div>
        </main>

        <footer class="parkflow-footer">
            © {{ date('Y') }} ParkFlow. Parking management made simple.
        </footer>

    </div>

    @stack('scripts')
</body>

</html>
