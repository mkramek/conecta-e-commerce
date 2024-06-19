<?php

namespace Database\Seeders\Prod;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class ProdRolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // SuperAdmin
        $this->createSuperAdminRoleAndAssignItToUser();

        // Admin
        $this->createAdminRole();

        // Handlowiec
        $this->createMerchantRole();

        // Magazynier
        $this->createStorekeeperRole();
    }


    /**
     * Utworzenie roli Admin i przypisanie jej do DEV użytkownika o ID = 2.
     *
     * @return void
     */
    private function createAdminRole(): void
    {
        $adminRole = Role::make(['name' => 'Admin']);
        $adminRole->saveOrFail();

        $adminUser = User::find(2);
        $adminUser->assignRole($adminRole);
    }
    /**
     * Utworzenie roli super admina oraz przypisanie jej do DEV użytkownika o ID = 1.
     *
     * @return void
     */
    private function createSuperAdminRoleAndAssignItToUser(): void
    {
        $superAdminRole = Role::make(['name' => 'Super_Admin']);
        $superAdminRole->saveOrFail();

        $devSuperAdmin = User::find(1);
        $devSuperAdmin->assignRole($superAdminRole);
    }

    /**
     * Utworzenie roli handlowca.
     *
     * @return void
     */
    public function createMerchantRole(): void
    {
        $merchantRole = Role::make(['name' => 'Handlowiec']);
        $merchantRole->saveOrFail();
    }

    /**
     * Utworzenie roli magazyniera.
     *
     * @return void
     */
    public function createStorekeeperRole(): void
    {
        $storekeeperRole = Role::make(['name' => 'Magazynier']);
        $storekeeperRole->saveOrFail();
    }
}
