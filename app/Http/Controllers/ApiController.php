<?php

namespace App\Http\Controllers;

use App\Models\OutService;
use App\Models\Reservation;
use App\Models\Room;

class ApiController extends Controller
{
    public function getRoomsAvailableByDates($fromDate, $toDate, $room = null)
    {
        //Format Date
        $fromDate = date('Y-m-d', strtotime($fromDate));
        $toDate = date('Y-m-d', strtotime($toDate));
        $arrRoomsReservedId = [];
        
        $queryFromDate = Reservation::select(['reservation.id', 'reservation.from_date', 'reservation.to_date', 'reserved_room.room_id'])->join('reserved_room', function ($join) {
            $join->on('reservation.id', '=', 'reserved_room.reservation_id');
        })->whereBetween('from_date', [$fromDate, $toDate]);

        $queryToDate = Reservation::select(['reservation.id', 'reservation.from_date', 'reservation.to_date', 'reserved_room.room_id'])->join('reserved_room', function ($join) {
            $join->on('reservation.id', '=', 'reserved_room.reservation_id');
        })->whereBetween('to_date', [$fromDate, $toDate])->orderBy('reservation.id', 'ASC')->union($queryFromDate);
        
        //Get Union queries result
        $reservations = $queryToDate->get();
        $arrReservationsReservedRoomId = $reservations->unique('room_id')->pluck('room_id')->toArray();

        //Get Reservation extended date
        $reservationsExtendedDate = Reservation::select(['reservation.id', 'reservation.from_date', 'reservation.to_date', 'reserved_room.room_id'])->join('reserved_room', function ($join) {
            $join->on('reservation.id', '=', 'reserved_room.reservation_id');
        })->where('from_date', '<', $fromDate)->where('to_date', '>', $toDate)->get();

        $arrReservationsExtendedDateRoomId = (!$reservationsExtendedDate->isEmpty()) ? $reservationsExtendedDate->unique('room_id')->pluck('room_id')->toArray() : [];

        //Merge Two Arrays
        $arrReservationsReservedRoomId = array_merge($arrReservationsReservedRoomId, $arrReservationsExtendedDateRoomId);

        //Find room outservices
        $queryOutserviceFromDate = Outservice::whereBetween('from_date', [$fromDate, $toDate]);
        $outservices = OutService::whereBetween('to_date', [$fromDate, $toDate])->orderBy('room_id', 'ASC')->union($queryOutserviceFromDate)->get();
        $arrOutservicesRoomsId = (!$outservices->isEmpty()) ? $outservices->pluck('room_id')->toArray() : [];

        if ((!is_null($room)) && ($key = array_search($room, $arrOutservicesRoomsId)) !== false) {
            unset($arrOutservicesRoomsId[$key]);
        }

        //Join Two Arrays for queries
        $arrRoomsReservedId = array_merge($arrReservationsReservedRoomId, $arrOutservicesRoomsId);

        dd($arrRoomsReservedId);

        $roomsAvailable = Room::whereNotIn('id', $arrRoomsReservedId)->orderBy('name', 'ASC')->get();

        return response()->json($roomsAvailable);
    }
}
