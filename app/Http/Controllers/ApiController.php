<?php

namespace App\Http\Controllers;

use App\Models\OutService;
use App\Models\Reservation;
use App\Models\Room;

class ApiController extends Controller
{
    public function getRoomsAvailableByDates($fromDate, $toDate, $room = null)
    {
        $fromDate = date('Y-m-d', strtotime($fromDate));
        $toDate = date('Y-m-d', strtotime($toDate));

        $queryFromDate = Reservation::select(['reservation.id', 'reservation.from_date', 'reservation.to_date', 'reserved_room.room_id'])->join('reserved_room', function ($join) {
            $join->on('reservation.id', '=', 'reserved_room.reservation_id');
        })->whereBetween('from_date', [$fromDate, $toDate]);

        $reservations = Reservation::select(['reservation.id', 'reservation.from_date', 'reservation.to_date', 'reserved_room.room_id'])->join('reserved_room', function ($join) {
            $join->on('reservation.id', '=', 'reserved_room.reservation_id');
        })->whereBetween('to_date', [$fromDate, $toDate])->orderBy('reservation.id', 'ASC')->union($queryFromDate)->get();

        $arrReservationsReservedRoomId = $reservations->unique('room_id')->pluck('room_id')->toArray();

        //Find room outservices
        $queryOutserviceFromDate = Outservice::whereBetween('from_date', [$fromDate, $toDate]);
        $outservices = OutService::whereBetween('to_date', [$fromDate, $toDate])->orderBy('room_id', 'ASC')->union($queryOutserviceFromDate)->get();
        $arrOutservicesRoomsId = (!$outservices->isEmpty()) ? $outservices->pluck('room_id')->toArray() : [];

        if ((!is_null($room)) && ($key = array_search($room, $arrOutservicesRoomsId)) !== false) {
            unset($arrOutservicesRoomsId[$key]);
        }

        //Join Two Arrays for queries
        $arrReservationsReservedRoomId = array_merge($arrReservationsReservedRoomId, $arrOutservicesRoomsId);

        $roomsAvailable = Room::whereNotIn('id', $arrReservationsReservedRoomId)->get();

        return response()->json($roomsAvailable);
    }
}
