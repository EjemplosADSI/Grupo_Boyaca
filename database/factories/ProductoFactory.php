<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Categoria;
use App\Producto;
use Faker\Generator as Faker;

$factory->define(Producto::class, function (Faker $faker) {
    return [
        'id' => $faker->unique()->randomDigit,
        'nombre' => $faker->unique()->company,
        'categoria_id' => Categoria::all()->random()->id,
        'referencia_fabrica' => $faker->md5,
        'codigo_barras' => $faker->unique()->ean13,
        'unidad_medida' => $faker->unique()->word,
        'descripcion'=> $faker->text($maxNbChars = 200),
        'stock'=> $faker->randomDigit,
        'iva'=> $faker->numberBetween($min = 0, $max = 19),
        'precio'=> $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL)

    ];
});
