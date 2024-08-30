<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PercentagePromotion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'is_active',
        'title',
        'percentage_value',
        'valid_from',
        'valid_until',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }
}
