<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $adminRole = Role::where('name' , 'admin')->first();

        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'role_id' => $adminRole->id,
            'password' => '12345678'
        ]);

        $superAdmin = Role::where('name' , 'super-admin')->first();

        User::create([
            'name' => 'super admin',
            'email' => 'superadmin@example.com',
            'role_id' => $superAdmin->id,
            'password' => '12345678'
        ]);
    }
}
