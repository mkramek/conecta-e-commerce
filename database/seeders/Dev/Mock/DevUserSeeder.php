<?php

namespace Database\Seeders\Dev\Mock;

use App\Models\User;
use Illuminate\Database\Seeder;

class DevUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ID = 1
        $superAdmin = User::create([
            'name' => 'Super-Admin',
            'email' => 'super-admin@sas-media.pl',
            'password' => bcrypt('Qwerty123'),
            'is_super_admin' => true
        ]);

        // ID = 2
        $admin = User::create([
            'name' => 'DEV Admin',
            'email' => 'dev.admin@sas-media.pl',
            'password' => bcrypt('Qwerty123'),
            'is_super_admin' => false
        ]);

        // ID = 3
        $user = User::create([
            'name' => 'DEV User',
            'email' => 'dev.user@sas-media.pl',
            'password' => bcrypt('Qwerty123'),
            'is_super_admin' => false
        ]);

        // ID = 4
        $merchant = User::create([
            'name' => 'DEV Handlowiec',
            'email' => 'dev.handlowiec@sas-media.pl',
            'password' => bcrypt('Qwerty123'),
            'is_super_admin' => false
        ]);

        // ID = 5
        $storekeeper = User::create([
            'name' => 'DEV Magazynier',
            'email' => 'dev.magazynier@sas-media.pl',
            'password' => bcrypt('Qwerty123'),
            'is_super_admin' => false
        ]);
    }
}
