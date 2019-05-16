<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Category;
use App\MenuItem;
use Faker\Generator as Faker;

$factory->define(MenuItem::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'description' => $faker->paragraph,
        'price' => $faker->randomNumber()
    ];
});

$factory->state(MenuItem::class, 'with-category', function(Faker $faker) {
    $category = factory(Category::class)->create();
    return [
        'category_id' => $category->id
    ];
});
