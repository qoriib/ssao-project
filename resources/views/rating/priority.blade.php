@extends('layouts.app')

@section('title', 'Set Priority')

@section('content')
    <div class="container py-4" style="max-width: 500px;">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('rating.supplier.step', 3) }}" class="me-2 text-dark fw-bold fs-5">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <h5 class="mb-0 fw-semibold">Step 5: Set Priority Weights (%)</h5>
        </div>

        @if ($errors->has('priority'))
            <div class="alert alert-danger text-center">
                {{ $errors->first('priority') }}
            </div>
        @endif

        <form method="POST" action="{{ route('rating.finish') }}">
            @csrf

            <div class="mb-3">
                <label for="priority_delivery" class="form-label">Delivery Time <span class="text-danger">*</span></label>
                <input
                    type="number"
                    name="priority_delivery"
                    id="priority_delivery"
                    class="form-control rounded-pill px-3 @error('priority_delivery') is-invalid @enderror"
                    required
                    value="{{ old('priority_delivery') }}"
                >
                @error('priority_delivery')
                    <div class="invalid-feedback text-center">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="priority_reject" class="form-label">Reject Quality <span class="text-danger">*</span></label>
                <input
                    type="number"
                    name="priority_reject"
                    id="priority_reject"
                    class="form-control rounded-pill px-3 @error('priority_reject') is-invalid @enderror"
                    required
                    value="{{ old('priority_reject') }}"
                >
                @error('priority_reject')
                    <div class="invalid-feedback text-center">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="priority_shortage" class="form-label">Quantity Shortage <span class="text-danger">*</span></label>
                <input
                    type="number"
                    name="priority_shortage"
                    id="priority_shortage"
                    class="form-control rounded-pill px-3 @error('priority_shortage') is-invalid @enderror"
                    required
                    value="{{ old('priority_shortage') }}"
                >
                @error('priority_shortage')
                    <div class="invalid-feedback text-center">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success rounded-pill w-100 fw-semibold">
                Submit Evaluation <i class="fa-solid fa-circle-check ms-1"></i>
            </button>
        </form>
    </div>
@endsection