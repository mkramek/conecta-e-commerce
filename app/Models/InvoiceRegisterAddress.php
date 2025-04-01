<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceRegisterAddress extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    /**
     * company_name => nazwa firmy
     * nip => nip
     * city => miasto
     * street => ulica
     * house_number => numer domu/budynku
     * apartment_number => numer miszkania/lokalu (opcjonalne)
     * postal_code => kod pocztowy (00-000)
     * client_e_commerce_id => FK ID klienta
     *
     * @var string[]
     */
    protected $fillable = [
        'company_name',
        'nip',
        'city',
        'street',
        'house_number',
        'apartment_number',
        'postal_code',
        'client_e_commerce_id',
        'province',
        'country',
    ];

    public function clientECommerce(): BelongsTo
    {
        return $this->belongsTo(ClientECommerce::class);
    }

    public function __toString()
    {
        return "$this->street $this->house_number | $this->apartment_number\n $this->postal_code, $this->city";
    }
}
