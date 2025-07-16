@extends('layouts.app')

@section('title', 'History')

@section('content')
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('dashboard') }}" class="me-2 text-dark fw-bold fs-5">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <h5 class="mb-0 fw-semibold">History</h5>
    </div>

    @if ($ratings->isEmpty())
        <div class="alert alert-info text-center rounded-4 shadow-sm">
            No rating history available.
        </div>
    @else
        <div class="card shadow-sm rounded-4 p-3">
            <ul class="list-group list-group-flush">
                @foreach ($ratings as $rating)
                    <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0">
                        <div>
                            <div class="fw-medium font-monospace">{{ \Carbon\Carbon::parse($rating->date)->format('d/m/Y') }}</div>
                            <div class="text-muted small">{{ $rating->flour_requirement }} Kg</div>
                        </div>
                        <a href="{{ route('rating.result', $rating->id) }}" class="text-warning fw-bold fs-5">
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection