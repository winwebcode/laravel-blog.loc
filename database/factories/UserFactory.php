<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Support\Str;
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
Для запуска в консоли php artisan tinker
далее factory(App\Classname::class, 5)->create();
*/



//генератор юзеров
$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

// генератор постов
$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'content' => $faker->sentence,
        'image' => 'photo1.png',
        'date' => '01/02/21',
        'views' => $faker->numberBetween(0, 10000),
        'category_id' => 10,
        'user_id' => 1,
        'status' => 0,
        'is_featured' => 0,
    ];
});

// генератор категорий
$factory->define(Category::class, function (Faker $faker) {
    return [
        'title' => $faker->word
    ];
});

// генератор тегов
$factory->define(Tag::class, function (Faker $faker) {
    return [
        'title' => $faker->word
    ];
});
