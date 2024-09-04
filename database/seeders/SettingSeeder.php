<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            'max_day_limit' => 7,
            'send_after_mail' => 1,
            'send_before_mail' => 1,
            'form_email' => 'apgoswami.eww@gmail.com',
        ]);
    }
}
