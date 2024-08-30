<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ThirdLevelCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Rzutowanie pól na wspazany typ zmiennych.
     *
     * @var string[]
     */
    public $casts = [
        'has_active_promotion' => 'boolean',
        'display_in_menu' => 'boolean',
    ];

    /**
     * second_level_category_id => ID kategorii drugiego poziomu
     * name_pl => nazwa w języku PL
     * name_en => nazwa w języku EN
     * slug_pl => nazwa uproszczona PL
     * slug_en => nazwa uproszczona EN
     * description_pl => opis w języku PL
     * description_en => opis w języku EN
     * keywords_pl => słowa kluczowe PL
     * keywords_en => słowa kluczowe EN
     * has_active_promotion => czy kategoria posiada aktywną promocję?
     * promotion_id => ID promocji -> dodać pole w przyszłości.
     * position => pozycja w menu
     * display_in_menu => pokaż kategorię w menu?
     *
     * @var string[]
     */
    protected $fillable = [
        'second_level_category_id',
        'name_pl',
        'name_en',
        'slug_pl',
        'slug_en',
        'description_pl',
        'description_en',
        'keywords_pl',
        'keywords_en',
        'has_active_promotion',
        'position',
        'display_in_menu',
        'size_group_id',
    ];

    public function secondLevelCategory(): BelongsTo
    {
        return $this->belongsTo(SecondLevelCategory::class);
    }

    public function products(): HasMany
    {
        // Tabela w bazie danych: product_third_level_category
        return $this->hasMany(Product::class);
    }

    public function sizeGroup(): BelongsTo
    {
        return $this->belongsTo(SizeGroup::class, 'size_group_id');
    }
}
