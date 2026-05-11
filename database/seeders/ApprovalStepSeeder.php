<?php

namespace Database\Seeders;

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
        DB::table('approval_steps')->insert([
            [
                'step_order' => 1,
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'step_order' => 2,
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
        ]);
    }
}
