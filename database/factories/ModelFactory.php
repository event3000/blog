<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */

// метод который создает юзеров-рыба
$factory->define(App\User::class, function (Faker\Generator $faker) { // указ модель
    static $password;

    return [ // указ массив данными
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

// метод который создает посты-рыба
// НАДО в консоли: 
// php artisan tinker 
// factory(App\Post::class, 5)->create();

$factory->define(App\Post::class, function (Faker\Generator $faker) { // указ модель

    return [ // указ массив данными
        'title' => $faker->sentence, // c пом-ю faker sentence создает Lorem Ipsum
        'content' => $faker->sentence,
        'image' => 'photo1.png',
        'date' => '08/09/17',
        'views' => $faker->numberBetween(0, 5000), // кол-во просм-ов диапазон   
        'category_id' => 1,
        'user_id' => 1,
        'status' => 1,
        'is_featured' => 0
        ];
});

// метод который создает категории - рыбы
$factory->define(App\Category::class, function (Faker\Generator $faker) { // указ модель

    return [ // указ массив данными
        'title' => $faker->word, // c пом-ю faker word
        ];
});

// метод который создает категории - тэги
$factory->define(App\Tag::class, function (Faker\Generator $faker) { // указ модель

    return [ // указ массив данными
        'title' => $faker->word, // c пом-ю faker word
        ];
});
