<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class SynchronizerProduct extends Model
{
    use HasFactory;
    use SoftDeletes;

    //    Pole symfonia_id w widokach będzie się pojawiać pod nazwą SID

    protected $fillable = [
        'symfonia_id',
        'name',
        'code',
        'model',
        'product_id',
    ];

    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'synchronizer_product_id', 'product_id');
    }
}
