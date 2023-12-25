<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('system_settings')->insert([
            'app_title' => 'Al Ammer Al Daeem General Construction Ltd',
            'default_currency' => 1,
            'vat_number' => '374873873487'
        ]);
    }
}
