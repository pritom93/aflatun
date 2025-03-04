<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
                'name' => 'Admin One',
                'email' => 'admin1@example.com',
                'password' => 'password123',
                'admin_area_id' => 1,
                'role_id' => 1,
                'reset_token' => null,
                'avatar' => 'avatar1.png',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Admin Two',
                'email' => 'admin2@example.com',
                'password' => 'password123',
                'admin_area_id' => 2,
                'role_id' => 2,
                'reset_token' => null,
                'avatar' => 'avatar2.png',
                'status' => 'inactive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Admin Three',
                'email' => 'admin3@example.com',
                'password' => 'password123',
                'admin_area_id' => 3,
                'role_id' => 3,
                'reset_token' => null,
                'avatar' => 'avatar3.png',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        
    }
}