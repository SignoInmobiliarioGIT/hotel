<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservedRoom extends Model
{
    public $timestamps = true;

    public $table = 'reserved_room';

    public $fillable = ['reservation_id', 'room_id', 'price'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
