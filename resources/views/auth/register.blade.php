@extends('layouts.auth')

@section('title', 'Register - SSAO')

@section('form')
    <form method="POST" action="{{ route('register.submit') }}">
        @csrf

        <div class="mb-3">
            <input type="text" name="name" value="{{ old('name') }}" required
                   class="form-control rounded-pill px-3 @error('name') is-invalid @enderror" placeholder="Name">
            @error('name')
                <div class="invalid-feedback text-center">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <input type="email" name="email" value="{{ old('email') }}" required
                   class="form-control rounded-pill px-3 @error('email') is-invalid @enderror" placeholder="Email">
            @error('email')
                <div class="invalid-feedback text-center">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <input type="password" name="password" required
                   class="form-control rounded-pill px-3 @error('password') is-invalid @enderror" placeholder="Password">
            @error('password')
                <div class="invalid-feedback text-center">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <input type="password" name="password_confirmation" required
                   class="form-control rounded-pill px-3" placeholder="Confirm Password">
        </div>

        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-warning rounded-pill fw-semibold">Register</button>
        </div>

        <p class="text-center small mb-0">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-decoration-none fw-semibold text-warning">Login di sini</a>
        </p>
    </form>
@endsection