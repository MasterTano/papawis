<?php

use Faker\Generator as Faker;
use App\Models\User;
use App\Models\Booking;
use App\Models\UserGame;

$factory->define(UserGame::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create()->user_id,
        'booking_id' => factory(Booking::class)->create()->booking_id,
        'status' => $faker->randomElement([UserGame::STATUS_CANCELLED, UserGame::STATUS_G])
    ];
});
