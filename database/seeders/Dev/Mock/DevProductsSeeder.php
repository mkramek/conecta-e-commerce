<?php

namespace Database\Seeders\Dev\Mock;

use App\Models\Product;
use Illuminate\Database\Seeder;

class DevProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory(10)->create();
    }
}
