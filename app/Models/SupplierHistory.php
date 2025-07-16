<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierHistory extends Model
{
    protected $fillable = [
        'supplier_id',
        'order_history',
        'delivery_time_history',
        'reject_quality_history',
        'shortage_history',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
