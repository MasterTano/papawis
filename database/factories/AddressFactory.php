<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Address::class, function (Faker $faker) {
    return [
        'address_line1' => $faker->words(3, true),
        'address_line2' => $faker->words(3, true),
        'city_town' => $faker->words(3, true),
        'province' => $faker->words(3, true),
        'zip_code' => $faker->numberBetween(1000, 2000),
        'country_code' => $faker->countryCode(),
    ];
});
