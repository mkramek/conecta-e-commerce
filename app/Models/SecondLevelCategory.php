<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SecondLevelCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * first_level_category_id => ID kategorii pierwszego poziomu
     * name_pl => nazwa w języku PL
     * name_en => nazwa w języku EN
     * slug_pl => nazwa uproszczona PL
     * slug_en => nazwa uproszczona EN
     * description_pl => opis w języku PL
     * description_en => opis w języku EN
     * keywords_pl => słowa kluczowe PL
     * keywords_en => słowa kluczowe EN
     * has_third_level_categories => czy kategoria będzie posiadać kategorię trzeciego poziomu?
     * has_active_promotion => czy kategoria posiada aktywną promocję?
     * promotion_id => ID promocji -> dodać pole w przyszłości.
     * position => pozycja w menu
     * display_in_menu => pokaż kategorię w menu?
     *
     * @var string[]
     */
    protected $fillable = [
        'first_level_category_id',
        'name_pl',
        'name_en',
        'slug_pl',
        'slug_en',
        'description_pl',
        'description_en',
        'keywords_pl',
        'keywords_en',
        'has_third_level_categories',
        'has_active_promotion',
        'position',
        'display_in_menu'
    ];

    /**
     * Rzutowanie pól na wspazany typ zmiennych.
     *
     * @var string[]
     */
    public $casts = [
        'has_third_level_categories' => 'boolean',
        'has_active_promotion' => 'boolean',
        'display_in_menu' => 'boolean'
    ];

    public function firstLevelCategory(): BelongsTo
    {
        return $this->belongsTo(FirstLevelCategory::class);
    }

    public function thirdLevelCategories(): HasMany
    {
        return $this->hasMany(ThirdLevelCategory::class);
    }

    public function products(): HasMany
    {
        // Tabela w bazie danych: product_second_level_category
        return $this->hasMany(Product::class);
    }
}
