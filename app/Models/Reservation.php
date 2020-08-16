<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public const ID = 'id';
    public const TIMESLOT_ID = 'timeslot_id';
    public const PERSON_NAME = 'person_name';

    protected $fillable = [
        self::TIMESLOT_ID,
        self::PERSON_NAME,
    ];

    public function timeslot()
    {
        return $this->belongsTo(Timeslot::class);
    }
}
