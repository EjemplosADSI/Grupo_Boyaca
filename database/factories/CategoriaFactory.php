<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Categoria;
use App\Enums\BasicStatus;
use Faker\Generator as Faker;

$factory->define(Categoria::class, function (Faker $faker) {
    return [
        'id' => $faker->unique()->randomDigit,
        'nombre' => $faker->word,
        'descripcion'=> $faker->text($maxNbChars = 200),
        'estado' => $faker->randomElement(BasicStatus::getValues())
    ];
});
