<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Court::class, function (Faker $faker) {
    return [
        'address_id' => $faker->numberBetween(1, 1000000000),
        'name' => $faker->name(),
        'rate_per_hour' => $faker->numberBetween(1000, 5000),
        'peak_rate_per_hour' => $faker->numberBetween(1000, 5000),
        'minimum_rental_per_hour' => 2,
        'operating_hour' => $faker->time(),
        'amenity' => $faker->words(3, true),
        'court_type' => $faker->randomElement(['wooden', 'cement']),
        'additional_info' => $faker->words(3, true),
    ];
});
