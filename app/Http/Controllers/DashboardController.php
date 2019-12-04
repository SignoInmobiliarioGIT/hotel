<?php

namespace App\Http\Controllers;

use App\Traits\CalendarTrait;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
}
