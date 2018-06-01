<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'detail' => $faker->text(100),
        'price' => $faker->numberBetween(100, 100),
        'stock' => $faker->randomDigit,
        'discount' => $faker->numberBetween(2, 30),
        'user_id' => function(){
            return \App\User::all()->random();
        }
    ];
});
