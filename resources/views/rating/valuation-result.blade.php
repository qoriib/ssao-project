@extends('layouts.app')

@section('title', 'Valuation Result')

@section('content')
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('history') }}" class="me-2 text-dark fw-bold fs-5">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <h5 class="mb-0 fw-semibold">Valuation Result</h5>
    </div>

    <div class="text-center mb-4">
        <h1 class="fw-bold">Supply Rank</h1>
    </div>

    <div class="mb-4">
        <p class="mb-1 text-muted">Flour Requirements</p>
        <div class="d-flex justify-content-between align-items-center">
            <strong>{{ $rating->flour_requirement }} Kg</strong>
            <span class="text-muted font-monospace">{{ \Carbon\Carbon::parse($rating->date)->format('d/m/Y') }}</span>
        </div>
    </div>

    <hr>

    <div class="mb-4">
        <h6 class="fw-semibold mb-3">Supplier Performance Evaluation</h6>
        <div class="table-responsive">
            <table class="table table-sm table-bordered align-middle text-center rounded-4">
                <thead>
                    <tr>
                        <th class="fw-semibold">Supplier</th>
                        <th class="fw-semibold">Score</th>
                        <th class="fw-semibold">Rank</th>
                        <th class="fw-semibold">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($evaluations as $eval)
                        <tr>
                            <td class="text-start">{{ $eval['name'] }}</td>
                            <td>{{ $eval['score'] }}</td>
                            <td>{{ $eval['rank'] }}</td>
                            <td>
                                <span class="badge {{ $eval['status'] === 'Selected' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $eval['status'] }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mb-4">
        <h6 class="fw-semibold mb-2">Optimal Solution</h6>
        <ul class="list-group list-group-flush">
            <li class="list-group-item px-0 bg-transparent d-flex align-items-center">
                <i class="fa-solid fa-clock me-2"></i>
                <span class="flex-grow-1">Lead Time</span>
                <strong class="fw-semibold ms-1">{{ $solution['lead_time'] }} Days.Kg</strong>
            </li>
            <li class="list-group-item px-0 bg-transparent d-flex align-items-center">
                <i class="fa-solid fa-times-circle me-2"></i>
                <span class="flex-grow-1">Reject Quality</span>
                <strong class="fw-semibold ms-1">{{ $solution['reject_quality'] }} Kg</strong>
            </li>
            <li class="list-group-item px-0 bg-transparent d-flex align-items-center">
                <i class="fa-solid fa-triangle-exclamation me-2"></i>
                <span class="flex-grow-1">Quantity Shortage</span>
                <strong class="fw-semibold ms-1">{{ $solution['shortage'] }} Kg</strong>
            </li>
            <li class="list-group-item px-0 bg-transparent d-flex align-items-center">
                <i class="fa-solid fa-ban me-2"></i>
                <span class="flex-grow-1">Unmet Demand</span>
                <strong class="fw-semibold ms-1">{{ $solution['unmet_demand'] }}%</strong>
            </li>
        </ul>
    </div>

    <div class="mb-4">
        <h6 class="fw-semibold mb-3">Order Allocation</h6>
        <ul class="list-group list-group-primary">
            @foreach ($allocation as $supplier => $amount)
                <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                    <span>{{ $supplier }}</span>
                    <strong class="fw-semibold">{{ $amount }} Kg</strong>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="d-grid gap-3">
        <a href="{{ route('rating.analysis', $rating->id) }}" class="btn btn-primary rounded-pill fw-semibold">
            <i class="fa-solid fa-chart-line me-1"></i> Full Analysis
        </a>
    </div>
@endsection