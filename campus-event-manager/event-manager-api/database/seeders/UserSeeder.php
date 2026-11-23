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
            'name' => 'Red Josh',
            'email' => 'redJosh@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'department' => 'IT',
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        DB::table('users')->insert([
            'name' => 'Josh Atienza',
            'email' => 'karljatienza@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'organizer',
            'department' => 'IT',
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        DB::table('users')->insert([
            'name' => 'Jek Atienza',
            'email' => 'jek@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'organizer',
            'department' => 'Engineering',
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        DB::table('users')->insert([
            'name' => 'Karl Joseph Atienza',
            'email' => 'karljdatienza@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'student',
            'department' => 'IT',
            'created_at' => now(),
            'updated_at' => now(),

        ]);
    }
}
