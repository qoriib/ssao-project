@extends('layouts.auth')

@section('title', 'Login - SSAO')

@section('form')
    <h2 class="text-warning fw-semibold mb-4">Log In</h2>

    <form method="POST" action="{{ route('login.submit') }}">
        @csrf

        <div class="form-group mb-3">
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="form-control auth-input @error('email') is-invalid @enderror" placeholder="Username">
            @error('email')
                <div class="text-danger small text-start mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-4">
            <input type="password" name="password" required
                   class="form-control auth-input @error('password') is-invalid @enderror" placeholder="Password">
            @error('password')
                <div class="text-danger small text-start mt-1">{{ $message }}</div>
            @enderror
        </div>

        <p class="mt-2 small">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-decoration-none fw-semibold text-warning">Daftar di sini</a>
        </p>
        
        <button type="submit" class="btn btn-warning auth-btn">Login</button>
    </form>

@endsection