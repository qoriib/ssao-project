<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Supplier;
use App\Models\SupplierHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RatingController extends Controller
{
    // Step 1: Input kebutuhan & tanggal
    public function step1()
    {
        return view('rating.step1');
    }

    public function submitStep1(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'flour_requirement' => 'required|numeric|min:1',
        ]);

        Session::put('rating_step1', $request->only(['date', 'flour_requirement']));

        return redirect()->route('rating.supplier.step', ['step' => 1]);
    }

    // Step 2-4: Input supplier alternatif 1-3
    public function supplierStep($step)
    {
        if (!in_array($step, [1, 2, 3])) {
            abort(404);
        }

        return view('rating.supplier', compact('step'));
    }

    public function submitSupplierStep(Request $request, $step)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price_per_kg' => 'required|numeric|min:1',
            'max_order' => 'required|numeric|min:1',
            'min_order' => 'required|numeric|min:0',
            'order_history' => 'required|numeric|min:0',
            'delivery_time_history' => 'required|numeric|min:0',
            'reject_quality_history' => 'required|numeric|min:0',
            'shortage_history' => 'required|numeric|min:0',
        ]);

        $supplier = $request->only([
            'name',
            'price_per_kg',
            'max_order',
            'min_order',
            'order_history',
            'delivery_time_history',
            'reject_quality_history',
            'shortage_history'
        ]);

        Session::put("supplier_$step", $supplier);

        if ($step < 3) {
            return redirect()->route('rating.supplier.step', ['step' => $step + 1]);
        } else {
            return redirect()->route('rating.priority');
        }
    }

    // Step 5: Input prioritas
    public function priorityStep()
    {
        return view('rating.priority');
    }

    public function finish(Request $request)
    {
        $request->validate([
            'priority_delivery' => 'required|numeric|min:0|max:100',
            'priority_reject' => 'required|numeric|min:0|max:100',
            'priority_shortage' => 'required|numeric|min:0|max:100',
        ]);

        $total = $request->priority_delivery + $request->priority_reject + $request->priority_shortage;

        if ($total !== 100) {
            return back()->withErrors(['priority' => 'Total priority must equal 100%'])->withInput();
        }

        // Simpan Rating
        $step1 = Session::get('rating_step1');
        $rating = Rating::create([
            'user_id' => auth()->id(),
            'date' => Carbon::parse($step1['date']),
            'flour_requirement' => $step1['flour_requirement'],
            'priority_delivery' => $request->priority_delivery,
            'priority_reject' => $request->priority_reject,
            'priority_shortage' => $request->priority_shortage,
        ]);

        // Simpan supplier dan history
        foreach ([1, 2, 3] as $i) {
            $data = Session::get("supplier_$i");

            $supplier = Supplier::create([
                'rating_id' => $rating->id,
                'name' => $data['name'],
                'price_per_kg' => $data['price_per_kg'],
                'max_order' => $data['max_order'],
                'min_order' => $data['min_order'],
            ]);

            SupplierHistory::create([
                'supplier_id' => $supplier->id,
                'order_history' => $data['order_history'],
                'delivery_time_history' => $data['delivery_time_history'],
                'reject_quality_history' => $data['reject_quality_history'],
                'shortage_history' => $data['shortage_history'],
            ]);
        }

        // Bersihkan session
        Session::forget('rating_step1');
        Session::forget('supplier_1');
        Session::forget('supplier_2');
        Session::forget('supplier_3');

        return redirect()->route('dashboard')->with('success', 'Rating submitted successfully.');
    }

    public function edit($id)
    {
        $rating = Rating::with('suppliers.history')->findOrFail($id);
        return view('rating.edit', compact('rating'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'flour_requirement' => 'required|numeric|min:1',
            'priority_delivery' => 'required|numeric|min:0|max:100',
            'priority_reject' => 'required|numeric|min:0|max:100',
            'priority_shortage' => 'required|numeric|min:0|max:100',
            'suppliers.*.name' => 'required|string',
            'suppliers.*.price_per_kg' => 'required|numeric|min:0',
            'suppliers.*.min_order' => 'required|numeric|min:0',
            'suppliers.*.max_order' => 'required|numeric|min:0',
            'suppliers.*.delivery_time_history' => 'required|numeric|min:0',
            'suppliers.*.reject_quality_history' => 'required|numeric|min:0',
            'suppliers.*.shortage_history' => 'required|numeric|min:0',
        ]);

        $rating = Rating::findOrFail($id);

        $rating->update([
            'date' => $request->date,
            'flour_requirement' => $request->flour_requirement,
            'priority_delivery' => $request->priority_delivery,
            'priority_reject' => $request->priority_reject,
            'priority_shortage' => $request->priority_shortage,
        ]);

        foreach ($request->suppliers as $supplierData) {
            $supplier = Supplier::findOrFail($supplierData['id']);
            $supplier->update([
                'name' => $supplierData['name'],
                'price_per_kg' => $supplierData['price_per_kg'],
                'min_order' => $supplierData['min_order'],
                'max_order' => $supplierData['max_order'],
            ]);

            $history = $supplier->history;
            $history->update([
                'delivery_time_history' => $supplierData['delivery_time_history'],
                'reject_quality_history' => $supplierData['reject_quality_history'],
                'shortage_history' => $supplierData['shortage_history'],
            ]);
        }

        return redirect()->route('rating.result', $rating->id)->with('success', 'Rating successfully updated.');
    }

    // History list
    public function history()
    {
        $ratings = Rating::where('user_id', auth()->id())->orderByDesc('date')->get();

        return view('rating.history', compact('ratings'));
    }

    public function showResult($id)
    {
        $rating = Rating::where('id', $id)
            ->where('user_id', auth()->id())
            ->with('suppliers.history')
            ->firstOrFail();

        if (!$rating) {
            return redirect()->route('dashboard')->with('error', 'No rating found.');
        }

        $suppliers = $rating->suppliers;

        // Step 1: Hitung skor supplier (semakin kecil nilai waktu, reject, shortage → semakin bagus)
        $scores = [];
        foreach ($suppliers as $supplier) {
            $history = $supplier->history;

            // Normalisasi nilai kebalikan (semakin kecil semakin baik)
            $score = (
                ($history->delivery_time_history * $rating->priority_delivery) +
                ($history->reject_quality_history * $rating->priority_reject) +
                ($history->shortage_history * $rating->priority_shortage)
            );

            $scores[] = [
                'id' => $supplier->id,
                'name' => $supplier->name,
                'score' => $score,
                'delivery' => $history->delivery_time_history,
                'reject' => $history->reject_quality_history,
                'shortage' => $history->shortage_history,
            ];
        }

        // Step 2: Normalisasi ke skala 100 (terbalik: semakin kecil skor asli → semakin tinggi skor final)
        $max = collect($scores)->max('score');
        $evaluations = collect($scores)->map(function ($s) use ($max) {
            $value = round((1 - ($s['score'] / $max)) * 100);
            $status = $value >= 85 ? 'Excellent' : ($value >= 70 ? 'Good' : 'Moderate');
            return [
                'name' => $s['name'],
                'score' => $value,
                'raw' => $s['score'],
                'status' => $status,
            ];
        })->sortByDesc('score')->values();

        // Step 3: Ranking
        $evaluations = $evaluations->values()->map(function ($val, $i) {
            $val['rank'] = $i + 1;
            return $val;
        });

        // Step 4: Alokasi berdasarkan urutan ranking dan kapasitas maksimum
        $flour_needed = $rating->flour_requirement;
        $allocation = [];
        foreach ($evaluations as $eval) {
            $supplier = $suppliers->firstWhere('name', $eval['name']);
            $maxAlloc = $supplier->max_order;

            $amount = min($maxAlloc, $flour_needed);
            $allocation[$eval['name']] = $amount;
            $flour_needed -= $amount;

            if ($flour_needed <= 0) break;
        }

        // Step 5: Optimal Solution metrics (dikali alokasi)
        $total_kg = array_sum($allocation);
        $solution = [
            'lead_time' => number_format(
                collect($allocation)->map(function ($amount, $name) use ($suppliers) {
                    $h = $suppliers->firstWhere('name', $name)->history;
                    return $h->delivery_time_history * $amount;
                })->sum() / $total_kg,
                3
            ),
            'reject_quality' => collect($allocation)->map(function ($amount, $name) use ($suppliers) {
                $h = $suppliers->firstWhere('name', $name)->history;
                return $h->reject_quality_history;
            })->sum(),
            'shortage' => collect($allocation)->map(function ($amount, $name) use ($suppliers) {
                $h = $suppliers->firstWhere('name', $name)->history;
                return $h->shortage_history;
            })->sum(),
            'unmet_demand' => number_format(max(0, $rating->flour_requirement - array_sum($allocation)) / $rating->flour_requirement * 100, 2),
        ];

        // Kirim ke view
        return view('rating.valuation-result', compact('rating', 'evaluations', 'solution', 'allocation'));
    }

    private function calculateEvaluation($rating)
    {
        $suppliers = $rating->suppliers;

        $scores = [];
        foreach ($suppliers as $supplier) {
            $history = $supplier->history;

            $score = (
                ($history->delivery_time_history * $rating->priority_delivery) +
                ($history->reject_quality_history * $rating->priority_reject) +
                ($history->shortage_history * $rating->priority_shortage)
            );

            $scores[] = [
                'id' => $supplier->id,
                'name' => $supplier->name,
                'score' => $score,
                'delivery' => $history->delivery_time_history,
                'reject' => $history->reject_quality_history,
                'shortage' => $history->shortage_history,
            ];
        }

        $max = collect($scores)->max('score');
        $evaluations = collect($scores)->map(function ($s) use ($max) {
            $value = round((1 - ($s['score'] / $max)) * 100);
            $status = $value >= 85 ? 'Excellent' : ($value >= 70 ? 'Good' : 'Moderate');
            return [
                'name' => $s['name'],
                'score' => $value,
                'status' => $status,
            ];
        })->sortByDesc('score')->values()->map(function ($val, $i) {
            $val['rank'] = $i + 1;
            return $val;
        });

        $flour_needed = $rating->flour_requirement;
        $allocation = [];
        foreach ($evaluations as $eval) {
            $supplier = $suppliers->firstWhere('name', $eval['name']);
            $maxAlloc = $supplier->max_order;

            $amount = min($maxAlloc, $flour_needed);
            $allocation[$eval['name']] = $amount;
            $flour_needed -= $amount;
            if ($flour_needed <= 0) break;
        }

        $total_kg = array_sum($allocation);
        $solution = [
            'lead_time' => number_format(
                collect($allocation)->map(function ($amount, $name) use ($suppliers) {
                    $h = $suppliers->firstWhere('name', $name)->history;
                    return $h->delivery_time_history * $amount;
                })->sum() / $total_kg,
                3
            ),
            'reject_quality' => collect($allocation)->map(function ($amount, $name) use ($suppliers) {
                return $suppliers->firstWhere('name', $name)->history->reject_quality_history;
            })->sum(),
            'shortage' => collect($allocation)->map(function ($amount, $name) use ($suppliers) {
                return $suppliers->firstWhere('name', $name)->history->shortage_history;
            })->sum(),
            'unmet_demand' => number_format(max(0, $rating->flour_requirement - $total_kg) / $rating->flour_requirement * 100, 2),
        ];

        return compact('evaluations', 'solution', 'allocation');
    }

    public function showAnalysis($id)
    {
        $rating = Rating::where('user_id', auth()->id())
            ->with('suppliers.history')
            ->findOrFail($id);

        $suppliers = $rating->suppliers->map(function ($s) {
            return [
                'name' => $s->name,
                'price_per_kg' => $s->price_per_kg,
                'min_order' => $s->min_order,
                'max_order' => $s->max_order,
                'delivery_time_history' => $s->history->delivery_time_history,
                'reject_quality_history' => $s->history->reject_quality_history,
                'shortage_history' => $s->history->shortage_history,
            ];
        });

        $data = $this->calculateEvaluation($rating);
        return view('rating.valuation-analysis', array_merge(
            compact('rating', 'suppliers'),
            $data
        ));
    }

    public function print($id)
    {
        $rating = Rating::with('suppliers.history')->findOrFail($id);
        $data = $this->calculateEvaluation($rating);

        return view('rating.print', array_merge(compact('rating'), $data));
    }

    public function printAnalysis($id)
    {
        $rating = Rating::with('suppliers.history')->findOrFail($id);
        $data = $this->calculateEvaluation($rating);

        $suppliers = $rating->suppliers->map(function ($s) {
            return [
                'name' => $s->name,
                'price_per_kg' => $s->price_per_kg,
                'min_order' => $s->min_order,
                'max_order' => $s->max_order,
                'delivery_time_history' => $s->history->delivery_time_history,
                'reject_quality_history' => $s->history->reject_quality_history,
                'shortage_history' => $s->history->shortage_history,
            ];
        });

        return view('rating.print-analysis', array_merge(compact('rating', 'suppliers'), $data));
    }
}
