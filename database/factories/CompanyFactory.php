<?php

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
$factory->define(App\Company::class, function (Faker $faker) {

    $filepath = public_path('upload/image/');

    return [
        'name'      => $faker->name,
        'email'     => $faker->unique()->safeEmail,
        'address'   => $faker->address,
        'website'   => $faker->name,
        'logo'      => $faker->image($filepath,300,300),
    ];
});
