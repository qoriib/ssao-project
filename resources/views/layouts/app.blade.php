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
            padding-bottom: 70px;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-md border-bottom">
        <div class="container g-5">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                Supply Rank
            </a>

            {{-- Toggle button for mobile --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu"
                aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- Menu items --}}
            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav ms-auto mt-3 mt-md-0">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link">
                            <i class="fa-solid fa-chart-pie me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('history') }}" class="nav-link">
                            <i class="fa-solid fa-clock-rotate-left me-1"></i> History
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('rating.step1') }}" class="nav-link">
                            <i class="fa-solid fa-star-half-stroke me-1"></i> Rating
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.guide') }}" class="nav-link">
                            <i class="fa-solid fa-book-open me-1"></i> User Guide
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link">
                            <i class="fa-solid fa-right-from-bracket me-1"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="pb-4">
        <div class="container g-5 py-4" style="max-width: 700px;">
            @yield('content')
        </div>
    </main>

    @stack('scripts')
</body>
</html>