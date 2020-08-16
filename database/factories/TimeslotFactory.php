<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Timeslot;
use App\Models\Room;
use Faker\Generator as Faker;

$factory->define(Timeslot::class, function (Faker $faker) {
    $room = Room::first() ?: factory(Room::class)->create();

    $start = now();

    $minutes = $faker->randomElement([0, 30]);

    $end = $start->addHour()->addMinutes($minutes);

    return [
        Timeslot::ROOM_ID => $room->id,
        Timeslot::START => $start->format('H:i:s'),
        Timeslot::END => $end->format('H:i:s'),
    ];
});
