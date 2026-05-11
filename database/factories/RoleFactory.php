<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Role>
 */
class RoleFactory extends Factory
{
    public function definition(): array
    {
        static $roles = [
            'admin-level-1',
            'admin-level-2',
        ];

        return [
            'name' => array_shift($roles),
        ];
    }
}