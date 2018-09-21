<?php

use Faker\Generator as Faker;
use App\Company;
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
$factory->define(App\Employee::class, function (Faker $faker) {

    return [
        'company_id'  => Company::all()->random()->id,
        'name'        => $faker->name,
        'last_name'   => $faker->name,
        'email'       => $faker->unique()->safeEmail,
        'phone'       => $faker->phoneNumber,
    ];
});
