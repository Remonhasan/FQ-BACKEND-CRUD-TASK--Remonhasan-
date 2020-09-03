<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
     'title' => $faker->company,
     'description' => $faker->paragraph(20),
     'user_id'=>'1'
    ];
});
