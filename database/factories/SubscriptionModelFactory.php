<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\SubscriptionModel;
use Faker\Generator as Faker;

$factory->define(SubscriptionModel::class, function (Faker $faker) {
    return [
        "slug" => $faker->slug,
        "name" => $faker->word,
        "description" => $faker->optional()->text,
        "is_active" => $faker->boolean
    ];
});
