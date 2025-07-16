<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'SSAO')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom, #fffbe6, #fdf5d3);
        }
    </style>
</head>
<body>
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="w-100" style="max-width: 400px;">
            <div class="text-center mb-4">
                <h1 class="fw-bold text-primary" style="font-size: 48px;">SSAO</h1>
                <p class="fst-italic text-muted" style="font-size: 14px;">Seleksi Supplier & Alokasi Order</p>
            </div>

            @yield('form')
        </div>
    </div>
</body>
</html>