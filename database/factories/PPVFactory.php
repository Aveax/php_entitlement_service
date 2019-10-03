<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PPV;
use Faker\Generator as Faker;

$factory->define(PPV::class, function (Faker $faker) {
    return [
        'title' => $faker->regexify('[A-Za-z0-9]{10}'),
        'content' => $faker->regexify('[A-Za-z0-9]{20}'),
    ];
});
