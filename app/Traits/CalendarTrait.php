<?php

namespace App\Traits;

use App\Models\Reservation;
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
            ->select(
                'reserved_room.*',
                'reservation.*',
                'rooms.name as room',
                'rooms.room_category as room_category_id',
                'room_categories.name AS room_category',
                'customers.name AS customer',
                'reservation_statuses.description as status',
                'payment_options.description as payment',
                'warranty_options.description as warranty',
                'currencies.description as currency',
            )
            ->join('reservation', 'reserved_room.reservation_id', '=', 'reservation.id')
            ->join('rooms', 'reserved_room.room_id', '=', 'rooms.id')
            ->join('room_categories', 'room_categories.id', '=', 'rooms.room_category')
            ->join('customers', 'customers.id', '=', 'reservation.customer_id')
            ->join('reservation_statuses', 'reservation_statuses.id', '=', 'reservation.status_id')
            ->join('payment_options', 'payment_options.id', '=', 'reservation.payment_option_id')
            ->join('warranty_options', 'warranty_options.id', '=', 'reservation.warranty_option_id')
            ->join('currencies', 'currencies.id', '=', 'reservation.currency_id')
            ->whereBetween('from_date', [$dateFrom, $dateTo])
            ->orWhereBetween('to_date', [$dateFrom, $dateTo])
            ->get();

        // $reservations = Reservation::whereBeetwen($dateFrom, $dateTo);


        $rooms = DB::table('rooms')->select('rooms.id', 'rooms.name', 'room_categories.name as category')
            ->join('room_categories', 'room_categories.id', 'rooms.room_category')->get();

        $dataReservations = [];
        foreach ($reservations as $reservation) {
            $dataReservations[] = [
                "room_id" => $reservation->room_id,
                "room" => $reservation->room,
                "status" => $reservation->status,
                "payment" => $reservation->payment,
                "warranty" => $reservation->warranty,
                "currency" => $reservation->currency,
                "room_category" => $reservation->room_category,
                "start_date" => $reservation->from_date,
                "end_date" => $reservation->to_date,
                "customer_id" => $reservation->customer_id,
                "customer" => $reservation->customer,
                "id" => $reservation->id
            ];
        }

        $dataRooms = [];
        foreach ($rooms as $room) {
            $dataRooms[] = [
                "value" => $room->id,
                "label" => $room->name,
                "category" => $room->category
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
