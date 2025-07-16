@extends('layouts.app')

@section('title', 'Edit Rating')

@section('content')
<div class="container py-4" style="max-width: 800px;">
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('history') }}" class="me-2 text-dark fw-bold">&larr;</a>
        <h5 class="mb-0 fw-semibold">Edit Rating</h5>
    </div>

    <form method="POST" action="{{ route('rating.update', $rating->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Tanggal Penilaian</label>
            <input type="date" name="date" class="form-control" value="{{ $rating->date }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kebutuhan Tepung (Kg)</label>
            <input type="number" name="flour_requirement" class="form-control" value="{{ $rating->flour_requirement }}" required>
        </div>

        <h6 class="fw-bold mt-4">Prioritas Penilaian (%)</h6>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Delivery</label>
                <input type="number" name="priority_delivery" class="form-control" value="{{ $rating->priority_delivery }}" required>
            </div>
            <div class="col-md-4 mb-3">
                <label>Reject</label>
                <input type="number" name="priority_reject" class="form-control" value="{{ $rating->priority_reject }}" required>
            </div>
            <div class="col-md-4 mb-3">
                <label>Shortage</label>
                <input type="number" name="priority_shortage" class="form-control" value="{{ $rating->priority_shortage }}" required>
            </div>
        </div>

        <hr>
        <h6 class="fw-bold">Data Supplier</h6>
        @foreach ($rating->suppliers as $index => $supplier)
            <div class="border rounded p-3 mb-4">
                <input type="hidden" name="suppliers[{{ $index }}][id]" value="{{ $supplier->id }}">

                <div class="mb-2">
                    <label>Nama Supplier</label>
                    <input type="text" name="suppliers[{{ $index }}][name]" class="form-control" value="{{ $supplier->name }}" required>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label>Harga (Rp/Kg)</label>
                        <input type="number" name="suppliers[{{ $index }}][price_per_kg]" class="form-control" value="{{ $supplier->price_per_kg }}" required>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Min Order</label>
                        <input type="number" name="suppliers[{{ $index }}][min_order]" class="form-control" value="{{ $supplier->min_order }}" required>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Max Order</label>
                        <input type="number" name="suppliers[{{ $index }}][max_order]" class="form-control" value="{{ $supplier->max_order }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label>Lead Time (Hari)</label>
                        <input type="number" name="suppliers[{{ $index }}][delivery_time_history]" class="form-control" value="{{ $supplier->history->delivery_time_history }}" required>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Reject Quality (Kg)</label>
                        <input type="number" name="suppliers[{{ $index }}][reject_quality_history]" class="form-control" value="{{ $supplier->history->reject_quality_history }}" required>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Quantity Shortage (Kg)</label>
                        <input type="number" name="suppliers[{{ $index }}][shortage_history]" class="form-control" value="{{ $supplier->history->shortage_history }}" required>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="d-grid">
            <button type="submit" class="btn btn-primary rounded-pill fw-semibold">Update Rating</button>
        </div>
    </form>
</div>
@endsection