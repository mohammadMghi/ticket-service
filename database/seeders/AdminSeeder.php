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

        $role_level_1 = Role::where('name' , 'admin-level-1')->first();

        User::create([
            'name' => 'Test 1',
            'email' => 'adminlevel1@example.com',
            'role_id' => $role_level_1->id,
            'password' => '12345678'
        ]);

        $role_level_2 = Role::where('name' , 'admin-level-2')->first();

        User::create([
            'name' => 'Test 2',
            'email' => 'adminlevel2@example.com',
            'role_id' => $role_level_2->id,
            'password' => '12345678'
        ]);
    }
}
