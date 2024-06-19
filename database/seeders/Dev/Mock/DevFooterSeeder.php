<?php

namespace Database\Seeders\Dev\Mock;

use App\Models\AppConfigurationProgress;
use App\Models\Footer;
use Illuminate\Database\Seeder;

class DevFooterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Footer::factory()->create();

        $appCfg = AppConfigurationProgress::first();
        $appCfg->update([
            'has_configured_footer' => true
        ]);
    }
}
