<?php

namespace Database\Seeders\Dev\Mock;

use App\Models\AppConfigurationProgress;
use App\Models\WarehouseAddress;
use Illuminate\Database\Seeder;

class DevWarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WarehouseAddress::factory()->create();

        $appCfg = AppConfigurationProgress::first();
        $appCfg->update([
            'has_configured_warehouse_addresses' => true
        ]);
    }
}
