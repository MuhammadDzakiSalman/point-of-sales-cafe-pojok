<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Insert data into the users table
        DB::table('users')->insert([
            [
                'name' => 'admin',
                // 'level' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin'), // Pastikan untuk meng-hash password
                // 'remember_token' => null,
                // 'created_at' => now(),
                // 'updated_at' => now(),
            ],
        ]);
    }
}
