<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class reservationStatus extends Model
{
    public $table = 'reservation_statuses';

    public $fillable = ['description','color'];
}
