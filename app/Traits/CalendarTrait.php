<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


trait CalendarTrait
{
    public function calendar()
    {
        $reservations = DB::table('reserved_room')
            ->join('reservation', 'reserved_room.reservation_id', '=', 'reservation.id')
            ->join('rooms', 'reserved_room.room_id', '=', 'rooms.id')
            ->select('reserved_room.*', 'reservation.from_date', 'reservation.to_date', 'rooms.name')
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
            'size' => isset($_GET['size']) ? $_GET['size'] : 15,
            'dd' => isset($_GET['dd']) ? $_GET['dd'] : Carbon::now()->day,
            'mm' => isset($_GET['mm']) ? $_GET['mm'] : Carbon::now()->month,
            'yy' => isset($_GET['yyyy']) ? $_GET['yyyy'] : Carbon::now()->year
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
