<?php

namespace Database\Seeders\Dev\Mock;

use App\Models\AppConfigurationProgress;
use App\Models\BankConfiguration;
use Illuminate\Database\Seeder;

class DevBankConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BankConfiguration::factory()->create();

        $appCfg = AppConfigurationProgress::first();
        $appCfg->update([
            'has_configured_bank' => true
        ]);
    }
}
