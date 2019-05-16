<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\AddonGroup;
use App\MenuItem;
use Faker\Generator as Faker;

$factory->define(AddonGroup::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'description' => $faker->paragraph,
        'required' => $faker->boolean,
        'exclusive' => $faker->boolean
    ];
});

$factory->state(AddonGroup::class, 'with-menu-item', function (Faker $faker) {
    return [
        'menu_item_id' => factory(MenuItem::class)->create()->id
    ];
});
