<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\WarrantyOption;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Traits\ReservationTrait;

class ReservationController extends Controller
{
    use ReservationTrait;

    public function index(Request $request)
    {

        $dates = ReservationTrait::getDates($request);

        $reservations = Reservation::whereDate('from_date', '>=', $dates->fromDate)
            ->whereDate('to_date', '<=', $dates->toDate)
            ->get();


        return view('reservations.index')
            ->with([
                'reservations' => $reservations,
                'title' => 'Reservas',
                'dateRange' => $dates->dateRange
            ]);
    }

    /*
     * Metodo para almacenar una reserva.
     */
    public function store(Request $request)
    {
    }

    /*
     * Metodo para mostrar la pantalla de edición de reserva.
     */
    public function edit($id)
    {
    }

    public function update(Request $request)
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
        return view('reservations.check_in')->with([
            'reservations' => ReservationTrait::getChekIn(),
            'title' => 'Check In'
        ]);
    }

    public function getCheckOut()
    {
        return view('reservations.check_out')->with([
            'reservations' => ReservationTrait::getChekOut(),
            'title' => 'Check Out'
        ]);
    }

    public function show($id)
    {
        return view('reservations.show')
            ->with('reservation', Reservation::withTrashed()->find($id));
    }

    public function create()
    {
        return view('reservations.create')
            ->with('title', 'Reserva - Crear')
            ->with('warranty_options', WarrantyOption::all());
    }


    public function all()
    {
        $reservations = Reservation::withTrashed();

        return view('reservations.index')
            ->with(['reservations' => $reservations->paginate(15), 'title' => 'Reservas']);
    }
}
