<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'rating_id',
        'name',
        'price_per_kg',
        'max_order',
        'min_order',
    ];

    public function rating()
    {
        return $this->belongsTo(Rating::class);
    }

    public function history()
    {
        return $this->hasOne(SupplierHistory::class);
    }
}
