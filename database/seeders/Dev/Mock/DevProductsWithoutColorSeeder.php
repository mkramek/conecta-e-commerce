<?php

namespace Database\Seeders\Dev\Mock;

use App\Models\Producer;
use App\Models\Product;
use App\Models\SizeGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DevProductsWithoutColorSeeder extends Seeder
{
    private string $productModel = "";
    private string $productName = "";
    private string $size = "";
    private int $sizeGroupId = 0;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i<10; $i++) {
            $nettoPrice = fake()->randomFloat(2, 1, 20);

            Product::create([
                'code' => $this->getCodeWithoutColor(),
                'name' => $this->productName,
                'slug' => Str::slug($this->productName),
                'producer' => $this->producer,
                'quantity' => fake()->randomNumber(2),
                'unit' => 'szt.',
                'model' => $this->productModel,
                'color' => null,
                'size' => $this->size,
                'size_group_id' => $this->sizeGroupId,
                'vat_rate' => 23,
                'has_discount' => false,
                'netto_price' => $nettoPrice,
                'netto_discount_price' => null,
                'brutto_price' => $this->getBruttoPrice($nettoPrice),
                'brutto_discount_price' => null,
            ]);
        }
    }

    private function getCodeWithoutColor(): string
    {
        // KOD TOWARU: MODEL.GRUPA_ROZMIAROWA.ROZMIAR.42.00.PRODUCENT
        $code = "";
        $this->productModel = fake()->randomNumber("4");
        $productNames = ['Testowy1', 'Testowy2', 'Testowy3'];
        $randKeyForProductNames = array_rand($productNames);
        $this->productName = $productNames[$randKeyForProductNames] . " " . $this->productModel;

        // Size
        $sizeGroup = SizeGroup::where('id', '!=', 1)->get()->random(1)->first();
        $this->sizeGroupId = $sizeGroup->id;
        $this->size = $sizeGroup->sizes()->first()->size_value;
        $code .= $this->productModel . "." . $sizeGroup->group_code . "." . $this->size . ".";

        // Color
        $code .= "00.";

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
