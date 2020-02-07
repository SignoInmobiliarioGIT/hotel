<?php

namespace App\Http\Controllers;

use App\Models\CustomerType;
use App\Models\Reservation;
use App\Models\WarrantyOption;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservationController extends Controller
{

    public function index(Request $request)
    {

        if ($request->exists('dateRange')) {
            $from_date = Carbon::createFromFormat('d-m-Y', substr($request->dateRange, 0, 10))->format('Y-m-d');

            $to_date = Carbon::createFromFormat('d-m-Y', substr($request->dateRange, -10))->format('Y-m-d');

            $dateRange = $request->dateRange;
        } else {
            $from_date = Carbon::now()->format('Y-m-d');
            $to_date = Carbon::now()->addDay(30)->format('Y-m-d');
            $dateRange = Carbon::now()->format('d-m-Y') . ' - ' . Carbon::now()->addDay(30)->format('d-m-Y');
        }

        $reservations = Reservation::whereDate('from_date', '>=', $from_date)
            ->whereDate('to_date', '<=', $to_date)
            ->get();


        return view('reservations.index')
            ->with(['reservations' => $reservations, 'title' => 'Reservas', 'dateRange' => $dateRange]);
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
            'reservations' => Reservation::getChekIn(),
            'title' => 'Check In'
        ]);
    }

    public function getCheckOut()
    {
        return view('reservations.check_out')->with([
            'reservations' => Reservation::getChekOut(),
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
