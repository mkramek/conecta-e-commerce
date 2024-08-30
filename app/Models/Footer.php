<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;

    /**
     * company_name => nazwa firmy
     * city => miasto
     * street => ulica
     * house_number => numer domu/budynku
     * apartment_number => numer miszkania/lokalu (opcjonalne)
     * postal_code => kod pocztowy (00-000)
     * email => email
     * telephone_one => telefon pierwszy
     * telephone_two => telefon drugi (nullable)
     * fax => faks (nullable)
     *
     * @var string[]
     */
    protected $fillable = [
        'company_name',
        'city',
        'street',
        'house_number',
        'apartment_number',
        'postal_code',
        'email',
        'telephone_one',
        'telephone_two',
        'fax',
    ];
}
