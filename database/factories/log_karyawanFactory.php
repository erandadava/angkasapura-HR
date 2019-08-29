<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\log_karyawan;
use Faker\Generator as Faker;

$factory->define(log_karyawan::class, function (Faker $faker) {

    return [
        'id_karyawan_fk' => $faker->randomDigitNotNull,
        'id_jabatan' => $faker->randomDigitNotNull,
        'id_status1' => $faker->randomDigitNotNull,
        'id_status2' => $faker->randomDigitNotNull,
        'id_unitkerja' => $faker->randomDigitNotNull,
        'id_org' => $faker->randomDigitNotNull,
        'id_posisi' => $faker->randomDigitNotNull,
        'id_tipe_kar' => $faker->randomDigitNotNull,
        'id_fungsi' => $faker->randomDigitNotNull,
        'id_klsjabatan' => $faker->randomDigitNotNull,
        'id_unit' => $faker->randomDigitNotNull,
        'entry_date' => $faker->date('Y-m-d H:i:s'),
        'update_date' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
