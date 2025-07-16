<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $histories = Rating::where('user_id', $userId)
            ->orderByDesc('date')
            ->take(3)
            ->get();

        $ratings = Rating::where('user_id', $userId)
            ->with('suppliers.history')
            ->get();

        $totalLeadTime = $totalReject = $totalShortage = 0;
        $count = 0;
        $supplierData = [];

        foreach ($ratings as $rating) {
            foreach ($rating->suppliers as $supplier) {
                $history = $supplier->history;

                if (!$history) continue;

                $supplierData[] = [
                    'name' => $supplier->name,
                    'lead_time' => $history->delivery_time_history,
                    'reject' => $history->reject_quality_history,
                    'shortage' => $history->shortage_history,
                    'unmet_demand' => $this->calculateUnmetDemand($rating->flour_requirement, $supplier->max_order),
                ];

                $totalLeadTime += $history->delivery_time_history;
                $totalReject += $history->reject_quality_history;
                $totalShortage += $history->shortage_history;
                $count++;
            }
        }

        $avgLeadTime = $count > 0 ? $totalLeadTime / $count : 0;
        $avgReject = $count > 0 ? $totalReject / $count : 0;
        $avgShortage = $count > 0 ? $totalShortage / $count : 0;

        // Normalisasi dan hitung skor
        $rankingData = $this->calculateSupplierScores($supplierData)->sortDesc()->take(5);

        return view('dashboard', compact(
            'histories',
            'avgLeadTime',
            'avgReject',
            'avgShortage',
            'rankingData'
        ));
    }

    protected function calculateUnmetDemand($requirement, $maxOrder)
    {
        if ($requirement == 0) return 0;
        $unmet = max(0, $requirement - $maxOrder);
        return ($unmet / $requirement) * 100;
    }

    protected function calculateSupplierScores(array $data): Collection
    {
        if (empty($data)) return collect();

        // Extract max and min for normalization
        $minLead = collect($data)->min('lead_time') ?: 1;
        $minReject = collect($data)->min('reject') ?: 1;
        $minShortage = collect($data)->min('shortage') ?: 1;
        $minUnmet = collect($data)->min('unmet_demand') ?: 1;

        $weights = [
            'lead_time' => 0.3,
            'reject' => 0.25,
            'shortage' => 0.25,
            'unmet_demand' => 0.2
        ];

        return collect($data)->mapWithKeys(function ($s) use ($weights, $minLead, $minReject, $minShortage, $minUnmet) {
            $score =
                ($minLead / max($s['lead_time'], 1)) * $weights['lead_time'] +
                ($minReject / max($s['reject'], 1)) * $weights['reject'] +
                ($minShortage / max($s['shortage'], 1)) * $weights['shortage'] +
                ($minUnmet / max($s['unmet_demand'], 1)) * $weights['unmet_demand'];

            return [$s['name'] => round($score * 100, 2)];
        });
    }
}
