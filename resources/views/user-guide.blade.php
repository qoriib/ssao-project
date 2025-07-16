@extends('layouts.app')

@section('title', 'User Guide')

@section('content')
<div class="container py-4" style="max-width: 700px;">
    {{-- Header with back --}}
    <div class="d-flex align-items-center mb-3">
        <a href="{{ route('dashboard') }}" class="me-2 text-dark fw-bold">
            &larr;
        </a>
        <h5 class="mb-0 fw-semibold">User Guide</h5>
    </div>

    {{-- Guide Content --}}
    <div class="card shadow-sm p-4" style="border-radius: 20px; background-color: #fff;">
        <div class="mb-4">
            <h6 class="fw-bold">Application Objective</h6>
            <p class="mb-1">Supplier selection & order allocation, so that can optimize:</p>
            <ul class="mb-0">
                <li>Minimize Delivery Time</li>
                <li>Minimize Quality Reject</li>
                <li>Minimize Quantity Shortage</li>
                <li>Minimize Unmet Demand</li>
            </ul>
        </div>

        <div class="mb-4">
            <h6 class="fw-bold">Data Completeness:</h6>
            <ul class="mb-0">
                <li>Total flour requirement (Kg)</li>
                <li>Name of alternative supplier</li>
                <li>Price offered by supplier (Rp/Kg)</li>
                <li>Maximum capacity of order (Kg)</li>
                <li>Minimum capacity of order (Kg)</li>
                <li>History of order quantity (Kg)</li>
                <li>History of delivery time (Lead time) required by supplier until goods are received (Days)</li>
                <li>History of Reject quality (number of non-conforming/defective products ever delivered by supplier (Kg))</li>
                <li>History of Unfulfilled quantity (number of quantity shortages) of products ever delivered by supplier (Kg)</li>
            </ul>
        </div>

        <div>
            <h6 class="fw-bold">Usage Limitation:</h6>
            <ul class="mb-0">
                <li>The number of product requirements must be greater than the maximum capacity of a supplier</li>
                <li>There must be three alternative suppliers</li>
                <li>The total sum of the maximum capacity of all suppliers must be greater than the number of product requirements</li>
                <li>The name of each supplier cannot be the same</li>
                <li>The total sum of the priority weights must be equal to 100%</li>
                <li>The assessment can only be done by one respondent</li>
                <li>The assessment criteria are only limited to those available in the system and cannot be added</li>
                <li>The system cannot automatically eliminate suppliers who have poor evaluation scores from the order allocation stage, so users must make a new assessment if they want to eliminate alternative suppliers</li>
                <li>The results of the system calculation only minimize the objective without setting a target percentage limit that must be achieved</li>
            </ul>
        </div>
    </div>
</div>
@endsection