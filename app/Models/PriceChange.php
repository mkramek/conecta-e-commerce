<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 1. Cena z ostatnich 30 dni. Wyświetlamy najnizszą cene z ostatnich 30 dni.
 * 2. Nie patrzymy czy była obnizka promocyjna czy cena bazowa została obnizona.
 * 3. Dotyczy tylko E-COMMERCE - nie jest uwzględniane dla B2B.
 * 4. Synchronizator moze zmienic cene bazową - WTEDY tez tworzymy nowy log o tym ze produkt posiada najnizsza cene.
 * 5.
 *
 */

class PriceChange extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * product_variant_id => ID wariantu produktu, dla którego monitorujemy cene
     * user => imię i nazwisko przez kogo ta cena została zmieniona
     * old_price => stara cena przed zmiana
     * old_price_date => data do kiedy obowiązywała stara cena
     * new_price => nowa cena po zmianie
     * new_price_date => data od kiedy obowiazuje nowa cena
     *
     *
     * @var array
     */
    protected $fillable = [
        'product_variant_id',
        'user',
        'old_price',
        'old_price_date',
        'new_price',
        'new_price_date',
    ];

    protected $casts = [
        'is_promotion_price' => 'boolean'
    ];

    public function variant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
