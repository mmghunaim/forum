<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Question;
use App\Models\Category;
use App\User;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {
    $title = $faker->text(10);
    return [
        'title'         => $title,
        'slug'          => Str::slug($title),
        'body'          => $faker->text(40),
        'category_id'   => function(){
            return Category::all()->random();
        },
        'user_id'       => function(){
            return User::all()->random();
        }
    ];
});
