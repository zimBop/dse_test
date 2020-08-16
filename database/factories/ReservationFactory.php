<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Reservation;
use App\Models\Timeslot;
use Faker\Generator as Faker;

$factory->define(Reservation::class, function (Faker $faker) {
    $timeslot = Timeslot::first() ?: factory(Timeslot::class)->create();

    return [
        Reservation::PERSON_NAME => $faker->word,
        Reservation::TIMESLOT_ID => $timeslot->id,
    ];
});
