<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = Role::create(['name' => 'Super Admin']);
        $userRole = Role::create(['name' => 'user']);

        $adminUser = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
        ]);

        $regularUser = User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
        ]);
        // Set permissions untuk Super Admin
        $allPermissions = Permission::pluck('name')->toArray();
        $superAdminRole->syncPermissions($allPermissions);

        // Set permissions untuk User
        $userPermissions = [
            'view-any Pendaftaran',
            'create Pendaftaran',
            'update Pendaftaran',
            'view-any UserVerification',
            'create UserVerification',
            'update UserVerification',
        ];
        $userRole->syncPermissions($userPermissions);

        $adminUser->syncRoles(['Super Admin']);
    }
}
