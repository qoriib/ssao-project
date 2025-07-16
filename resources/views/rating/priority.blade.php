@extends('layouts.app')

@section('title', 'Set Priority')

@section('content')
<div class="container py-4" style="max-width: 500px;">
    <h5 class="fw-semibold mb-4">Step 5: Set Priority Weights (%)</h5>

    @if ($errors->has('priority'))
        <div class="alert alert-danger">
            {{ $errors->first('priority') }}
        </div>
    @endif

    <form method="POST" action="{{ route('rating.finish') }}">
        @csrf

        <div class="mb-3">
            <label>Delivery Time <span class="text-danger">*</span></label>
            <input type="number" name="priority_delivery" class="form-control rounded-pill" required value="{{ old('priority_delivery') }}">
        </div>

        <div class="mb-3">
            <label>Reject Quality <span class="text-danger">*</span></label>
            <input type="number" name="priority_reject" class="form-control rounded-pill" required value="{{ old('priority_reject') }}">
        </div>

        <div class="mb-4">
            <label>Quantity Shortage <span class="text-danger">*</span></label>
            <input type="number" name="priority_shortage" class="form-control rounded-pill" required value="{{ old('priority_shortage') }}">
        </div>

        <button type="submit" class="btn btn-success rounded-pill w-100">Submit Evaluation</button>
    </form>
</div>
@endsection