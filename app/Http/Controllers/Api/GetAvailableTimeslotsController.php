<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use App\Services\ReservationServiceInterface;
use Illuminate\Http\Request;

class GetAvailableTimeslotsController extends Controller
{
    public function __invoke(Request $request, ReservationServiceInterface $reservationService)
    {
        $rooms = Room::with('timeslots')->get()
            ->each(
                static function ($room) use ($reservationService) {
                    $filtered = $room->timeslots->filter(
                        static function ($timeslot, $key) use ($reservationService) {
                            return $reservationService->isTimeslotAvailable($timeslot);
                        }
                    );

                    $room->timeslots = $filtered;
                }
            );

        return response()->json(
            RoomResource::collection($rooms)
        );
    }
}
