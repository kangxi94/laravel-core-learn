<?php

use App\Category;
use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    $categorys = Category::all()->pluck('id')->toArray();
    return [
        'title' => $faker->sentence(6),
        'body'  => $faker->paragraph(10),
        'user_id'   => 1,
        'category_id' => $faker->randomElement($categorys),
    ];
});