<?php

use App\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\OAuthProvider;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(OAuthProvider::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create()->user_id,
        'provider' => 'google',
        'provider_user_id' => $faker->uuid,
        'access_token' => $faker->uuid,
        'refresh_token' => $faker->uuid,
    ];
});
