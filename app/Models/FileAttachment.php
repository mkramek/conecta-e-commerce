<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FileAttachment extends Model
{
    use HasFactory;
    use HasUuids;

    /**
     * file_name => nazwa pliku,
     * file_extension => rozszerzenie pliku,
     * file_size => rozmiar pliku (kb/mb/gb)
     * url => url do pliku
     *
     * @var string[]
     */
    protected $fillable = [
        'file_name',
        'file_extension',
        'file_size',
        'url'
    ];
}