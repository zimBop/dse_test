<?php

namespace App\Services;

use App\Models\Timeslot;

interface ReservationServiceInterface
{
    public function isTimeslotAvailable(Timeslot $timeslot): bool;
}
