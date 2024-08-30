<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseAddress extends Model
{
    use HasFactory;
    use HasUuids;

    /**
     * city => miasto
     * street => ulica
     * house_number => numer domu/budynku
     * apartment_number => numer miszkania/lokalu (opcjonalne)
     * postal_code => kod pocztowy (00-000)
     * province => województwo
     * country => kraj
     * additional_info => dodatkowe informacje
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
    ];
}
