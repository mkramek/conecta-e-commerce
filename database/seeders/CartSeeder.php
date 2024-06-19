<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Cart;

class CartSeeder extends Seeder
{
    public function run()
    {
        // Tworzymy kilka przykładowych produktów
        $product1 = Product::create(['name' => 'Product 1', 'price' => 19.99]);
        $product2 = Product::create(['name' => 'Product 2', 'price' => 29.99]);
        $product3 = Product::create(['name' => 'Product 3', 'price' => 39.99]);

        // Tworzymy koszyk
        $cart = Cart::create();

        // Dodajemy produkty do koszyka
        $cart->products()->attach([$product1->id, $product2->id, $product3->id]);

        // Możesz dodać więcej produktów lub koszyków w sposób analogiczny

        $this->command->info('Cart seeded successfully!');
    }
}
