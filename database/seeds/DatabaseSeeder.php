<?php

use App\Models\Room;
use App\Models\Timeslot;
use App\Models\Reservation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $room1 = factory(Room::class)->create([
            Room::MAX_CAPACITY => 10
        ]);
        $this->createTimeslot($room1, '10:00:00', '11:00:00', 9);
        $this->createTimeslot($room1, '11:00:00', '12:00:00', 9);
        $this->createTimeslot($room1, '14:00:00', '15:30:00', 10);

        $room2 = factory(Room::class)->create([
            Room::MAX_CAPACITY => 10
        ]);
        $this->createTimeslot($room2, '10:00:00', '11:00:00', 4);
        $this->createTimeslot($room2, '11:30:00', '12:30:00', 7);
        $this->createTimeslot($room2, '15:30:00', '16:00:00', 10);

        $room3 = factory(Room::class)->create([
            Room::MAX_CAPACITY => 10
        ]);
        $this->createTimeslot($room3, '10:00:00', '11:00:00', 10);
        $this->createTimeslot($room3, '11:00:00', '12:00:00', 9);
        $this->createTimeslot($room3, '14:00:00', '15:30:00', 9);
    }

    protected function createTimeslot($room, $timeslotStart, $timeslotEnd, $reservationsNumber)
    {
        $timeslot = factory(Timeslot::class)->create([
            Timeslot::ROOM_ID => $room->id,
            Timeslot::START => $timeslotStart,
            Timeslot::END => $timeslotEnd,
        ]);

        factory(Reservation::class, $reservationsNumber)->create([
            Reservation::TIMESLOT_ID => $timeslot->id,
        ]);
    }
}
