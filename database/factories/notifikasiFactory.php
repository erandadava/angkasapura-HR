<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\notifikasi;
use Faker\Generator as Faker;

$factory->define(notifikasi::class, function (Faker $faker) {

    return [
        'user_id' => $faker->randomDigitNotNull,
        'konten_id' => $faker->randomDigitNotNull,
        'link_id' => $faker->text,
        'pesan' => $faker->word,
        'status' => $faker->word,
        'status_baca' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
