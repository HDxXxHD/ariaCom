<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Category;
use App\Product;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'type' => $faker->randomElement($array = array ('admin','user','author')),
        'user_photo' => $faker->imageUrl,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});


$factory->define(Category::class, function (Faker $faker) {
    return [
        'cat_name' => $faker->name,
        'Desc' => $faker->paragraph,
        'cat_photo' => $faker->imageUrl,
    ];
});


$factory->define(Product::class, function (Faker $faker) {
    return [
        'category_id' => rand(1,10),
        'user_id' => rand(1,10),
        'comment_id' => rand(1,10),
        'pro_title' => $faker->name,
        'pro_desc' => $faker->paragraph,
        'pro_brand' => $faker->company,
        'pro_origin' => $faker->cityPrefix,
        'pro_model' => $faker->word,
        'pro_packing' => $faker->text($maxNbChars = 100),
        'pro_termsSale' => $faker->text,
        'pro_incoterms' => $faker->word,
        'pro_payType' => $faker->text,
        'pro_color' => $faker->colorName,
        'pro_photo' => $faker->imageUrl,
    ];
});
