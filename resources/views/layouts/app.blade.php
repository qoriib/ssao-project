<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Supply Rank')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            min-height: 100vh;
            overflow-x: hidden;
            background-color: #f8f9fa;
        }

        .sidebar {
            width: 230px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            background-color: #fff;
            border-right: 1px solid #d6e0ef;
            padding: 20px 15px;
            z-index: 1000;
        }

        .sidebar .navbar-brand {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 2rem;
            display: block;
            text-align: center;
        }

        .sidebar .nav-link {
            color: #495057;
            font-weight: 500;
            padding: 8px 12px;
            border-radius: 8px;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #e7f1ff;
        }

        .header-bar {
            background-color: #ffffff;
            padding: 16px 30px;
            margin-left: 230px;
            border-bottom: 1px solid #d6e0ef;
        }

        .header-bar h6 {
            margin: 0;
            font-weight: 600;
        }

        .content-wrapper {
            margin-left: 230px;
            padding: 30px 20px;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #dee2e6;
            }

            .header-bar {
                margin-left: 0;
                padding: 14px 20px;
            }

            .content-wrapper {
                margin-left: 0;
                padding: 20px 15px;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- Sidebar --}}
    <nav class="sidebar">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            Supply Rank
        </a>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="fa-solid fa-chart-pie me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('history') }}" class="nav-link">
                    <i class="fa-solid fa-clock-rotate-left me-2"></i> History
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('rating.step1') }}" class="nav-link">
                    <i class="fa-solid fa-star-half-stroke me-2"></i> Rating
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('user.guide') }}" class="nav-link">
                    <i class="fa-solid fa-book-open me-2"></i> User Guide
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link">
                    <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
                </a>
            </li>
        </ul>
    </nav>

    {{-- Header --}}
    <header class="header-bar">
        <h6>@yield('title', 'Supply Rank')</h6>
    </header>

    {{-- Main Content --}}
    <main class="content-wrapper">
        <div class="container" style="max-width: 700px;">
            @yield('content')
        </div>
    </main>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
</html>