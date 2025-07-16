@extends('layouts.app')

@section('title', "Supplier Step $step")

@section('content')
<div class="container py-4" style="max-width: 500px;">
    <h5 class="fw-semibold mb-4">Step {{ $step + 1 }}: Supplier Alternative {{ $step }}</h5>

    <form method="POST" action="{{ route('rating.supplier.step.submit', $step) }}">
        @csrf

        <div class="mb-3">
            <label>Supplier Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control rounded-pill" required>
        </div>

        <div class="mb-3">
            <label>Product Price per Kg (Rp) <span class="text-danger">*</span></label>
            <input type="number" name="price_per_kg" class="form-control rounded-pill" required>
        </div>

        <div class="mb-3">
            <label>Maximum Order (Kg) <span class="text-danger">*</span></label>
            <input type="number" name="max_order" class="form-control rounded-pill" required>
        </div>

        <div class="mb-3">
            <label>Minimum Order (Kg) <span class="text-danger">*</span></label>
            <input type="number" name="min_order" class="form-control rounded-pill" required>
        </div>

        <div class="mb-3">
            <label>Order History (Kg) <span class="text-danger">*</span></label>
            <input type="number" name="order_history" class="form-control rounded-pill" required>
        </div>

        <div class="mb-3">
            <label>Delivery Time History (Days) <span class="text-danger">*</span></label>
            <input type="number" name="delivery_time_history" class="form-control rounded-pill" required>
        </div>

        <div class="mb-3">
            <label>Reject Quality History (Kg) <span class="text-danger">*</span></label>
            <input type="number" name="reject_quality_history" class="form-control rounded-pill" required>
        </div>

        <div class="mb-4">
            <label>Quantity Shortage History (Kg) <span class="text-danger">*</span></label>
            <input type="number" name="shortage_history" class="form-control rounded-pill" required>
        </div>

        <button type="submit" class="btn btn-warning rounded-pill w-100">
            {{ $step < 3 ? 'Next Supplier' : 'Continue to Priority' }}
        </button>
    </form>
</div>
@endsection