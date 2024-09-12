<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Role::create([
            'key' => 'admin',
            'name' => 'Administrator',
        ]);
        \App\Models\Role::create([
            'key' => 'user',
            'name' => 'User',
        ]);
    }
}
