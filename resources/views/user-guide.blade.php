@extends('layouts.app')

@section('title', 'User Guide')

@section('content')
    <div class="d-flex align-items-center mb-3">
        <a href="{{ route('dashboard') }}" class="me-2 text-dark fw-bold fs-5">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <h5 class="mb-0 fw-semibold">User Guide</h5>
    </div>

    <div class="card shadow-sm p-4 rounded-4">
        <div class="mb-4">
            <h6 class="fw-bold text-dark">Application Objective</h6>
            <p class="mb-1">Supplier selection & order allocation aims to optimize:</p>
            <ul class="mb-0">
                <li>Minimize Delivery Time</li>
                <li>Minimize Quality Reject</li>
                <li>Minimize Quantity Shortage</li>
                <li>Minimize Unmet Demand</li>
            </ul>
        </div>

        <div class="mb-4">
            <h6 class="fw-bold text-dark">Required Data</h6>
            <ul class="mb-0">
                <li>Total flour requirement (Kg)</li>
                <li>Alternative supplier names</li>
                <li>Price per Kg from each supplier</li>
                <li>Maximum and minimum order capacities (Kg)</li>
                <li>Order quantity history</li>
                <li>Delivery time history (Lead Time in Days)</li>
                <li>Reject quality history (Kg)</li>
                <li>Unfulfilled quantity history (Kg)</li>
            </ul>
        </div>

        <div>
            <h6 class="fw-bold text-dark">Usage Limitations</h6>
            <ul class="mb-0">
                <li>Total requirement must exceed the maximum capacity of one supplier</li>
                <li>Exactly three alternative suppliers must be added</li>
                <li>Total maximum capacities from all suppliers must exceed total requirement</li>
                <li>Supplier names must be unique</li>
                <li>Priority weights must total 100%</li>
                <li>Only one respondent is allowed per assessment</li>
                <li>Criteria are fixed and cannot be customized</li>
                <li>Poor scoring suppliers are not auto-removed — reassessment is needed</li>
                <li>System minimizes objectives but does not enforce a specific target threshold</li>
            </ul>
        </div>
    </div>
</div>
@endsection