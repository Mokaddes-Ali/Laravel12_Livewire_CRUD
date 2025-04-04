<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = Role::create(['name' => 'super-admin']);
        $superAdminRole->givePermissionTo(Permission::all());

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(
            Permission::all()

            // 'product-list',
            // 'product-create',
            // 'product-edit',
            // 'product-delete'
        );
        $staffRole = Role::create(['name' => 'staff']);

        $staffRole->givePermissionTo([
            'product-list'
        ]);
        $userRole = Role::create(['name' => 'user']);

        $userRole->givePermissionTo([
            'product-list'
        ]);

        // Create and assign role to Super Admin user
        $superAdminUser = User::firstOrCreate(
            ['email' => 'superadmin@gmail.com'],
            ['phone' => '1234567890'],
            [
                'name' => 'Super Admin',
                'phone' => '1234567890',
                'password' => Hash::make('12345678'),
            ]
        );
        $superAdminUser->assignRole($superAdminRole);

        // Create and assign role to Admin user
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            ['phone' => '1234567891',],
            [
                'name' => 'Admin',
                'password' => Hash::make('12345678'),
            ]
        );
        $adminUser->assignRole($adminRole);

        // Create and assign role to Staff user
        $staffUser = User::firstOrCreate(
            ['email' => 'staff@gmail.com'],
            ['phone' => '1234567892'],
            [
                'name' => 'Staff',
                'password' => Hash::make('12345678'),
            ]
        );
        $staffUser->assignRole($staffRole);
    }
}
