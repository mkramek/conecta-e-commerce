<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IndividualPromotion extends Model
{
    protected $fillable = [
        'customer_id',
        'is_percentage',
        'percentage',
        'discount_net',
        'discount_gross',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(ClientECommerce::class, 'customer_id');
    }
}
