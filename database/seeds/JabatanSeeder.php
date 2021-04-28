<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jabatan')->insert([
            [
                'nama_jabatan' => 'staf-hrd',
                'gaji_pokok' => 4500000,
                'tunjangan_jabatan' => 300000,
                'tunjangan_makan_perhari' => 25000,
                'tunjangan_transport_perhari' => 20000,
            ], [
                'nama_jabatan' => 'staf-accounting',
                'gaji_pokok' => 3500000,
                'tunjangan_jabatan' => 300000,
                'tunjangan_makan_perhari' => 25000,
                'tunjangan_transport_perhari' => 20000,
            ]

        ]);
    }
}