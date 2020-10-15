<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Empresa;
use App\Enums\BasicStatus;
use App\Municipio;
use Faker\Generator as Faker;

$factory->define(Empresa::class, function (Faker $faker) {
    return [
        'id' => $faker->unique()->randomDigit,
        'nombre' => $faker->unique()->company,
        'nit' => $faker->unique()->numberBetween($min = 10000000000, $max = 9000000000),
        'municipio_id' => Municipio::all()->random()->id,
        'direccion' => $faker->streetAddress,
        'telefono' => $faker->phoneNumber,
        'correoElectronico' => $faker->email,
        'logo' => $faker->imageUrl(800, 600, 'cats'),
        'estado' => $faker->randomElement(BasicStatus::getValues())
    ];
});
