<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Regulation extends Model
{
    use HasFactory;
    use HasUuids;

    /**
     * name => nazwa regulaminu,
     * slug = > slug regulaminu na podstawie pola nazwa,
     * is_published => czy regulamin został opublikowany?
     * lang => wersja językowa,
     * regulation_category_id => ID do jakiej kategorii należy regulamin,
     * url => url do pliku,
     * file_name => nazwa pliku z rozszerzeniem
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'slug',
        'is_published',
        'lang',
        'regulation_category_id',
        'url',
        'file_name',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(RegulationCategory::class);
    }
}
