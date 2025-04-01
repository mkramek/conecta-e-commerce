<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class IndividualOffer extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'parent_id',
        'customer_id',
        'valid_until',
        'accepted_at',
        'rejected_at',
        'is_from_customer',
        'final',
        'offerer',
    ];

    public function parentOffer(): BelongsTo
    {
        return $this->belongsTo(IndividualOffer::class, 'parent_id', 'id');
    }

    public function childOffer(): HasOne
    {
        return $this->hasOne(IndividualOffer::class, 'parent_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(ClientECommerce::class, 'customer_id', 'id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(IndividualOfferItem::class);
    }
}
