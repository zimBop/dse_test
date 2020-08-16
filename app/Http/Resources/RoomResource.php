<?php

namespace App\Http\Resources;

use App\Models\Room;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            Room::ID => $this->id,
            Room::NAME => $this->name,
            'timeslots' => TimeslotResource::collection($this->timeslots),
        ];
    }
}
