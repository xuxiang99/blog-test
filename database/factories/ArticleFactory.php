<?php

use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker $faker) {
    return [
		'title'      => $faker->sentence(5),
		'content'    => $faker->sentence(100),
		'user_id'    => 1,
		'tag_id'     => 0,
		'created_at' => $faker->dateTimeThisMonth(),
		'updated_at' => $faker->dateTimeThisMonth()
    ];
});
