<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

// Produkt bazowy
class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * symfonia_id => ID Symfonia,
     * synchronizer_product_id => ID produktu z synchronizatora,
     * is_active => czy produkt jest aktywny i powinien być wyświetlony na stronie sklepu
     * name_pl => nazwa produktu pl,
     * name_en => nazwa produktu en,
     * slug_pl => nazwa uproszczona pl,
     * slug_en => nazwa uproszczona en,
     * producer => producent,
     * unit => jednoska miary,
     * model => model produktu,
     * has_discount => czy posiada promocję %?
     *
     * @var array
     */
    protected $fillable = [
        'symfonia_id',
        'synchronizer_product_id',
        'is_active',
        'name_pl',
        'name_en',
        'slug_pl',
        'slug_en',
        'producer',
        'model',
        'has_discount'
    ];

    /**
     * Konwersja pól na wskazany typ.
     *
     * @var string[]
     */
    protected $casts = [
        'has_discount' => 'boolean',
        'is_active' => 'boolean'
    ];

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function metaData(): HasMany
    {
        return $this->hasMany(ProductMetaData::class);
    }

    public function firstLevelCategories(): BelongsToMany
    {
        // Tabela w bazie danych: first_level_category_product
        return $this->belongsToMany(FirstLevelCategory::class);
    }

    public function secondLevelCategories(): BelongsToMany
    {
        // Tabela w bazie danych: product_second_level_category
        return $this->belongsToMany(SecondLevelCategory::class);
    }

    public function thirdLevelCategories(): BelongsToMany
    {
        // Tabela w bazie danych: product_third_level_category
        return $this->belongsToMany(ThirdLevelCategory::class);
    }

    public function synchronizerProduct(): BelongsTo
    {
        return $this->belongsTo(SynchronizerProduct::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }
}
