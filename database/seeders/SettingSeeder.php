<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'company_name' => Str::random(10),
            'company_email' => Str::random(10).'@gmail.com',
            'company_phone' => '(49) 94131-5253',
            'company_zip' => '13894-276',
            'company_address' => 'Braun Place',
            'company_number' => '123',
            'company_neighborhood' => 'Parkway',
            'company_city' => 'Kovacekville',
            'company_state' => 'AL',
            'company_logo' => 'sample.jpg',
        ]);
    }
}
