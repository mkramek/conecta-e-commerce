<?php

namespace Database\Seeders\Dev\Mock;

// use App\Models\AppConfigurationProgress;

use App\Models\ClientECommerce;
use App\Models\DeliveryAddress;
use Illuminate\Database\Seeder;

class DevClientECommerceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customer = ClientECommerce::create([
            'first_name' => 'First',
            'last_name' => 'Last',
            'login' => 'customer',
            'email' => 'omegamotor1997@gmail.com',
            'telephone_prefix' => '+48',
            'telephone_number' => '987 987 987',
            'password' => bcrypt('Qwerty123'),
            'is_account_blocked' => false,
            'allow_newsletter' => true,
            'rodo_acceptance' => true,
            'marketing_agreement' => true,
        ]);

        $address = DeliveryAddress::create([
            'city'=> 'Warszawa',
            'street'=> 'Słoneczna',
            'house_number'=> '2',
            'apartment_number'=> '1',
            'postal_code'=> '71-987',
            'province'=> 'Wielkopolska',
            'country'=> 'Polska',
            'additional_info'=> 'dodatkowa informacja',
        ]);

        $customer->deliveryAddresses()->save($address);

    }
}
