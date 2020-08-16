<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timeslot extends Model
{
    public const ID = 'id';
    public const ROOM_ID = 'room_id';
    public const START = 'start';
    public const END = 'end';

    protected $fillable = [
        self::ROOM_ID,
        self::START,
        self::END,
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
