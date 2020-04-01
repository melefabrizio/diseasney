<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name'     => $faker->name,
        'email'    => $faker->unique()->email,
        'password' => app('hash')->make('12345'),
    ];
});

$factory->define(\App\Rating::class, function (Faker $faker){

    $user = User::inRandomOrder()->first();
    $user instanceof User ? $userId = $user->id : $userId = null;

    $userIdAndMovie = $faker->unique()->regexify("/$userId-[1-7]?[0-9]");
    $movieId = explode("-",$userIdAndMovie)[1];

   return [
       'user_id' => $userId,
       'movie_id' => $movieId,
       'overall' => $faker->randomFloat(1,0,9),
       'score' => $faker->randomFloat(1,0,9),
       'bad_guy' => $faker->randomFloat(1,0,9),
       'story' => $faker->randomFloat(1,0,9),
       'animation' => $faker->randomFloat(1,0,9),
       'universe' => $faker->randomFloat(1,0,9),
       'good_guy' => $faker->randomFloat(1,0,9),
   ];
});
