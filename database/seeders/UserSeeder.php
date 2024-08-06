<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'webtechweavers',
            'email' => 'webtechweavers@yopmail.com',
            'password' => Hash::make('Password@123'),
            'role_as' => 0,
            'status' => 1,
            'created_at' => now(),
        ]);
    }
}
