<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Departamento;
use App\Enums\BasicStatus;
use App\Municipio;
use Faker\Generator as Faker;

$factory->define(Municipio::class, function (Faker $faker) {
    return [
        'id' => $faker->unique()->numberBetween(1,50000),
        'nombre' => $faker->name(4),
        'departamento_id' => Departamento::all()->random()->id,
        'estado' => $faker->randomElement(BasicStatus::getValues()),
    ];
});
