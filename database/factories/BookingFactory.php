<?php

use Faker\Generator as Faker;
use App\Models\Address;
use App\Models\Booking;
use App\Models\Court;
use App\Models\User;

$factory->define(Booking::class, function (Faker $faker) {
    return [
        'court_id' => factory(Court::class)->create()->court_id,
        'user_id' => factory(User::class)->create()->user_id,
        'inclusion' => $faker->words(3, true),
        'starts_at' => now(),
        'ends_at' => now()->addHours(rand(2, 10))
    ];
});
