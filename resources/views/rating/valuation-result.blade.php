@extends('layouts.app')

@section('title', 'Valuation Result')

@section('content')
<div class="container py-4" style="max-width: 700px;">
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('history') }}" class="me-2 text-dark fw-bold">&larr;</a>
        <h5 class="mb-0 fw-semibold">Valuation Result</h5>
    </div>

    <div class="text-center mb-3">
        <h1 class="fw-bold" style="letter-spacing: 2px;">SSAO</h1>
        <p class="fst-italic">Seleksi Supplier & Alokasi Order</p>
    </div>

    <div class="mb-4">
        <p class="mb-1">Flour Requirements</p>
        <div class="d-flex justify-content-between">
            <strong>{{ $rating->flour_requirement }} Kg</strong>
            <span>{{ \Carbon\Carbon::parse($rating->date)->format('d/m/Y') }}</span>
        </div>
    </div>

    <hr>

    <div class="mb-4">
        <h6 class="fw-bold mb-2">Supplier Performance Evaluation</h6>
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Supplier Name</th>
                    <th>Value</th>
                    <th>Rank</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($evaluations as $eval)
                    <tr>
                        <td>{{ $eval['name'] }}</td>
                        <td>{{ $eval['score'] }}</td>
                        <td>{{ $eval['rank'] }}</td>
                        <td>{{ $eval['status'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mb-4">
        <h6 class="fw-bold mb-2">Optimal Solution</h6>
        <ul class="list-unstyled mb-0">
            <li>Optimal Lead Time: {{ $solution['lead_time'] }} Days.Kg</li>
            <li>Optimal Reject Quality: {{ $solution['reject_quality'] }} Kg</li>
            <li>Optimal Quantity Shortage: {{ $solution['shortage'] }} Kg</li>
            <li>Optimal Unmet Demand: {{ $solution['unmet_demand'] }}%</li>
        </ul>
    </div>

    <div class="mb-4">
        <h6 class="fw-bold mb-2">Order Allocation</h6>
        <ul class="list-group">
            @foreach ($allocation as $supplier => $amount)
                <li class="list-group-item d-flex justify-content-between">
                    <span>{{ $supplier }}</span>
                    <strong>{{ $amount }} Kg</strong>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="d-grid gap-3">
        <a href="{{ route('rating.analysis', $rating->id) }}" class="btn btn-warning rounded-pill fw-semibold">Full Analysis</a>
        <a href="{{ route('rating.print', $rating->id) }}" target="_blank" class="btn btn-outline-dark rounded-pill fw-semibold">Download Valuation</a>
    </div>
</div>
@endsection