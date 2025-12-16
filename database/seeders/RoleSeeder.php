<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        $permissions = [
            'manage users',
            'manage patients',
            'manage medical records',
            'manage pharmacy',
            'manage services',
            'view reports',
            'view dashboard',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create Roles and Assign Permissions

        // Admin / Resepsionis
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo(['manage users', 'manage patients', 'view reports', 'view dashboard', 'manage services']);

        // Bidan
        $bidanRole = Role::firstOrCreate(['name' => 'bidan']);
        $bidanRole->givePermissionTo(['manage patients', 'manage medical records', 'view dashboard']);

        // Pharmacy
        $pharmacyRole = Role::firstOrCreate(['name' => 'pharmacy']);
        $pharmacyRole->givePermissionTo(['manage pharmacy']);

        // Patient
        $patientRole = Role::firstOrCreate(['name' => 'patient']);
    }
}
