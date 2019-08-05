<?php

use Illuminate\Support\Str;
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

$factory->define(\App\Repositories\User\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'created_at' => now(),
        'updated_at' => now(),
        'password' => '$2y$10$iDTktw.LjFY8gUpM/5lHnOcgIOMeM8W3GVBYSwPkdb3YcOjgk6SuC', // admin
        'remember_token' => Str::random(10)
    ];
});
