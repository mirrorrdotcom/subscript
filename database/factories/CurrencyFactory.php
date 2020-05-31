<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Currency;
use Faker\Generator as Faker;

$factory->define(Currency::class, function (Faker $faker) {
    return [
        "name" => $faker->word,
        "code" => $faker->lexify("???"),
        "symbol" => $faker->randomLetter,
        "rate" => $faker->randomFloat(),
        "is_active" => $faker->boolean
    ];
});
