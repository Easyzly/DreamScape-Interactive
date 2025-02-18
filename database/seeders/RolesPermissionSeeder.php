<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'admin'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $roles = [
            'Gebruiker',
            'Beheerder'
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);

            if ($role === 'Beheerder') {
                $role = Role::findByName($role);
                $role->givePermissionTo($permissions);
            }
        }
    }
}
