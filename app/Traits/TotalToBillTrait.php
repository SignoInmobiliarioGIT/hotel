<?php

namespace App\Traits;

use App\Models\ReservedRoom;
use App\Models\Room;
use Illuminate\Support\Carbon;

trait TotalToBillTrait
{
    public static function get($from, $to, $nightPrice)
    {
        $days = TotalToBillTrait::getDays($from, $to);
        return $nightPrice * $days;
    }

    private static function getDays($from, $to)
    {
        $end = Carbon::parse($to);
        return $end->diffInDays(Carbon::parse($from)) + 1;
    }
}
