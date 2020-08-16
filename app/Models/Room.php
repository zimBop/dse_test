<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Room
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Timeslot[] $timeslots
 * @property-read int|null $timeslots_count
 * @method static \Illuminate\Database\Eloquent\Builder|Room newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Room newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Room query()
 * @mixin \Eloquent
 */
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
