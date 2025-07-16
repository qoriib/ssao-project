<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print Evaluation - SSAO</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            padding: 20px;
        }
        h1, h2, h4 {
            margin: 0;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h4 {
            margin-bottom: 10px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid #999;
        }
        th, td {
            padding: 8px;
            font-size: 14px;
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

    <div class="no-print" style="text-align: right; margin-bottom: 20px;">
        <button onclick="window.print()" style="padding: 8px 16px; font-weight: bold;">Print</button>
    </div>

    <h1>SSAO - Print Evaluation</h1>
    <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($rating->date)->format('d/m/Y') }}</p>
    <p><strong>Kebutuhan Tepung:</strong> {{ $rating->flour_requirement }} Kg</p>

    <div class="section">
        <h4>Evaluasi Kinerja Supplier</h4>
        <table>
            <thead>
                <tr>
                    <th>Supplier</th>
                    <th>Value</th>
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
                    <th class="text-right">Jumlah (Kg)</th>
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