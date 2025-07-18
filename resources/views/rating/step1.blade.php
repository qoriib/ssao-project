@extends('layouts.app')

@section('title', 'Input Requirement')

@section('content')
    <div class="container py-4" style="max-width: 500px;">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('dashboard') }}" class="me-2 text-dark fw-bold fs-5">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <h5 class="mb-0 fw-semibold">Step 1: Input Requirement</h5>
        </div>

        <form method="POST" action="{{ route('rating.step1.submit') }}">
            @csrf

            <div class="mb-3">
                <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                <input
                    type="date"
                    name="date"
                    id="date"
                    class="form-control px-3 rounded-pill @error('date') is-invalid @enderror"
                    required
                    value="{{ old('date') }}"
                >
                @error('date')
                    <div class="invalid-feedback text-center">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="flour_requirement" class="form-label">Total Flour Requirement (Kg) <span class="text-danger">*</span></label>
                <input
                    type="number"
                    name="flour_requirement"
                    id="flour_requirement"
                    class="form-control rounded-pill px-3 @error('flour_requirement') is-invalid @enderror"
                    required
                    value="{{ old('flour_requirement') }}"
                >
                @error('flour_requirement')
                    <div class="invalid-feedback text-center">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary rounded-pill w-100 fw-semibold">
                Next <i class="fa-solid fa-arrow-right ms-1"></i> 
            </button>
        </form>
    </div>
@endsection