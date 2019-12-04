<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

trait CalendarTrait
{

    public function calendar(Request $request)
    {
        $size = $request->filled('size') ? $request->size : 15;
        $dd =  $request->filled('dd') ? $request->dd : Carbon::now()->day;
        $mm =  $request->filled('mm') ? $request->mm : Carbon::now()->month;
        $yy =  $request->filled('yyyy') ? $request->yyyy : Carbon::now()->year;

        $dt = Carbon::create($yy, $mm, $dd);

        $dateFrom = $dt->subMonths(1)->toDateString();
        $dateTo =  $dt->addMonths(3)->toDateString();

        $reservations = DB::table('reserved_room')
            ->join('reservation', 'reserved_room.reservation_id', '=', 'reservation.id')
            ->join('rooms', 'reserved_room.room_id', '=', 'rooms.id')
            ->select('reserved_room.*', 'reservation.from_date', 'reservation.to_date', 'rooms.name')
            ->whereBetween('from_date', [$dateFrom, $dateTo])
            ->orWhereBetween('to_date', [$dateFrom, $dateTo])
            ->get();

        $rooms = DB::table('rooms')->get();

        $dataReservations = [];
        foreach ($reservations as $reservation) {
            $dataReservations[] = [
                "room" => $reservation->room_id,
                "start_date" => $reservation->from_date,
                "end_date" => $reservation->to_date,
                "text" => $reservation->id,
                "id" => $reservation->id
            ];
        }

        $dataRooms = [];
        foreach ($rooms as $room) {
            $dataRooms[] = [
                "value" => $room->id,
                "label" => $room->name
            ];
        };

        return [
            'reservations' => $dataReservations,
            'rooms' => $dataRooms,
            'size' => $size,
            'dd' => $dd,
            'mm' => $mm,
            'yy' => $yy
        ];
    }

    public function calendarAjaxRequest()
    {
        return view('calendarAjaxRequest');
    }
    public function calendarAjaxRequestPost(Request $request)
    {
        $input = $request->all();

        DB::table('reserved_room')
            ->join('reservation', 'reserved_room.reservation_id', '=', 'reservation.id')
            ->join('rooms', 'reserved_room.room_id', '=', 'rooms.id')
            ->where('reserved_room.id', $input['id'])
            ->update([
                'reservation.from_date' => $input['yyyy_s'] . '-' . $input['mm_s'] . '-' . $input['dd_s'],
                'reservation.to_date' => $input['yyyy_e'] . '-' . $input['mm_e'] . '-' . $input['dd_e'],
                'reserved_room.room_id' => $input['room']
            ]);

        return response()->json(['success' => 'Cambio la fecha!']);
    }
}
