<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Category;
use Faker\Generator as Faker;
use App\User;
$factory->define(Category::class, function (Faker $faker) {
    $word = $faker->word();
    return [
        'name'      => $word,
        'slug'      => Str::slug($word),
        'user_id'   => function(){
            return User::all()->random();
        }
    ];
});
