<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SizeGroup extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * group_name => nazwa grupy rozmiarowej
     * group_code => kod grupy
     *
     * @var string[]
     */
    protected $fillable = [
        'group_name',
        'group_code'
    ];

    public function sizes(): HasMany
    {
        return $this->hasMany(Size::class);
    }
}
