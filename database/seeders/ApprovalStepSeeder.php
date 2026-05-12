<?php

namespace Database\Seeders;

use App\Models\Role;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApprovalStepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name' , 'admin')->first();

        $superAdmin = Role::where('name' , 'super-admin')->first();

        DB::table('approval_steps')->insert([
            [
                'step_order' => 1,
                'role_id' => $adminRole->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'step_order' => 2,
                'role_id' => $superAdmin->id,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
        ]);
    }
}
