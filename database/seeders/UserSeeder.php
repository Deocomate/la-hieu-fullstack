<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

final class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@lahieu.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'role' => 'super_admin',
                'email_verified_at' => '2026-05-25 00:00:00',
            ]
        );

        User::firstOrCreate(
            ['email' => 'staff@lahieu.com'],
            [
                'name' => 'Admin Staff',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => '2026-05-25 00:00:00',
            ]
        );
    }
}
