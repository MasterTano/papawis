<?php

use Faker\Generator as Faker;
use App\Models\Address;

$factory->define(App\Models\Court::class, function (Faker $faker) {
    return [
        'address_id' => factory(Address::class)->create()->address_id,
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
