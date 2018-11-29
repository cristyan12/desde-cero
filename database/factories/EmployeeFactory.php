<?php

use Faker\Generator as Faker;

$factory->define(App\Employee::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'document_identity' => $faker->nationalId,
        'born_date' => $faker->dateTimeBetween('-30', 'now', 'America/Caracas'),
        'hire_date' => $faker->date(),
        'profession_id' => function () {
            return rand(1, App\Profession::count());
        },
        'email' => $faker->unique()->safeEmail,
        'cell_phone' => $faker->unique()->phoneNumber,
        'home_phone' => $faker->unique()->phoneNumber,
        'address' => $faker->unique()->address,
    ];
});
