<?php

namespace App\Http\Controllers;

use App\Models\CleaningStatus;
use App\Models\Customer;
use App\Traits\CalendarTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Reservation;
use App\Models\reservationStatus;
use App\Models\Room;
use App\Models\RoomCategory;
use Illuminate\Support\Facades\DB;

class SchedulerController extends Controller
{
    use CalendarTrait;

    public function index(Request $request)
    {
        $rooms = DB::table('rooms')
            ->select(DB::raw('id as value, name as label,status, room_category as type, status'))
            ->get()
            ->toArray();

        $response = [
            'data' => Reservation::toScheduler(),
            'collections' => [
                'rooms' => Room::toScheduler(),
                'roomTypes' => RoomCategory::toScheduler(),
                'roomStatuses' => CleaningStatus::toScheduler(),
                'bookingStatuses' => ReservationStatus::toScheduler(),
                'customers' => Customer::toScheduler()
            ]
        ];
        return response()->json($response);
    }

    public function store(Request $request)
    {
        $reservation = new Reservation();

        $reservation->customer_id = 1;
        $reservation->total_to_bill = 10000;

        // $reservation->from_date = Carbon::createFromFormat('d-m-Y', $request->start_date)->format('Y-m-d');
        // $reservation->to_date = Carbon::createFromFormat('d-m-Y', $request->end_date)->format('Y-m-d');

        $reservation->from_date = $request->start_date;
        $reservation->to_date = $request->end_date;

        $reservation->save();

        return response()->json([
            "action" => "inserted",
            "tid" => $reservation->id
        ]);
    }

    public function update($id, Request $request)
    {
        $reservation = Reservation::find($id);

        $reservation->text = strip_tags($request->text);
        $reservation->start_date = $request->start_date;
        $reservation->end_date = $request->end_date;
        $reservation->save();

        return response()->json([
            "action" => "updated"
        ]);
    }

    public function destroy($id)
    {
        $reservation = Reservation::find($id);
        $reservation->delete();

        return response()->json([
            "action" => "deleted"
        ]);
    }
}
