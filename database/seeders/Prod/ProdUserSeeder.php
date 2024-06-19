<?php

namespace Database\Seeders\Prod;

use App\Models\User;
use Illuminate\Database\Seeder;

class ProdUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'super.admin@sas-media.pl',
            'password' => bcrypt('Qwerty123'),
            'is_super_admin' => true
        ]);

        $admin = User::create([
           'name' => 'PROD Admin',
           'email' => 'prod.admin@sas-media.pl',
           'password' => bcrypt('Qwerty123'),
            'is_super_admin' => false
        ]);
    }
}
