<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Articles;
use Faker\Generator as Faker;

$factory->define(Articles::class, function (Faker $faker) {
    return [
        'title' => $faker->text(50),
        'slug' => $faker->slug(),
        'body' => $faker->paragraph(rand(5,20))
    ];
});
