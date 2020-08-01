<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(App\Product::class)->create()->id;
            },
            'product_name' => $faker->company,
            'expiration_date' => $faker->sentence,
            'price' => $faker->randomNumber,
    ];
});



