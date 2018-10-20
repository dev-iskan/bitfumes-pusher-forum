<?php

use Faker\Generator as Faker;

$factory->define(App\Like::class, function (Faker $faker) {
    return [
        'user_id'=> function () {
            return \App\User::all()->random();
        }
    ];
});
