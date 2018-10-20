<?php

use Faker\Generator as Faker;

$factory->define(App\Reply::class, function (Faker $faker) {
    return [
        'body'=>$faker->text,
        'question_id'=> function () {
            return \App\Question::all()->random();
        },
        'user_id'=> function () {
            return \App\User::all()->random();
        },
    ];
});
