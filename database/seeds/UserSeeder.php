<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('12345678'),
                'remember_token' => Str::random(40),
            ],
            [
                'name' => 'hrd',
                'username' => 'hrd',
                'email' => 'hrd@hrd.com',
                'password' => bcrypt('12345678'),
                'remember_token' => Str::random(40),
            ],
            [
                'name' => 'hrd-staff',
                'username' => 'hrd-staff',
                'email' => 'hrd-staff@hrd.com',
                'password' => bcrypt('12345678'),
                'remember_token' => Str::random(40),
            ],
        ]);
    }
}