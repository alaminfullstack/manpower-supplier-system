<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$pT5IiZVIp1D0kaw6Po7jRueAg05Yfaw1GcJdLirxRN/.LKqWiJLhe', // admin***
            'remember_token' => Str::random(10),
        ]);
    }
}
