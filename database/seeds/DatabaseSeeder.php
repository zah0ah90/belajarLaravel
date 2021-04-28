<?php

use Illuminate\Database\Seeder;
use App\Jabatan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        // $this->call(JabatanSeeder::class);
        // $this->call(LevelUsersSeeder::class);
        // $this->call(MenuSeeder::class);
        // factory(Jabatan::class, 2)->create();
        $this->call([AksesSeeder::class, MenuSeeder::class, UserSeeder::class]);
    }
}