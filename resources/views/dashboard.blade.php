@extends('layouts.app')

@section('title', 'Dashboard - SSAO')

@section('content')
<div class="container py-4" style="max-width: 600px;">
    {{-- Welcome Section --}}
    <div class="text-center mb-4">
        <h1 class="fw-bold" style="font-size: 40px;">SSAO</h1>
        <p class="text-muted mb-1">Hello, Welcome to the SSAO App!</p>
        <p>Choose the best supplier & allocate your order easily here!</p>
    </div>

    {{-- Main Illustration --}}
    <div class="text-center mb-4">
        <img src="{{ asset('images/dashboard-illustration.jpg') }}" alt="Illustration" class="img-fluid rounded shadow" >
    </div>

    {{-- Menu Cards --}}
    <div class="row mb-4">
        <div class="col-6 text-center">
            <a href="{{ route('user.guide') }}" class="text-decoration-none">
                <div class="card shadow-sm p-2 rounded-4 border-0" style="background-color: #fef8e6;">
                    <img src="{{ asset('images/user-guide.jpg') }}" alt="User Guide" class="img-fluid mb-2">
                    <h6 class="fw-bold text-dark">User Guide</h6>
                </div>
            </a>
        </div>
        <div class="col-6 text-center">
            <a href="{{ route('rating.step1') }}" class="text-decoration-none">
                <div class="card shadow-sm p-2 rounded-4 border-0" style="background-color: #fef8e6;">
                    <img src="{{ asset('images/supplier-rating.jpg') }}" alt="Supplier Rating" class="img-fluid mb-2">
                    <h6 class="fw-bold text-dark">Supplier Rating</h6>
                </div>
            </a>
        </div>
    </div>

    {{-- History Section --}}
    <div class="card rounded-4 shadow-sm border-0" style="background-color: #fffbe6;">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="fw-bold mb-0">History</h6>
                <a href="{{ route('history') }}" class="text-decoration-none text-danger small">See All</a>
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($histories as $history)
                <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0">
                    <span>{{ \Carbon\Carbon::parse($history->date)->format('d/m/Y') }}</span>
                    <span class="fw-bold">{{ $history->flour_requirement }} Kg</span>
                    <a href="{{ route('rating.result', $history->id) }}" class="text-warning fw-bold">&gt;</a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection