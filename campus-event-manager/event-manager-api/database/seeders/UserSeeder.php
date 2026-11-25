<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'department' => 'IT',
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        DB::table('users')->insert([
            'name' => 'Organizer 1',
            'email' => 'organizer1@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'organizer',
            'department' => 'IT',
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        DB::table('users')->insert([
            'name' => 'Organizer 2',
            'email' => 'organizer2@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'organizer',
            'department' => 'Engineering',
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        DB::table('users')->insert([
            'name' => 'Student User',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'student',
            'department' => 'IT',
            'created_at' => now(),
            'updated_at' => now(),

        ]);
    }
}
