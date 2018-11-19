<?php

use Faker\Generator as Faker;

$factory->define(App\Journal::class, function (Faker $faker) {
    return [
        'type' => $faker->randomElement(['DIURNA', 'NOCTURNA', 'MIXTA'])
    ];
});
