<?php

namespace App\Http\Controllers;

use App\Models\CleaningStatus;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\PaymentOption;
use App\Traits\CalendarTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Reservation;
use App\Models\reservationStatus;
use App\Models\ReservedRoom;
use App\Models\Room;
use App\Models\RoomCategory;
use App\Models\WarrantyOption;
use Illuminate\Support\Facades\DB;

class SchedulerController extends Controller
{

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
                'reservationStatuses' => ReservationStatus::toScheduler(),
                'customers' => Customer::toScheduler(),
                'currencies' => Currency::toScheduler(),
                'warranties' => WarrantyOption::toScheduler(),
                'payments' => PaymentOption::toScheduler(),
                'adults' => [
                    ['value' => 1, 'label' => 1],
                    ['value' => 2, 'label' => 2],
                    ['value' => 3, 'label' => 3],
                    ['value' => 4, 'label' => 4],
                    ['value' => 5, 'label' => 5]
                ],
                'children' => [
                    ['value' => 0, 'label' => 0],
                    ['value' => 1, 'label' => 1],
                    ['value' => 2, 'label' => 2]
                ]
            ]
        ];
        return response()->json($response);
    }

    public function store(Request $request)
    {

        $reservation = new Reservation();
        $reservation->from_date = $request->start_date;
        $reservation->to_date = $request->end_date;
        $reservation->status_id = 1;
        $reservation->customer_id = $request->customer_id;
        $reservation->warranty_option_id = $request->warranty_id;
        $reservation->currency_id = $request->currency_id;
        $reservation->payment_option_id = $request->payment_id;
        $reservation->total_to_bill = $request->total_to_bill;
        $reservation->adults = $request->adults;
        $reservation->children = $request->children;
        $reservation->comments = $request->comments;
        $reservation->save();

        $reserved_room = new ReservedRoom();
        $reserved_room->reservation_id = $reservation->id;
        $reserved_room->room_id = $request->room_id;
        $reserved_room->price = $request->night_price;
        $reserved_room->save();


        return response()->json([
            "action" => "inserted",
            "tid" => $reservation->id,
            "reservation_id" => $reservation->id
        ]);
    }

    public function update($id, Request $request)
    {
        $reservation = Reservation::find($request->text);
        $reservation->from_date = $request->start_date;
        $reservation->to_date = $request->end_date;
        $reservation->status_id = 1;
        $reservation->customer_id = $request->customer_id;
        $reservation->warranty_option_id = $request->warranty_id;
        $reservation->currency_id = $request->currency_id;
        $reservation->payment_option_id = $request->payment_id;
        $reservation->total_to_bill = $request->total_to_bill;
        $reservation->adults = $request->adults;
        $reservation->children = $request->children;
        $reservation->comments = $request->comments;
        $reservation->save();

        $reserved_room = ReservedRoom::where('reservation_id', $request->text)->first();
        $reserved_room->room_id = $request->room_id;
        $reserved_room->price = $request->night_price;
        $reserved_room->save();

        return response()->json([
            "action" => "updated"
        ]);
    }

    public function destroy(Request $request)
    {
        $reservation = Reservation::find($id);
        $reservation->delete();

        return response()->json([
            "action" => "deleted"
        ]);
    }
}
