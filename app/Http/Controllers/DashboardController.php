<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    use \App\Traits\CalendarTrait;

    public function index()
    {
        $calendar = $this->calendar();
        return view('dashboard', [
            'reservations' => $calendar['reservations'],
            'rooms' => $calendar['rooms'], 'now' => Carbon::now()
        ]);
    }
}
