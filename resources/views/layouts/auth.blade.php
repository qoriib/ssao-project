<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'SSAO')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom, #fffbe6, #fdf5d3);
        }

        .auth-container {
            min-height: 100vh;
        }

        .auth-box {
            max-width: 400px;
            margin: auto;
        }

        .auth-input {
            border-radius: 50px;
            padding: 10px 20px;
        }

        .auth-btn {
            border-radius: 50px;
            padding: 10px 30px;
            font-weight: 600;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container d-flex align-items-center justify-content-center auth-container">
        <div class="auth-box text-center w-100">
            <h1 class="fw-bold" style="font-size: 48px;">SSAO</h1>
            <p class="fst-italic mb-4" style="font-size: 14px;">Seleksi Supplier & Alokasi Order</p>

            @yield('form')
        </div>
    </div>
</body>
</html>