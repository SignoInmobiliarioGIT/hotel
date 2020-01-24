<?php

namespace App\Http\Controllers;

use App\Models\CleaningStatus;
use App\Models\Reservation;
use App\Models\ReservationCompanion;
use App\Models\Room;
use App\Models\StateOfService;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ReservationController extends Controller
{

    public function index(Request $request)
    {

        $reservations = Reservation::withTrashed();

        // ddd(substr($request->dateRange, 0, 9));
        // if ($request->filled('dateRange')) {
        //     $from_date = Carbon::createFromFormat('d-m-Y', substr($request->dateRange, 0, 10))->format('Y-m-d');
        //     $to_date = Carbon::createFromFormat('d-m-Y', substr($request->dateRange, -10))->format('Y-m-d');
        //     // $reservations->where('from_date', '>=', substr($request->dateRange, 0, 9));
        //     // $reservations->where('to_date', '<=', substr($request->dateRange, -10));
        //     $reservations->where('from_date', '<=', $to_date);
        //     $reservations->where('to_date', '>=', $from_date);
        // } else {
        //     $reservations->whereRaw('from_date >= CURDATE()');
        //     $reservations->whereRaw('to_date <= CURDATE() + INTERVAL 30 DAY');
        // }
        // ddd($reservations->toSql());

        return view('reservations.index')
            ->with(['reservations' => $reservations->paginate(15), 'title' => 'Reservas']);
    }

    /*
     * Metodo para almacenar una reserva.
     */
    public function store(CreateReservationsRequest $request)
    {
    }

    /*
     * Metodo para mostrar la pantalla de edición de reserva.
     */
    public function edit($id)
    {
    }

    public function update(UpdateReservationRequest $request)
    {
    }

    /*
     * Metodo para eliminar una reserva.
     */
    public function destroy($id)
    {
    }

    /*
     * Metodo para restaurar una reserva.
     */
    public function restore($id)
    {
    }


    public function getCheckIn()
    {
        $reservations = Reservation::where('from_date', Carbon::now()->format('Y-m-d'))
            ->where('status_id', 1)
            ->where('status_id', '!=', 4)
            ->paginate(15);
        return view('reservations.index')->with(['reservations' => $reservations, 'title' => 'Check In']);
    }

    public function getCheckOut()
    {
        $reservations = Reservation::where('to_date', Carbon::now()->subDays(1)->format('Y-m-d'))
            ->where('status_id', 2)
            ->where('status_id', '!=', 4)
            ->paginate(15);

        return view('reservations.index')->with(['reservations' => $reservations, 'title' => 'Check Out']);
    }

    public function show($id)
    {
        return view('reservations.show')
            ->with('reservation', Reservation::withTrashed()->find($id));
    }
}
