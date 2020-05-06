<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $randomNumber = rand(1, 100);
    $title = $faker->sentence(4);
    $thumbnails = "https://picsum.photos/id/{$randomNumber}/1140/500";
    return [
        'title' => $title,
        'slug' =>  Str::of($title)->slug('-'),
        'content' => $faker->sentence(50),
        'thumbnail' => $thumbnails,
        'user_id' => User::inRandomOrder()->first()->id,
    ];
});
