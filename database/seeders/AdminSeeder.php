<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'name' => 'apgoswamiinfo',
            'email' => 'apgoswami.eww@gmail.com',
            'password' => Hash::make('Password@123'),
            'role_as' => 1,
            'status' => 1,
            'created_at' => now(),
        ]);
    }
}
