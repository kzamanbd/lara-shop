<?php

use App\Models\Product;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->text(50),
        'slug' => $faker->slug(),
        'category_id' => random_int(1,5),
        'product_price' => random_int(600,20000),
        'sale_price' => random_int(700,21000),
        'product_color' => $faker->colorName,
        'alert_quantity' => '1',
        'quantity' => random_int(5,10),
        'description' => $faker->realText(1000),
        'product_image' => random_int(1,20).'.jpg'
    ];
});
