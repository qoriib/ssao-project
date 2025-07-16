<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print Full Analysis - SSAO</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            padding: 32px;
            color: #000;
            background: #fff;
        }
        h1 {
            font-size: 26px;
            margin-bottom: 4px;
        }
        h4 {
            font-size: 18px;
            margin-bottom: 10px;
            padding-bottom: 4px;
            border-bottom: 2px solid #e0e0e0;
        }
        .section {
            margin-bottom: 28px;
        }
        p {
            margin: 0 0 6px;
        }
        ul {
            list-style: none;
            padding-left: 0;
            margin: 6px 0 0;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            margin-top: 8px;
        }
        th, td {
            padding: 8px 10px;
            border: 1px solid #ccc;
        }
        th {
            background-color: #f9f9f9;
            font-weight: 600;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .no-print {
            text-align: right;
            margin-bottom: 20px;
        }
        .no-print button {
            background-color: #222;
            color: #fff;
            border: none;
            padding: 8px 16px;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
        }
        .supplier-name {
            font-weight: 600;
            font-size: 15px;
            margin-bottom: 4px;
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
<p><strong>Date:</strong> {{ \Carbon\Carbon::parse($rating->date)->format('d/m/Y') }}</p>
<p><strong>Flour Requirement:</strong> {{ $rating->flour_requirement }} Kg</p>

<div class="section">
    <h4>Supplier Alternative Data</h4>
    @foreach ($suppliers as $s)
        <div style="margin-bottom: 14px;">
            <div class="supplier-name">{{ $s['name'] }}</div>
            <ul style="font-size: 14px; margin-top: 6px; padding-left: 0; list-style: none;">
                <li style="display: flex; justify-content: space-between;">
                    <span>Price per Kg</span>
                    <strong>Rp{{ number_format($s['price_per_kg']) }}</strong>
                </li>
                <li style="display: flex; justify-content: space-between;">
                    <span>Minimum Order</span>
                    <strong>{{ $s['min_order'] }} Kg</strong>
                </li>
                <li style="display: flex; justify-content: space-between;">
                    <span>Maximum Order</span>
                    <strong>{{ $s['max_order'] }} Kg</strong>
                </li>
                <li style="display: flex; justify-content: space-between;">
                    <span>Lead Time</span>
                    <strong>{{ $s['delivery_time_history'] }} Days</strong>
                </li>
                <li style="display: flex; justify-content: space-between;">
                    <span>Reject Quality</span>
                    <strong>{{ $s['reject_quality_history'] }} Kg</strong>
                </li>
                <li style="display: flex; justify-content: space-between;">
                    <span>Quantity Shortage</span>
                    <strong>{{ $s['shortage_history'] }} Kg</strong>
                </li>
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
                    <td class="text-center">{{ $eval['score'] }}</td>
                    <td class="text-center">{{ $eval['rank'] }}</td>
                    <td class="text-right">{{ $eval['status'] }}</td>
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
            <tr>
                <td>Lead Time</td>
                <td class="text-right">{{ $solution['lead_time'] }} Days.Kg</td>
            </tr>
            <tr>
                <td>Reject Quality</td>
                <td class="text-right">{{ $solution['reject_quality'] }} Kg</td>
            </tr>
            <tr>
                <td>Quantity Shortage</td>
                <td class="text-right">{{ $solution['shortage'] }} Kg</td>
            </tr>
            <tr>
                <td>Unmet Demand</td>
                <td class="text-right">{{ $solution['unmet_demand'] }}%</td>
            </tr>
        </tbody>
    </table>
</div>
<script>
    window.addEventListener('load', function () {
        window.print();
    });

    window.onafterprint = function () {
        window.history.back();
    };
</script>
</body>
</html>