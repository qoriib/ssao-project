@extends('layouts.app')

@section('title', 'Analysis')

@section('content')
<div class="container py-4" style="max-width: 700px;">
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('rating.result', $rating->id) }}" class="me-2 text-dark fw-bold">&larr;</a>
        <h5 class="mb-0 fw-semibold">Analysis</h5>
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

    <div class="mb-4">
        <h6 class="fw-bold mb-2">Supplier Alternative Data Resume</h6>
        @foreach ($suppliers as $s)
            <div class="mb-3">
                <strong>{{ $s['name'] }}</strong>
                <ul class="mb-0 list-unstyled">
                    <li>Price Per Kg: Rp{{ number_format($s['price_per_kg']) }}</li>
                    <li>Minimum Order: {{ $s['min_order'] }} Kg</li>
                    <li>Maximum Order: {{ $s['max_order'] }} Kg</li>
                    <li>Lead Time: {{ $s['delivery_time_history'] }} Days</li>
                    <li>Quality Reject: {{ $s['reject_quality_history'] }} Kg</li>
                    <li>Quantity Shortage: {{ $s['shortage_history'] }} Kg</li>
                </ul>
            </div>
        @endforeach
    </div>

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
            <li>Lead Time = {{ $solution['lead_time'] }} Hari.Kg</li>
            <li>Reject Quality = {{ $solution['reject_quality'] }} Kg</li>
            <li>Quantity Shortage = {{ $solution['shortage'] }} Kg</li>
            <li>Unmet Demand = {{ $solution['unmet_demand'] }}%</li>
        </ul>
    </div>

    <div class="d-grid gap-3">
        <a href="{{ route('dashboard') }}" class="btn btn-warning rounded-pill fw-semibold">Back to Homepage</a>
        <a href="{{ route('rating.print.analysis', $rating->id) }}" target="_blank" class="btn btn-outline-dark rounded-pill fw-semibold">Download Full Analysis Results</a>
    </div>
</div>
@endsection