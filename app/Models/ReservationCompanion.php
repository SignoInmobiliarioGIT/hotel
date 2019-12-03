<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationCompanion extends Model
{
    public $timestamps = false;
    public $table = 'reservation_companion';

    public $fillable = ['reservation_id','name','dni','age','relationship','assigned_room_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function status()
    {
        return $this->belongsTo(Reservation::class,'reservation_id');
    }

    public function assigned_room()
    {
        return $this->belongsTo(Room::class, 'assigned_room_id');
    }
}
