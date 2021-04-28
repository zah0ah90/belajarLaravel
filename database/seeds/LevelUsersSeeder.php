<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('level_users')->insert([
            [
                'nama_level_user' => 'Admin',
            ],
            [
                'nama_level_user' => 'Hrd',
            ],
            [
                'nama_level_user' => 'Hrd-Staff'
            ]
        ]);
    }
}