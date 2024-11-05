<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IndividualOfferItem extends Model
{
    protected $fillable = [
        'product_variant_id',
        'price_net',
        'price_gross',
        'quantity',
        'individual_offer_id',
    ];

    public function offer(): BelongsTo
    {
        return $this->belongsTo(IndividualOffer::class, 'individual_offer_id');
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }
}
