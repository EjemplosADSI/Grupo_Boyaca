<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Departamento;
use App\Enums\BasicStatus;
use App\Enums\DepartamentoRegion;
use Faker\Generator as Faker;

$factory->define(Departamento::class, function (Faker $faker) {
    return [
        'id' => $faker->unique()->numberBetween(1,500),
        'nombre' => $faker->unique()->state,
        'region' => $faker->randomElement(DepartamentoRegion::getValues()),
        'estado' => $faker->randomElement(BasicStatus::getValues())
    ];
});
