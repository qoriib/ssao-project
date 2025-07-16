<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Allocation extends Model
{
    protected $fillable = ['rating_id', 'supplier_id', 'allocated_amount'];

    public function rating()
    {
        return $this->belongsTo(Rating::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
