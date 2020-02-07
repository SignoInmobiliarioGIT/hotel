<?php

namespace App\Traits;

use App\Models\Reservation;
use Illuminate\Http\Request;
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

    static function getDates($request)
    {
        if ($request->exists('dateRange')) {
            $from_date = Carbon::createFromFormat('d-m-Y', substr($request->dateRange, 0, 10))->format('Y-m-d');

            $to_date = Carbon::createFromFormat('d-m-Y', substr($request->dateRange, -10))->format('Y-m-d');

            $dateRange = $request->dateRange;
        } else {
            $from_date = Carbon::now()->format('Y-m-d');
            $to_date = Carbon::now()->addDay(30)->format('Y-m-d');
            $dateRange = Carbon::now()->format('d-m-Y') . ' - ' . Carbon::now()->addDay(30)->format('d-m-Y');
        }

        return (object) [
            'dateRange' => $dateRange,
            'fromDate' => $from_date,
            'toDate' => $to_date
        ];
    }
}
