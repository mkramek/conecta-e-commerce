<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    protected $fillable = [
        'name',
        'img_url',
        'api_url',
        'client_id',
        'client_secret',
        'callback_url',
        'status_endpoint',
        'fee',
        'user_id',
        'enabled',
        'is_onsite',
    ];

    protected $casts = [
        'enabled' => 'boolean',
        'is_onsite' => 'boolean',
    ];
}
