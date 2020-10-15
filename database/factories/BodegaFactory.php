<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Bodega;
use App\Enums\BasicStatus;
use App\Municipio;
use App\User;
use Faker\Generator as Faker;

$factory->define(Bodega::class, function (Faker $faker) {
    return [
        'id' => $faker->unique()->randomDigit,
        'nombre' => $faker->unique()->company,
        'municipio_id' => Municipio::all()->random()->id,
        'direccion' => $faker->streetAddress,
        'telefono' => $faker->phoneNumber,
        'jefe_id' => User::all()->random()->id,
        'estado' => $faker->randomElement(BasicStatus::getValues())

    ];
});
