<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print Full Analysis - SSAO</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            padding: 30px;
            color: #000;
        }
        h1, h2, h4 {
            margin: 0 0 10px;
        }
        .section {
            margin-bottom: 30px;
        }
        .section h4 {
            margin-bottom: 10px;
            border-bottom: 2px solid #ccc;
            padding-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 14px;
        }
        table, th, td {
            border: 1px solid #aaa;
        }
        th, td {
            padding: 8px;
        }
        ul {
            list-style: none;
            padding-left: 0;
            margin: 0;
        }
        .no-print {
            text-align: right;
            margin-bottom: 20px;
        }
        .no-print button {
            padding: 8px 16px;
            font-weight: bold;
            background-color: #444;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        .text-right {
            text-align: right;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="no-print">
    <button onclick="window.print()">Print / Save PDF</button>
</div>

<h1>SSAO - Full Analysis</h1>
<p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($rating->date)->format('d/m/Y') }}</p>
<p><strong>Kebutuhan Tepung:</strong> {{ $rating->flour_requirement }} Kg</p>

<div class="section">
    <h4>Supplier Alternative Data</h4>
    @foreach ($suppliers as $s)
        <div style="margin-bottom: 10px;">
            <strong>{{ $s['name'] }}</strong>
            <ul>
                <li>Price per Kg: Rp{{ number_format($s['price_per_kg']) }}</li>
                <li>Minimum Order: {{ $s['min_order'] }} Kg</li>
                <li>Maximum Order: {{ $s['max_order'] }} Kg</li>
                <li>Lead Time: {{ $s['delivery_time_history'] }} Days</li>
                <li>Reject Quality: {{ $s['reject_quality_history'] }} Kg</li>
                <li>Quantity Shortage: {{ $s['shortage_history'] }} Kg</li>
            </ul>
        </div>
    @endforeach
</div>

<div class="section">
    <h4>Performance Evaluation</h4>
    <table>
        <thead>
            <tr>
                <th>Supplier</th>
                <th>Score</th>
                <th>Rank</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($evaluations as $eval)
                <tr>
                    <td>{{ $eval['name'] }}</td>
                    <td>{{ $eval['score'] }}</td>
                    <td>{{ $eval['rank'] }}</td>
                    <td>{{ $eval['status'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="section">
    <h4>Order Allocation</h4>
    <table>
        <thead>
            <tr>
                <th>Supplier</th>
                <th class="text-right">Allocated (Kg)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allocation as $supplier => $amount)
                <tr>
                    <td>{{ $supplier }}</td>
                    <td class="text-right">{{ $amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="section">
    <h4>Optimal Solution</h4>
    <table>
        <tbody>
            <tr><td>Lead Time</td><td>{{ $solution['lead_time'] }} Hari.Kg</td></tr>
            <tr><td>Reject Quality</td><td>{{ $solution['reject_quality'] }} Kg</td></tr>
            <tr><td>Quantity Shortage</td><td>{{ $solution['shortage'] }} Kg</td></tr>
            <tr><td>Unmet Demand</td><td>{{ $solution['unmet_demand'] }}%</td></tr>
        </tbody>
    </table>
</div>

</body>
</html>