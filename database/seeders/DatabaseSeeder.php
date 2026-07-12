<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedUsers();

        $this->call([
            BawangKnowledgeSeeder::class,
        ]);
    }

    private function seedUsers(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@sipatan.test'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
                'role' => User::ROLE_ADMIN,
                'email_verified_at' => now(),
            ],
        );

        User::updateOrCreate(
            ['email' => 'petugas@sipatan.test'],
            [
                'name' => 'Petugas Lapangan',
                'password' => Hash::make('password'),
                'role' => User::ROLE_PETUGAS,
                'email_verified_at' => now(),
            ],
        );
    }
}
