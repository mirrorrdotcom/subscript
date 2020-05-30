<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Feature;
use App\Models\SubscriptionModel;
use Faker\Generator as Faker;

$factory->define(Feature::class, function (Faker $faker) {
    return [
        "subscription_model_id" => factory(SubscriptionModel::class),
        "slug" => $faker->slug,
        "name" => $faker->word,
        "description" => $faker->optional()->text,
        "is_active" => $faker->boolean,
        "limit" => $faker->numberBetween(-1, 100)
    ];
});
