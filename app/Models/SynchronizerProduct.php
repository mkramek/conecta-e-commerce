<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SynchronizerProduct extends Model
{
    use HasFactory;
    use SoftDeletes;

    //    Pole symfonia_id w widokach będzie się pojawiać pod nazwą SID

    protected $fillable = [
        'symfonia_id',
        'name',
        'code',
        'model'
    ];

    public function baseProducts(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function productVariants(): HasOne
    {
        return $this->hasOne(ProductVariant::class);
    }
}