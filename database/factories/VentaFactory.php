<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Enums\EstadoVenta;
use App\Enums\FormaPago;
use App\Sucursal;
use App\User;
use App\Venta;
use Faker\Generator as Faker;

$factory->define(Venta::class, function (Faker $faker) {
    return [
        'id' => $faker->unique()->randomDigit,
        'fecha' => $faker->dateTime,
        'valor_total' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
        'cliente_id' => User::all()->random()->id,
        'vendedor_id' => User::all()->random()->id,
        'sucursal_id' => Sucursal::all()->random()->id,
        'forma_pago' => $faker->randomElement(FormaPago::getValues()),
        'estado' => $faker->randomElement(EstadoVenta::getValues()),
    ];
});
