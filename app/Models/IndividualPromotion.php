<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class IndividualPromotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'is_percentage',
        'percentage',
        'first_level_category_id',
        'second_level_category_id',
        'third_level_category_id',
        'discount_net',
        'discount_gross',
        'enabled',
    ];

    protected $casts = [
        'enabled' => 'boolean'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(ClientECommerce::class, 'customer_id');
    }

    public function firstLevelCategory(): BelongsTo
    {
        return $this->belongsTo(FirstLevelCategory::class, 'first_level_category_id');
    }

    public function secondLevelCategory(): BelongsTo
    {
        return $this->belongsTo(SecondLevelCategory::class, 'second_level_category_id');
    }

    public function thirdLevelCategory(): BelongsTo
    {
        return $this->belongsTo(ThirdLevelCategory::class, 'third_level_category_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'individual_promotion_to_products');
    }

    public function productVariants(): HasManyThrough
    {
        return $this->hasManyThrough(ProductVariant::class, IndividualPromotionToProduct::class);
    }
}
