<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'SSAO')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Lobster&display=swap" rel="stylesheet">
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="container g-5 d-flex align-items-center justify-content-center min-vh-100">
        <div class="w-100" style="max-width: 400px;">
            <div class="text-center mb-4">
                <h1 class="fw-bold text-brand" style="font-size: 48px;">SSAO</h1>
                <p class="fst-italic text-muted" style="font-size: 14px;">Seleksi Supplier & Alokasi Order</p>
            </div>

            @yield('form')
        </div>
    </div>
</body>
</html>