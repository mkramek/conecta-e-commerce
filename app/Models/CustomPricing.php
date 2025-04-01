<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomPricing extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'variant_id',
        'price_net',
        'price_gross',
        'is_base_price',
    ];

    protected $casts = [
        'is_base_price' => 'boolean',
    ];
}
