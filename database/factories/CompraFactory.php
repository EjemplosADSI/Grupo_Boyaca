<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Bodega;
use App\Compra;
use App\Enums\EstadoCompra;
use App\User;
use Faker\Generator as Faker;


$factory->define(   Compra::class, function (Faker $faker) {
    return [
        'id' => $faker->unique()->randomDigit,
        'fecha' => $faker->dateTime,
        'valor_total' => $faker->randomFloat($nbMaxDecimals =null, $min = 0, $max =null),
        'proveedor_id' => User::all()->random()->id,
        'bodega_id' => Bodega::all()->random()->id,
        'estado' => $faker->randomElement(EstadoCompra::getValues()),
    ];
});
