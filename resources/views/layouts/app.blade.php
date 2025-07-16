<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'SSAO')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom, #fffbe6, #fdf5d3);
            min-height: 100vh;
            padding-bottom: 70px;
        }

        .card {
            background: #fffbe6;
        }

        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #f9d77e;
            display: flex;
            justify-content: space-around;
            align-items: center;
            height: 60px;
            z-index: 1000;
        }

        .bottom-nav a,
        .bottom-nav button {
            color: #000;
            font-size: 18px;
            position: relative;
            background: none;
            border: none;
        }

        .navbar-custom {
            background-color: #f9d77e;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
        }

        .nav-link.logout-link {
            cursor: pointer;
        }
    </style>

    @stack('styles')
</head>
<body>

    <nav class="navbar navbar-expand-md navbar-custom d-none d-md-flex">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">SSAO</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a></li>
                    <li class="nav-item"><a href="{{ route('history') }}" class="nav-link">History</a></li>
                    <li class="nav-item"><a href="{{ route('rating.step1') }}" class="nav-link">Rating</a></li>
                    <li class="nav-item"><a href="{{ route('user.guide') }}" class="nav-link">User Guide</a></li>
                    <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="pb-4">
        <div class="container py-4" style="max-width: 700px;">
            @yield('content')
        </div>
    </main>

    <nav class="bottom-nav d-md-none">
        <a href="{{ route('dashboard') }}"><i class="fa-solid fa-house"></i></a>
        <a href="{{ route('history') }}"><i class="fa-solid fa-clipboard-list"></i></a>
        <a href="{{ route('rating.step1') }}"><i class="fa-solid fa-star"></i></a>
        <a href="{{ route('user.guide') }}"><i class="fa-solid fa-lightbulb"></i></a>
        <a href="{{ route('logout') }}"><i class="fa-solid fa-right-from-bracket"></i></a>
    </nav>

    @stack('scripts')
</body>
</html>