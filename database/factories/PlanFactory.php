<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Plan;
use App\Models\SubscriptionModel;
use Faker\Generator as Faker;

$factory->define(Plan::class, function (Faker $faker) {
    return [
        "subscription_model_id" => factory(SubscriptionModel::class),
        "slug" => $faker->slug,
        "name" => $faker->word,
        "description" => $faker->optional()->text,
        "is_active" => $faker->boolean,
        "trial_period" => $faker->numerify("#"),
        "trial_interval" => $faker->numberBetween(0, 8),
        "recurring_period" => $faker->numerify("#"),
        "recurring_interval" => $faker->numberBetween(0, 8),
        "grace_period" => $faker->numerify("#"),
        "grace_interval" => $faker->numberBetween(0, 8),
        "sort_order" => $faker->numerify("#")
    ];
});
