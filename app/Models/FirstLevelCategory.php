<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class FirstLevelCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * name_pl => nazwa w języku PL
     * name_en => nazwa w języku EN
     * slug_pl => nazwa uproszczona PL
     * slug_en => nazwa uproszczona EN
     * description_pl => opis w języku PL
     * description_en => opis w języku EN
     * keywords_pl => słowa kluczowe w języku PL
     * keywords_en => słowa kluczowe w języku EN
     * has_second_level_categories => czy kategoria będzie posiadać kategorie drugiego poziomu?
     * has_active_promotion => czy kategoria posiada aktywną promocję?
     * promotion_id => ID promocji -> dodać pole w przyszłości.
     * position => pozycja w menu
     * display_in_menu => pokaż kategorię w menu?
     *
     * @var string[]
     */
    protected $fillable = [
        'name_pl',
        'name_en',
        'slug_pl',
        'slug_en',
        'description_pl',
        'description_en',
        'keywords_pl',
        'keywords_en',
        'has_second_level_categories',
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
        'has_second_level_categories' => 'boolean',
        'has_active_promotion' => 'boolean',
        'display_in_menu' => 'boolean'
    ];

    public function secondLevelCategories(): HasMany
    {
        return $this->hasMany(SecondLevelCategory::class);
    }

    public function products(): HasMany
    {
        // Tabela w bazie danych: first_level_category_product
        return $this->hasMany(Product::class);
    }
}
