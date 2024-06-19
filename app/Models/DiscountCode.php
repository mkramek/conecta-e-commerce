<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Kod promocyjny ma zadziałać na każdy produkt w zamówieniu.
 */

class DiscountCode extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * title => tytuł kodu promocyjnego,
     * code => wygenerowany kod,
     * value => wartość kodu,
     * valid_from => kod ważny od,
     * valid_until => kod ważny do,
     * is_unlimited => kod jest nielimitowany,
     * quantity_of_use => maksymalna ilość użyć,
     * used_times => ile razy kod został użyty,
     * is_active => czy kod jest aktywny?
     * use_with_basket => używać na cały koszyk
     * use_with_products => używać na wskazane produkty
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'code',
        'value',
        'valid_from',
        'valid_until',
        'is_unlimited',
        'quantity_of_use',
        'used_times',
        'is_active',
        'use_with_basket',
        'use_with_products'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'use_for_basket' => 'boolean',
        'use_for_products' => 'boolean',
        'is_unlimited' => 'boolean'
    ];

    public function productsVariants(): BelongsToMany
    {
        return $this->belongsToMany(ProductVariant::class);
    }
}