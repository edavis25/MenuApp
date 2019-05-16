<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Addon;
use App\AddonGroup;
use Faker\Generator as Faker;

$factory->define(Addon::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'price' => $faker->randomNumber()
    ];
});

$factory->state(Addon::class, 'with-group', function (Faker $faker) {
    return [
        'addon_group_id' => factory(AddonGroup::class)->state('with-menu-item')->create()->id
    ];
});