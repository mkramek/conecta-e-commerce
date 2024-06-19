<?php

namespace Database\Seeders\Dev\Mock;

use App\Models\ProductTag;
use Illuminate\Database\Seeder;

class DevProductTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->randomProductTagNames as $productTagName) {
            ProductTag::create([
                'name' => $productTagName,
                'lang' => "pl"
            ]);
        }
    }

    /**
     * Przykładowe losowe tagi.
     *
     * @var array|string[]
     */
    private array $randomProductTagNames = ["Nowość", "Promocja", "Wyprzedaż", "Ostatnie sztuki"];
}
