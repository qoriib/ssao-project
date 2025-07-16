@extends('layouts.app')

@section('title', 'Rating Step 1')

@section('content')
<div class="container py-4" style="max-width: 500px;">
    <h5 class="fw-semibold mb-4">Step 1: Input Requirement</h5>

    <form method="POST" action="{{ route('rating.step1.submit') }}">
        @csrf

        <div class="mb-3">
            <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
            <input type="date" name="date" id="date" class="form-control rounded-pill" required value="{{ old('date') }}">
        </div>

        <div class="mb-4">
            <label for="flour_requirement" class="form-label">Total Flour Requirement (Kg) <span class="text-danger">*</span></label>
            <input type="number" name="flour_requirement" id="flour_requirement" class="form-control rounded-pill" required value="{{ old('flour_requirement') }}">
        </div>

        <button type="submit" class="btn btn-warning rounded-pill w-100">Next</button>
    </form>
</div>
@endsection