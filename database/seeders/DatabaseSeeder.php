<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\Dev\Mock\DevClientECommerceSeeder;
use App\Models\AppConfigurationProgress;
use Database\Seeders\Dev\Mock\DevAppConfigurationProgressSeeder;
use Database\Seeders\Dev\Mock\DevBankConfigurationSeeder;
use Database\Seeders\Dev\Mock\DevCategoriesSeeder;
use Database\Seeders\Dev\Mock\DevCategoryRegulationAndRegulationSeeder;
use Database\Seeders\Dev\Mock\DevColorsSeeder;
use Database\Seeders\Dev\Mock\DevFooterSeeder;
use Database\Seeders\Dev\Mock\DevGlobalSeoConfigurationSeeder;
use Database\Seeders\Dev\Mock\DevProductsSeeder;
use Database\Seeders\Dev\Mock\DevProductTagSeeder;
use Database\Seeders\Dev\Mock\DevRolesAndPermissionsSeeder;
use Database\Seeders\Dev\Mock\DevSizeGroupsAndSizeSeeder;
use Database\Seeders\Dev\Mock\DevUserSeeder;
use Database\Seeders\Dev\Mock\DevWarehouseSeeder;
use Database\Seeders\Prod\ProdBankConfigurationSeeder;
use Database\Seeders\Prod\ProdFooterSeeder;
use Database\Seeders\Prod\ProdRolesAndPermissionsSeeder;
use Database\Seeders\Prod\ProdUserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // DEV
        if (!app()->environment('production')) {
            $this->call([
                DevUserSeeder::class,
                DevAppConfigurationProgressSeeder::class,
                // DevRolesAndPermissionsSeeder::class,
                DevFooterSeeder::class,
                DevBankConfigurationSeeder::class,
                DevProductTagSeeder::class,
                DevWarehouseSeeder::class,
                DevGlobalSeoConfigurationSeeder::class,

                DevSizeGroupsAndSizeSeeder::class,
                DevColorsSeeder::class,
                DevCategoriesSeeder::class,
                DevProductsSeeder::class,
                DevCategoryRegulationAndRegulationSeeder::class,
//                DevProductsWithoutColorAndSizeSeeder::class,
//                DevProductsWithoutColorSeeder::class,
//                DevProductsWithoutSizeSeeder::class
            ]);
        }

        // PROD
        if (!app()->environment('local')) {
            $this->call([
                ProdUserSeeder::class,
                DevClientECommerceSeeder::class,
                AppConfigurationProgress::class,
                ProdRolesAndPermissionsSeeder::class,
                ProdFooterSeeder::class,
                ProdBankConfigurationSeeder::class
            ]);
        }
    }
}
