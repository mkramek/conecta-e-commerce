<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndividualPromotionToProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'individual_promotion_id',
        'product_id',
        'product_variant_id',
    ];
}
