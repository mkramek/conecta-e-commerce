<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoConfiguration extends Model
{
    use HasUuids;
    use HasFactory;

    /**
     * meta_title => Tytuł strony w platformie E-Commerce
     * meta_author => Autor
     * meta_description_content => Opis strony w platformie E-Commerce
     * meta_keywords => Słowa kluczowe rozdzielone przecinkiem
     * lang => Język w jakim ma być dodane SEO
     * @var string[]
     */
    protected $fillable = [
        'meta_title',
        'meta_author',
        'meta_description_content',
        'meta_keywords',
        'lang'
    ];
}
