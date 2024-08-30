<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceChange extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_variant_id',
        'old_price_net',
        'old_price_gross',
        'old_vat_rate',
        'new_price_net',
        'new_price_gross',
        'new_vat_rate',
        'approved_at',
        'change_beacuse_promotion',
    ];

    protected $casts = [
        'is_promotion_price' => 'boolean',
    ];

    public function variant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
