<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = [
        'name',
        'type',
        'client_id',
        'client_secret',
        'merchant_id',
        'signature',
        'callback_url',
        'status_url',
        'img_url',
    ];
}
