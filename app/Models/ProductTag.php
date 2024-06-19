<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductTag extends Model
{
    use HasFactory;

    /**
     * name => nazwa tagu
     * lang => język
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'lang'
    ];

    protected $appends = ['tag_slug'];

    protected function tagSlug(): Attribute
    {
        return new Attribute(
            get: fn() => Str::slug($this->name)
        );
    }
}