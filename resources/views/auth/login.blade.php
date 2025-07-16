@extends('layouts.auth')

@section('title', 'Login')

@section('form')
<form method="POST" action="{{ route('login.submit') }}">
    @csrf

    <div class="mb-3">
        <input type="email" name="email" class="form-control rounded-pill px-3 @error('email') is-invalid @enderror"
               placeholder="Email" value="{{ old('email') }}" required autofocus>
        @error('email')
            <div class="invalid-feedback text-center">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <input type="password" name="password" class="form-control rounded-pill px-3 @error('password') is-invalid @enderror"
               placeholder="Password" required>
        @error('password')
            <div class="invalid-feedback text-center">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-grid mb-3">
        <button type="submit" class="btn btn-primary rounded-pill fw-semibold">Login</button>
    </div>

    <p class="text-center small mb-0">
        Belum punya akun? <a href="{{ route('register') }}" class="text-decoration-none">Register</a>
    </p>
</form>
@endsection