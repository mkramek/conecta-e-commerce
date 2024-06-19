<?php

namespace Database\Seeders\Dev\Mock;

use App\Models\AppConfigurationProgress;
use App\Models\SeoConfiguration;
use Illuminate\Database\Seeder;

class DevGlobalSeoConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SeoConfiguration::create([
            'meta_title' => 'Conecta | Sklep Internetowy',
            'meta_author' => 'Conecta',
            'meta_description_content' => 'Conecta - Sklep Internetowy. Sklep z odzieżą ochronną dla pracowników. Odzież BHP. Sprzęty ochrony osobistej.',
            'meta_keywords' => 'conecta, bhp, sklep internetowy z odzieżą ochronną bhp, ochrona osobista',
            'lang' => 'pl',
        ]);

        SeoConfiguration::create([
            'meta_title' => 'Conecta | Online shop',
            'meta_author' => 'Conecta',
            'meta_description_content' => 'Conecta - online shop with BHP security items.',
            'meta_keywords' => 'conecta, bhp, online shop with security items',
            'lang' => 'en',
        ]);

        $appCfg = AppConfigurationProgress::first();
        $appCfg->update([
            'has_created_seo_for_any_lang' => true
        ]);
    }
}
