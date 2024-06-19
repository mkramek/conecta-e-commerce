<?php

namespace Database\Seeders\Dev\Mock;

use App\Models\Color;
use App\Models\Producer;
use App\Models\Product;
use App\Models\SizeGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DevProductsWithoutSizeSeeder extends Seeder
{
    private string $productModel = "";
    private string $productName = "";
    private string $color = "";

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i<10; $i++) {
            $nettoPrice = fake()->randomFloat(2, 1, 20);

            Product::create([
                'code' => $this->getCodeWithoutSize(),
                'name' => $this->productName,
                'slug' => Str::slug($this->productName),
                'producer' => $this->producer,
                'quantity' => fake()->randomNumber(2),
                'unit' => 'szt.',
                'model' => $this->productModel,
                'color' => $this->color,
                'size' => null,
                'size_group_id' => null,
                'vat_rate' => 23,
                'has_discount' => false,
                'netto_price' => $nettoPrice,
                'netto_discount_price' => null,
                'brutto_price' => $this->getBruttoPrice($nettoPrice),
                'brutto_discount_price' => null,
            ]);
        }
    }

    private function getCodeWithoutSize(): string
    {
        // KOD TOWARU: MODEL.GRUPA_ROZMIAROWA.00.KOLOR.PRODUCENT
        $code = "";
        $this->productModel = fake()->randomNumber("4");
        $productNames = ['Testowy1', 'Testowy2', 'Testowy3'];
        $randKeyForProductNames = array_rand($productNames);
        $this->productName = $productNames[$randKeyForProductNames] . " " . $this->productModel;

        // Size
        $sizeGroup = SizeGroup::first();
        $code .= $this->productModel . "." . $sizeGroup->group_code . ".00.";

        // Color
        $this->color = Color::firstOrCreate(['name' => str_replace(' ', '_', Str::ucfirst(fake()->safeColorName))])->name;
        $code .= $this->color . ".";

        // Producer
        $producers = ["3M", "ABC", "Figo", "Bravo", "Alfa", "North"];
        $randKeyForProducers = array_rand($producers);
        $this->producer = $producers[$randKeyForProducers];

        Producer::firstOrCreate(['name' => $this->producer]);

        $code .= $this->producer;

        return $code;
    }

    private function getBruttoPrice(float $nettoPrice): float
    {
        return $nettoPrice * 1.23;
    }
}
