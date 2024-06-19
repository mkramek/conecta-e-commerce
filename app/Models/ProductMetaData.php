<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductMetaData extends Model
{
    use HasUuids;
    use HasFactory;
    use SoftDeletes;

    /**
     * product_id => ID produktu bazowego,
     * base_description => pole na opis HTML,
     * seo_description => pole na opis dla SEO,
     * keywords => pole na słowa kluczowe,
     * lang => język (PL/EN)
     *
     * @var string[]
     */
    protected $fillable = [
        'product_id',
        'base_description',
        'seo_description',
        'keywords',
        'lang'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
