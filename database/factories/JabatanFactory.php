<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Jabatan;

use Faker\Generator as Faker;

$factory->define(Jabatan::class, function (Faker $faker) {
    return [
        'nama_jabatan' => $faker->firstName('male'),
        'gaji_pokok' => 3000000,
        'tunjangan_jabatan' => 300000,
        'tunjangan_makan_perhari' => $faker->numberBetween(15000, 25000),
        'tunjangan_transport_perhari' => 20000,
    ];
});