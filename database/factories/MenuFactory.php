<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Menu;
use Faker\Generator as Faker;

$factory->define(Menu::class, function (Faker $faker) {
    $title = $faker->jobTitle;
    return [
        'parent_id' => (Menu::count() > 0) ? Menu::all()->random()->id : null,
        'title' => $title,
        'route' => $title.'.'.$faker->randomElement(['index','create','statistics']),
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'order' => $faker->randomDigit,
        'icon' => $faker->word,
        'enabled' => $faker->numberBetween($min = 0, $max = 1),
    ];
});
