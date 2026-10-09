<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Default Super Admin User
        User::firstOrCreate(
            ['email' => 'admin@boilerplate.com'],
            [
                'name'              => 'Super Administrator',
                'phone'             => '+6281234567890',
                'role'              => UserRole::ADMIN,
                'is_active'         => true,
                'email_verified_at' => now(),
                'password'          => Hash::make('password123'),
            ]
        );

        // Default Demo User
        User::firstOrCreate(
            ['email' => 'user@boilerplate.com'],
            [
                'name'              => 'Demo User',
                'phone'             => '+6289876543210',
                'role'              => UserRole::USER,
                'is_active'         => true,
                'email_verified_at' => now(),
                'password'          => Hash::make('password123'),
            ]
        );

        // Additional dummy users for pagination testing
        User::factory()->count(15)->create();
    }
}
