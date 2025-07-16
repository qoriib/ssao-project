@extends('layouts.app')

@section('title', 'Dashboard - SSAO')

@section('content')
    <div class="text-center mb-4">
        <h1 class="fw-bold" style="font-size: 40px;">SSAO</h1>
        <p class="text-muted mb-1">Hello, Welcome to the SSAO App!</p>
        <p>Choose the best supplier & allocate your order easily here!</p>
    </div>

    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm text-center rounded-4 px-3 py-4">
                <h6 class="text-muted mb-1">Avg. Lead Time</h6>
                <h5 class="text-dark fw-semibold mb-0">{{ number_format($avgLeadTime, 2) }} days</h5>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm text-center rounded-4 px-3 py-4">
                <h6 class="text-muted mb-1">Avg. Reject</h6>
                <h5 class="text-dark fw-semibold mb-0">{{ number_format($avgReject, 2) }} Kg</h5>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm text-center rounded-4 px-3 py-4">
                <h6 class="text-muted mb-1">Avg. Shortage</h6>
                <h5 class="text-dark fw-semibold mb-0">{{ number_format($avgShortage, 2) }} Kg</h5>
            </div>
        </div>
    </div>

    <div class="mb-4">
        <div class="card shadow-sm rounded-4 p-3">
            <h5 class="fw-semibold text-center">Supplier Ranking</h5>
            <div id="rankingChart" style="height: 320px;"></div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-6 text-center">
            <a href="{{ route('user.guide') }}" class="text-decoration-none">
                <div class="card shadow-sm p-2 rounded-4">
                    <img src="{{ asset('images/user-guide.png') }}" alt="User Guide" class="img-fluid rounded-3 mb-3">
                    <h6 class="fw-semibold text-dark">User Guide</h6>
                </div>
            </a>
        </div>
        <div class="col-6 text-center">
            <a href="{{ route('rating.step1') }}" class="text-decoration-none">
                <div class="card shadow-sm p-2 rounded-4">
                    <img src="{{ asset('images/supplier-rating.png') }}" alt="Supplier Rating" class="img-fluid rounded-3 mb-3">
                    <h6 class="fw-semibold text-dark">Supplier Rating</h6>
                </div>
            </a>
        </div>
    </div>

    <div class="card rounded-4 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="fw-semibold mb-0">History</h6>
                <a href="{{ route('history') }}" class="text-danger text-decoration-none small">
                    See All
                </a>
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($histories as $history)
                    <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0">
                        <div>
                            <div class="fw-medium font-monospace">{{ \Carbon\Carbon::parse($history->date)->format('d/m/Y') }}</div>
                            <div class="text-muted small">{{ $history->flour_requirement }} Kg</div>
                        </div>
                        <a href="{{ route('rating.result', $history->id) }}" class="text-warning fw-bold fs-5">
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const options = {
            chart: {
                type: 'bar',
                height: 320,
                toolbar: {
                    show: false // Menyembunyikan menu chart (download, zoom, dll)
                }
            },
            plotOptions: {
                bar: {
                    borderRadius: 5,
                    horizontal: true
                }
            },
            dataLabels: {
                enabled: true
            },
            series: [{
                name: 'Score',
                data: @json(array_values($rankingData->toArray()))
            }],
            xaxis: {
                categories: @json(array_keys($rankingData->toArray()))
            },
            colors: ['#f9a825']
        };

        const chart = new ApexCharts(document.querySelector("#rankingChart"), options);
        chart.render();
    });
</script>
@endpush