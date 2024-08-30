<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeaderImage extends Model
{
    protected $fillable = [
        'url',
        'position',
        'visible',
    ];
}
