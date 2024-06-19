<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Size extends Model
{
    use HasFactory;

    /**
     * size_value => Wartość rozmiaru
     * size_group_id =>
     *
     * @var string[]
     */
    protected $fillable = [
        'size_value',
        'size_group_id'
    ];

    public function sizeGroup(): BelongsTo
    {
        return $this->belongsTo(SizeGroup::class);
    }
}
