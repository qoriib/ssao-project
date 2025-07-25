<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'user_id',
        'date',
        'flour_requirement',
        'priority_delivery',
        'priority_reject',
        'priority_shortage',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function suppliers()
    {
        return $this->hasMany(Supplier::class);
    }
}
