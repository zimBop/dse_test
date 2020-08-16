<?php

namespace Tests\Unit;

use App\Models\Reservation;
use App\Models\Room;
use App\Models\Timeslot;
use App\Services\ReservationService;
use Tests\TestCase;

class ReservationServiceTest extends TestCase
{
    private $now;
    private $reservationService;

    public function __construct()
    {
        parent::__construct();

        $this->now = now();
        $this->reservationService = app()->make(ReservationService::class);
    }

    public function testIsTimeslotAvailable(): void
    {
        $room = factory(Room::class)->create();
        $this->createTimeslot($room, $this->now, 5);
        $this->createTimeslot(factory(Room::class)->create(), $this->now, 5);
        $this->createTimeslot(factory(Room::class)->create(), $this->now->addMinutes(30), 5);
        $this->createTimeslot(factory(Room::class)->create(), $this->now->addHours(5), 5);

        $this->assertTrue($this->reservationService->isTimeslotAvailable($room->timeslots->first()));
    }

    public function testIsTimeslotNotAvailableAsRoomMaxCapacityReached(): void
    {
        $maxCapacity = 10;

        $room = factory(Room::class)->create([
            Room::MAX_CAPACITY => $maxCapacity
        ]);

        $timeslot = $this->createTimeslot($room, $this->now, $maxCapacity);

        $this->assertFalse($this->reservationService->isTimeslotAvailable($timeslot));
    }

    public function test_is_timeslot_not_available_as_max_total_reservations_reached(): void
    {
        $maxTotalReservations = config('max_total_reservations');

        $timeslot = $this->createTimeslot(factory(Room::class)->create(), $this->now, 10);
        $this->createTimeslot(factory(Room::class)->create(), $this->now, $maxTotalReservations);

        $this->assertTrue($this->reservationService->isTimeslotAvailable($timeslot));
    }

    protected function createTimeslot($room, $timeslotStart, $reservationsNumber)
    {
        $timeslot = factory(Timeslot::class)->create([
            Timeslot::ROOM_ID => $room->id,
            Timeslot::START => $timeslotStart,
        ]);

        factory(Reservation::class, $reservationsNumber)->create([
            Reservation::TIMESLOT_ID => $timeslot->id,
        ]);

        return $timeslot;
    }
}
