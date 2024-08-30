<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'url',
    ];
}
