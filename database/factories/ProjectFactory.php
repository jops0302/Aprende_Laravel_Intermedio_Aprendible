<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(App\Project::class, function (Faker $faker) {
    return [
        'title' => $title = $faker->sentence,
        'url' => Str::slug($title),
        'description' => $faker->paragraph,
    ];
});
