<?php

namespace App\Http\Controllers;

use App\Traits\CalendarTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Reservation;

class SchedulerController extends Controller
{
    use CalendarTrait;

    public function index(Request $request)
    {
        $response = [
            'data' => [
                ['text' => 'reserva 1', 'start_date' => '2019-12-18', 'end_date' => '2019-12-22', 'room' => '1', 'id' => '1', 'status' => '1', 'is_paid' => '1'],
                ['text' => 'reserva 2', 'start_date' => '2019-12-20', 'end_date' => '2019-12-23', 'room' => '2', 'id' => '2', 'status' => '1', 'is_paid' => '1']
            ],
            'collections' => [
                'rooms' => [
                    ['value' => '1', 'label' => 'Hab 1', 'type' => '4', 'status' => '1'],
                    ['value' => '2', 'label' => 'Hab 2', 'type' => '2', 'status' => '2'],
                    ['value' => '3', 'label' => 'Hab 3', 'type' => '2', 'status' => '1'],
                    ['value' => '4', 'label' => 'Hab 4', 'type' => '4', 'status' => '3'],
                    ['value' => '5', 'label' => 'Hab 100', 'type' => '3', 'status' => '2'],
                    ['value' => '6', 'label' => 'Hab 101', 'type' => '3', 'status' => '1'],
                    ['value' => '7', 'label' => 'Hab 102', 'type' => '3', 'status' => '1'],
                    ['value' => '8', 'label' => 'Hab 103', 'type' => '3', 'status' => '2']
                ],
                'roomTypes' => [
                    ['value' => '1', 'label' => 'Simple'],
                    ['value' => '2', 'label' => 'Doble'],
                    ['value' => '3', 'label' => 'Triple'],
                    ['value' => '4', 'label' => 'Suite']
                ],
                'roomStatuses' => [
                    ['value' => '1', 'label' => 'Lista'],
                    ['value' => '2', 'label' => 'Sucia'],
                    ['value' => '3', 'label' => 'Limpiar']
                ],
                'bookingStatuses' => [
                    ['value' => '1', 'label' => 'Nueva'],
                    ['value' => '2', 'label' => 'Confirmada'],
                    ['value' => '3', 'label' => 'De entrada'],
                    ['value' => '4', 'label' => 'De salida']
                ]
            ]
        ];
        return response()->json($response);
    }

    public function store(Request $request)
    {

        $reservation = new Reservation();

        $reservation->text = strip_tags($request->text);
        $reservation->start_date = $request->start_date;
        $reservation->end_date = $request->end_date;
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
