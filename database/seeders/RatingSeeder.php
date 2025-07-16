<?php

namespace Database\Seeders;

use App\Models\Rating;
use App\Models\Supplier;
use App\Models\SupplierHistory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Pastikan minimal ada 1 user
        $user = User::first() ?? User::factory()->create();

        // Buat 3 rating dummy
        for ($r = 1; $r <= 3; $r++) {
            $rating = Rating::create([
                'user_id' => $user->id,
                'date' => Carbon::now()->subDays($r),
                'flour_requirement' => rand(2000, 3000),
                'priority_delivery' => 40,
                'priority_reject' => 30,
                'priority_shortage' => 30,
            ]);

            // Tambahkan 3 supplier alternatif per rating
            for ($s = 1; $s <= 3; $s++) {
                $supplier = Supplier::create([
                    'rating_id' => $rating->id,
                    'name' => "Supplier $r-$s",
                    'price_per_kg' => rand(8500, 10000),
                    'max_order' => rand(800, 1500),
                    'min_order' => rand(300, 700),
                ]);

                SupplierHistory::create([
                    'supplier_id' => $supplier->id,
                    'order_history' => rand(1000, 3000),
                    'delivery_time_history' => rand(2, 5), // dalam hari
                    'reject_quality_history' => rand(20, 80),
                    'shortage_history' => rand(10, 50),
                ]);
            }
        }
    }
}
