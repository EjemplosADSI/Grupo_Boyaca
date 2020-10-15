<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Compra;
use App\Enums\EstadoCompra;
use App\Producto;
use App\DetalleCompra;
use Faker\Generator as Faker;

$factory->define(DetalleCompra::class, function (Faker $faker) {
    return [
        'id' => $faker->unique()->randomDigit,
        'valor_unitario' => $faker->randomFloat($nbMaxDecimals =null, $min = 0, $max =null),
        'cantidad' => $faker->numberBetween($min = 1, $max = 9999999999),
        'producto_id' => Producto::all()->random()->id,
        'compra_id' => Compra::all()->random()->id,
        'estado' => $faker->randomElement(EstadoCompra::getValues()),
    ];
});
