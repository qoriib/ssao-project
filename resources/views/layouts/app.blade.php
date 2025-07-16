<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'SSAO')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom, #fffbe6, #fdf5d3);
            min-height: 100vh;
            padding-bottom: 60px;
        }

        .card {
            border-radius: 20px;
        }

        .btn-primary, .btn-warning {
            border-radius: 50px;
        }

        .shadow-sm {
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        a {
            text-decoration: none;
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>