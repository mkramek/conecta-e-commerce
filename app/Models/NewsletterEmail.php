<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterEmail extends Model
{
    protected $fillable = [
        'user_id',
        'email',
    ];
}
