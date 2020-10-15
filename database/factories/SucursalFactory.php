<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Empresa;
use App\Enums\BasicStatus;
use App\Municipio;
use App\Sucursal;
use App\User;
use Faker\Generator as Faker;

$factory->define(Sucursal::class, function (Faker $faker) {
    return [
        'id' => $faker->unique()->randomDigit,
        'nombre' => $faker->unique()->firstNameFemale,
        'municipio_id' => Municipio::all()->random()->id,
        'direccion' => $faker->streetAddress,
        'telefono' => $faker->phoneNumber,
        'jefe_id' => User::all()->random()->id,
        'empresa_id' => Empresa::all()->random()->id,
        'estado' => $faker->randomElement(BasicStatus::getValues()),
    ];
});
