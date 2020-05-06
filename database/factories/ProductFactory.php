<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        //Generate Product Dummy Data
        'name' => $faker->sentence(2),
        'description' => $faker->sentence(15),
        'price' => $faker->numberBetween(100, 4000),
    ];
});