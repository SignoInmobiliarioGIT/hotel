<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class reservationStatus extends Model
{
    public $table = 'reservation_statuses';

    public $fillable = ['description', 'color'];

    static function toScheduler()
    {
        return DB::table('reservation_statuses')
            ->select(DB::raw('id as value, description as label'))
            ->get()
            ->toArray();
    }
}
