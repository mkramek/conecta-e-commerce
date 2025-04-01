<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImage extends Model
{
    use HasFactory;

    /**
     * product_id => ID Produktu bazowego,
     * file_name => nazwa pliku (z rozszerzeniem .webp),
     * url => ścieżka gdzie został zapisany plik w panelu BO,
     * display_position => w jakiej kolejności wyświetlić zdjęcie w sklepie
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'file_name',
        'url',
        'display_position',
        'color_id',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
