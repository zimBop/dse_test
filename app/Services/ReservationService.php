<?php

namespace App\Services;

use App\Models\Timeslot;
use Illuminate\Database\Eloquent\Collection;

class ReservationService implements ReservationServiceInterface
{
    public function isTimeslotAvailable(Timeslot $timeslot): bool
    {
        return $timeslot->reservations->count() < $timeslot->room->max_capacity
            && $this->getTotalReservationsNumber($timeslot) < config('app.max_total_reservations');
    }


    /**
     * Total number of people registered in all rooms together during the timeslot
     */
    protected function getTotalReservationsNumber(Timeslot $timeslot): int
    {
        return $this->getSimilarTimeslots($timeslot)
            ->reduce(static function ($carry, $timeslot) {
                return $carry + $timeslot->reservations_count;
            }, 0);
    }

    /**
     * Get timeslots for all rooms which are the same or overlap with given
     */
    protected function getSimilarTimeslots(Timeslot $timeslot): Collection
    {
        return Timeslot::withCount('reservations')->where(Timeslot::START, '>=', $timeslot->start)
            ->where(Timeslot::START, '<', $timeslot->end)
            ->get();
    }
}
