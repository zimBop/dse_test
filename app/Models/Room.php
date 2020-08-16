<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public const ID = 'id';
    public const NAME = 'name';
    public const MAX_CAPACITY = 'max_capacity';

    protected $fillable = [
        self::NAME,
        self::MAX_CAPACITY,
    ];

    public function timeslots()
    {
        return $this->hasMany(Timeslot::class);
    }
}
