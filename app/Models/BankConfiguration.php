<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankConfiguration extends Model
{
    use HasFactory;

    /**
     * bank_name => Nazwa banku
     * bank_transfer_title => Tytuł podany do przelewu
     * bank_account_number => Numer rachunku bankowego na który klienci mają dokonywać wpłaty (00111122223333444455556666) lub (00 1111 2222 3333 4444 5555 6666) lub (PL92561200872132644477620909) - max 32 znaki, min 26
     *
     * @var string[]
     */
    protected $fillable = [
        'bank_name',
        'bank_transfer_title',
        'bank_account_number',
        'swift',
    ];
}
