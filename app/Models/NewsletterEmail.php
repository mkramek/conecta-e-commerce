<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class NewsletterEmail extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'email',
    ];
}
