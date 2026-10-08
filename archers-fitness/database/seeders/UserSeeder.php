<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::firstOrCreate(
            ['email' => 'karljatienza@gmail.com'],
            [
                'name' => "Red Josh",
                'password' => Hash::make('archers123'),
                'role' => "admin",
                'email_verified_at' => now(),
            ]
        );
        User::firstOrCreate(
            ['email' => 'jarvey@gmail.com'],
            [
                'name' => "Coach Jarvey",
                'password' => Hash::make('archers123'),
                'role' => "admin",
                'email_verified_at' => now(),
            ]
        );
        User::firstOrCreate(
            ['email' => 'glenn@gmail.com'],
            [
                'name' => "Coach Glenn",
                'password' => Hash::make('archers123'),
                'role' => "admin",
                'email_verified_at' => now(),
            ]
        );
        User::firstOrCreate(
            ['email' => 'rem@gmail.com'],
            [
                'name' => "Coach Remiel",
                'password' => Hash::make('archers123'),
                'role' => "admin",
                'email_verified_at' => now(),
            ]
        );
        User::firstOrCreate(
            ['email' => 'karljdatienza@gmail.com'],
            [
                'name' => 'Karl Atienza',
                'password' => Hash::make('archers123'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]
        );
    }
}
