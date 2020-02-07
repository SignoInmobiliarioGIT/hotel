<?php

namespace App\Traits\Models;

use App\Models\Reservation;
use Illuminate\Support\Carbon;

trait ReservationTrait
{
    static function getChekIn()
    {
        return Reservation::where('from_date', Carbon::now()->format('Y-m-d'))
            ->whereIn('reservation_status_id', [3, 6, 7])
            ->get();
    }

    static function getChekOut()
    {
        return Reservation::where('to_date', Carbon::now()->subDays(1)->format('Y-m-d'))
            ->whereIn('reservation_status_id', [1, 6])
            ->get();
    }
}
