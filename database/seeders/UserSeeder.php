<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'me@admin.com',
            'role_id' => 1,
        ]);
        User::factory()->create([
            'email' => 'me@user.com',
            'role_id' => 2,
        ]);
        User::factory(98)->create();
    }
}
