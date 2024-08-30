<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppConfigurationProgress extends Model
{
    use HasFactory;

    /**
     * has_created_seo_for_any_lang => Ustawienie czy w aplikacji zostało skonfigurowane już SEO
     * has_configured_footer => Ustawienie czy stopka w aplikacji została skonfigurowana
     * has_configured_bank => Ustawienie czy dane do przelewu tradycyjnego zostały skonfigurowane
     * has_configured_warehouse_addresses => Ustawienie czy adres magazynu został skonfigurowany
     *
     * @var string[]
     */
    protected $fillable = [
        'has_created_seo_for_any_lang',
        'has_configured_footer',
        'has_configured_bank',
        'has_configured_warehouse_addresses',
    ];

    /**
     * Konwersja pola na typ boolean.
     *
     * @var string[]
     */
    protected $casts = [
        'has_created_seo_for_any_lang' => 'boolean',
        'has_configured_footer' => 'boolean',
        'has_configured_bank' => 'boolean',
        'has_configured_warehouse_addresses' => 'boolean',
    ];
}
