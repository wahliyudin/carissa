<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::query()->create([
            'name' => 'Kitchen',
            'email' => 'kitchen@gmail.com',
            'password' => Hash::make(1234567890),
            'role' => Role::KITCHEN,
        ]);
        User::query()->create([
            'name' => 'Purchasing',
            'email' => 'purchase@gmail.com',
            'password' => Hash::make(1234567890),
            'role' => Role::PURCHASE,
        ]);
    }
}
