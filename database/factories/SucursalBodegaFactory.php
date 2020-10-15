<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SucursalBodegas;
use Faker\Generator as Faker;

$factory->define(SucursalBodegas::class, function (Faker $faker) {
    return [
        'id' => $faker->unique()->numberBetween(1,50000),
        'sucursal_id' => Sucursal::all()->random()->id,
        'bodega_id' => Bodega::all()->random()->id,
        'estado' => $faker->randomElement(BasicStatus::getValues()),
    ];
});
