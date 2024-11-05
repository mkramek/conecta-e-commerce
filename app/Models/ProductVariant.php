<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

// Wariant produktu
class ProductVariant extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * product_id => ID produktu bazowego,
     * symfonia_id => ID Symfonia,
     * synchronizer_product_id => ID produktu z synchronizatora,
     * percentage_promotion_id => ID promocji procentowej,
     * name_pl => nazwa PL,
     * name_en => nazwa EN,
     * slug_pl => nazwa uproszczona PL,
     * slug_en => nazwa uproszczona EN,
     * code => kod towaru,
     * quantity => ilość,
     * unit => jednostka,
     * color => kolor wariantu,
     * size => rozmiar wariantu,
     * model => model wariantu,
     * vat_rate => stawka VAT,
     * purchase_price => cena zakupu od dostawcy (CENA NETTO),
     * purchase_price_date => data zakupu po takiej cenie od dostawcy,
     * netto_price / netto_discount_price => cena netto / cena netto po promocji %,
     * brutto_price / brutto_discount_price => cena brutto / cena brutto po promocji %
     * mark_up => narzut,
     *
     * @var string[]
     */
    protected $fillable = [
        'product_id',
        'symfonia_id',
        'synchronizer_product_id',
        'percentage_promotion_id',
        'name_pl',
        'name_en',
        'slug_pl',
        'slug_en',
        'code',
        'quantity',
        'unit',
        'color',
        'size',
        'model',
        'vat_rate',
        'has_new_price_from_sync',
        'purchase_price',
        'purchase_price_date',
        'netto_price',
        'brutto_price',
        'mark_up',
        'netto_discount_price',
        'brutto_discount_price',
        'step',
    ];

    protected $casts = [
        'has_new_price_from_sync' => 'boolean',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function synchronizerProduct(): BelongsTo
    {
        return $this->belongsTo(SynchronizerProduct::class);
    }

    public function priceChanges(): HasMany
    {
        return $this->hasMany(PriceChange::class);
    }

    public function percentagePromotion(): BelongsTo
    {
        return $this->belongsTo(PercentagePromotion::class);
    }

    public function discountCodes(): BelongsToMany
    {
        return $this->belongsToMany(DiscountCode::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(ProductTag::class);
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function priceHistory(): HasMany
    {
        return $this->hasMany(PriceHistory::class, 'product_variant_id');
    }

    public function productVariantColor(): BelongsTo
    {
        return $this->belongsTo(Color::class, 'color', 'name');
    }
}
