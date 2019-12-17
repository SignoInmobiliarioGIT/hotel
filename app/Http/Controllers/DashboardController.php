<?php

namespace App\Http\Controllers;

use App\Traits\CalendarTrait;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Reservation;

class DashboardController extends Controller
{
    use CalendarTrait;

    public function index(Request $request)
    {
        $calendar = $this->calendar($request);

        return view('dashboard', [
            'reservations' => $calendar['reservations'],
            'rooms' => $calendar['rooms'], 'now' => Carbon::now(),
            'size' => $calendar['size'],
            'dd' => $calendar['dd'],
            'mm' => $calendar['mm'],
            'yy' => $calendar['yy'],
        ]);
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
