<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\detalleVenta;
use App\Enums\EstadoVenta;
use App\Enums\FormaPago;
use App\Sucursal;
use App\User;
use App\Venta;
use App\Producto;
use Faker\Generator as Faker;

$factory->define(detalleVenta::class, function (Faker $faker) {
    return [
        'id' => $faker->unique()->randomDigit,
        'valor_unitario' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
        'descuento' => $faker->randomDigit,
        'cantidad' => $faker->randomDigit,
        'producto_id' => Producto::all()->random()->id,
        'venta_id' => Venta::all()->random()->id,
        'estado' => $faker->randomElement(EstadoVenta::getValues()),
    ];
});
