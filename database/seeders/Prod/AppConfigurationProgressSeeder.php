<?php

namespace Database\Seeders\Prod;

use App\Models\AppConfigurationProgress;
use Illuminate\Database\Seeder;

class AppConfigurationProgressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AppConfigurationProgress::create([
            'has_created_seo_for_any_lang' => false,
            'has_configured_footer' => false,
            'has_configured_bank' => false,
            'has_configured_warehouse_addresses' => false
        ]);
    }
}
