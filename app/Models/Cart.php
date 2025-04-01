<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'customer_id',
        'product_id',
        'variant_id',
        'quantity',
        'is_customizable',
        'custom_price_net',
        'custom_price_gross',
    ];

    protected $casts = [
        'is_customizable' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class);
    }

    public function hasCustomPromo()
    {
        return $this->custom_price_net !== null && $this->custom_price_gross !== null;
    }
}
