<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyConfig extends Model
{
    protected $fillable = [
        'name',
        'vat_id',
        'address_line_1',
        'address_line_2',
        'postal_code',
        'city',
        'province',
        'country',
        'telephone_prefix',
        'telephone_number',
        'email',
    ];
}
