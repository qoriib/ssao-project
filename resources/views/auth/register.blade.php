@extends('layouts.auth')

@section('title', 'Register - SSAO')

@section('form')
    <h2 class="text-warning fw-semibold mb-4">Register</h2>

    <form method="POST" action="{{ route('register.submit') }}">
        @csrf

        <div class="form-group mb-3">
            <input type="text" name="name" value="{{ old('name') }}" required
                   class="form-control auth-input @error('name') is-invalid @enderror" placeholder="Name">
            @error('name')
                <div class="text-danger small text-start mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <input type="email" name="email" value="{{ old('email') }}" required
                   class="form-control auth-input @error('email') is-invalid @enderror" placeholder="Email">
            @error('email')
                <div class="text-danger small text-start mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <input type="password" name="password" required
                   class="form-control auth-input @error('password') is-invalid @enderror" placeholder="Password">
            @error('password')
                <div class="text-danger small text-start mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-4">
            <input type="password" name="password_confirmation" required
                   class="form-control auth-input" placeholder="Confirm Password">
        </div>

        <p class="mt-2 small">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-decoration-none fw-semibold text-warning">Login di sini</a>
        </p>
        
        <button type="submit" class="btn btn-warning auth-btn">Register</button>
    </form>
@endsection