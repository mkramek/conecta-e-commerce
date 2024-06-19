<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    /**
     * city => miasto
     * street => ulica
     * house_number => numer domu/budynku
     * apartment_number => numer miszkania/lokalu (opcjonalne)
     * postal_code => kod pocztowy (00-000)
     * province => wojewodztwo
     * country => kraj
     * additional_info => dodatkowe informacje
     * client_e_commerce_id => FK ID klienta
     *
     * @var string[]
     */
    protected $fillable = [
        'city',
        'street',
        'house_number',
        'apartment_number',
        'postal_code',
        'province',
        'country',
        'additional_info',
        'client_e_commerce_id'
    ];

    public function clientECommerce(): BelongsTo
    {
        return $this->belongsTo(ClientECommerce::class);
    }
}
