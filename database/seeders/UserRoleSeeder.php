<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        UserRole::create(['name' => 'Administrator']);
        UserRole::create(['name' => 'Editor']);
        UserRole::create(['name' => 'Author']);
    }
}