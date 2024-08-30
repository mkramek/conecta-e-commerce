<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RegulationCategory extends Model
{
    use HasFactory;
    use HasUuids;

    /**
     * name => Unikalna nazwa kategorii regulaminów
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
    ];

    public function regulations(): HasMany
    {
        return $this->hasMany(Regulation::class);
    }
}
