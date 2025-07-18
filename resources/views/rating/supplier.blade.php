@extends('layouts.app')

@section('title', "Supplier Step $step")

@section('content')
    <div class="container py-4" style="max-width: 500px;">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ $step === 1 ? route('rating.step1') : route('rating.supplier.step', $step - 1) }}" class="me-2 text-dark fw-bold fs-5">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <h5 class="mb-0 fw-semibold">Step {{ $step + 1 }}: Supplier Alternative {{ $step }}</h5>
        </div>

        <form method="POST" action="{{ route('rating.supplier.step.submit', $step) }}">
            @csrf

            @php
                $fields = [
                    'name' => 'Supplier Name',
                    'price_per_kg' => 'Product Price per Kg (Rp)',
                    'max_order' => 'Maximum Order (Kg)',
                    'min_order' => 'Minimum Order (Kg)',
                    'order_history' => 'Order History (Kg)',
                    'delivery_time_history' => 'Delivery Time History (Days)',
                    'reject_quality_history' => 'Reject Quality History (Kg)',
                    'shortage_history' => 'Quantity Shortage History (Kg)',
                ];
            @endphp

            @foreach ($fields as $name => $label)
                <div class="mb-3">
                    <label for="{{ $name }}" class="form-label">{{ $label }} <span class="text-danger">*</span></label>
                    <input
                        type="{{ in_array($name, ['name']) ? 'text' : 'number' }}"
                        name="{{ $name }}"
                        id="{{ $name }}"
                        class="form-control px-3 rounded-pill @error($name) is-invalid @enderror"
                        required
                        value="{{ old($name) }}"
                    >
                    @error($name)
                        <div class="invalid-feedback text-center">{{ $message }}</div>
                    @enderror
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary rounded-pill w-100 fw-semibold">
                {{ $step < 3 ? 'Next Supplier' : 'Continue to Priority' }}
                <i class="fa-solid fa-arrow-right ms-1"></i>
            </button>
        </form>
    </div>
@endsection