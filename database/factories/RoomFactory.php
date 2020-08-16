<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Room;
use Faker\Generator as Faker;

$factory->define(Room::class, function (Faker $faker) {
    return [
        Room::NAME => $faker->word,
        Room::MAX_CAPACITY => $faker->numberBetween(10, 25),
    ];
});
