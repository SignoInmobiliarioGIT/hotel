<?php

namespace App\Http\Controllers;

use App\Models\CleaningStatus;
use App\Models\Reservation;
use App\Models\ReservationCompanion;
use App\Models\Room;
use App\Models\StateOfService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class ReservationController extends Controller
{
    /*
     * Pantalla inicial del modulo de reservas.
     * Formulario para realizar una reserva.
     */
    public function index(Request $request)
    {
        $dateRange = $request->filled('dateRange') ? $request->dateRange : null;
        if(!$dateRange){
            $dateFrom = Carbon::now()->toDateString();
            $dateTo = Carbon::now()->toDateString();
        } else {
            $dateRangeExplode = explode(' - ', $dateRange);
            $dateFrom = Carbon::create($dateRangeExplode[0])->toDateString();
            $dateTo = Carbon::create($dateRangeExplode[1])->toDateString();
        }

        return view('reservations.index');
    }

    /*
     * Metodo para almacenar una reserva.
     */
    public function store(CreateReservationsRequest $request)
    {


        $result = ReservationService::storeReservation($request);
        if ($result) {

            \Flash::success("La reserva se ha realizado con éxito.");
            return \Response::json("OK", 200);
        } else {

            \Flash::error("Hubo un error al almacenar la reserva. Por favor intente nuevamente o comuníquese con el depto. de Sistemas.");
            return \Response::json(array("Error" => "Augh...."), 422);
        }
    }

    /*
     * Metodo para mostrar la lista de reservas.
     */
    public function list(Request $request)
    {
        // if (!Auth::user()->can("reservations.view")) {
        //     Flash::error('No tiene permisos para ver esta sección');
        //     return redirect("/home");
        // }
        $query = Reservation::query();

        if ($request->filled('from_date')) {
            $query->where('from_date', '>=', Carbon::parse($request->input('from_date'))->format('Y-m-d'));
        } elseif ($request->filled('to_date')) {
            $query->where('to_date', '<=', Carbon::parse($request->input('to_date'))->format('Y-m-d'));
        } else {
            $query->whereRaw('from_date >= curdate()');
        }
        return view('reservations.list')
            ->with("reservations", $query->get());
    }

    /*
     * Metodo para mostrar la pantalla de edición de reserva.
     */
    public function edit($id)
    {
        $reservation = Reservation::where('id', $id)->get();

        if (count($reservation) < 1) {
            \Flash::error("Reserva no encontrada.");
            return view('reservations.list');
        }
        $reservation = $reservation[0];
        $rooms = [];
        foreach ($reservation->reservedRooms as $reservedRoom) {
            $rooms[$reservedRoom->room_id] = $reservedRoom->room->name;
        }

        return view("reservations.edit")->with(['reservation' => $reservation, 'rooms' => $rooms]);
    }

    public function update(UpdateReservationRequest $request)
    {
        $result = ReservationService::updateReservation($request);
        if ($result) {

            \Flash::success("La reserva se ha realizado con éxito.");
            return \Response::json("OK", 200);
        } else {

            \Flash::error("Hubo un error al almacenar la reserva. Por favor intente nuevamente o comuníquese con el depto. de Sistemas.");
            return \Response::json(array("Error" => "Augh...."), 422);
        }
    }

    /*
     * Metodo para eliminar una reserva.
     */
    public function destroy($id)
    {
        if (Auth::user()->can("reservations.delete")) {
            $reservation = Reservation::find($id);
            $reservation->delete();
            \Flash::success("Reserva eliminada con éxito.");
            return redirect("/reservations/list");
        }
    }

    /*
     * Metodo para restaurar una reserva.
     */
    public function restore($id)
    {
        if (Auth::user()->can("reservations.delete")) {
            Reservation::withTrashed()
                ->where('id', $id)
                ->restore();
            \Flash::success("Reserva restaurada con éxito.");
            return redirect("/reservations/list");
        }
    }

    /*
     * Metodo para mostrar la lista de acompañantes.
     */
    public function companion($id)
    {
        $companion = ReservationCompanion::where('reservation_id', $id)->get();

        if (count($companion) > 0) {
            $reservation = Reservation::find($id);
            $rooms = array();
            foreach ($reservation->reservedRooms as $resRoom) {
                $rooms[$resRoom->room->id] = $resRoom->room->name;

                //$rooms[$resRoom->room->id]['name'] = $resRoom->room->name;
            }
            \Log::info($rooms);
            return view('reservations.include.tables.companionTable')->with(['companion' => $companion, 'rooms' => $rooms]);
        } else {

            return "<h1>El cliente que realizó la reserva no declaró acompañantes.</h1>";
        }
    }

    /*
     * Metodo para crear un cliente desde un bootbox (Pantalla de alerta).
     */
    public function createCustomer()
    {
        return view('customers.bootbox.create');
    }

    public function creditCardInfoFields()
    {
        return view('reservations.include.creditCardInfo');
    }

    public function checkin()
    {
        $reservations = Reservation::where('from_date', Carbon::now()->format('Y-m-d'))
            ->where('status_id', 1)
            ->where('status_id', '!=', 4)
            ->get();
        return view('reservations.checkin')->with(['reservations' => $reservations]);
    }

    public function checkOut()
    {

        $reservations = Reservation::where('to_date', Carbon::now()->format('Y-m-d'))
            ->where('status_id', 2)
            ->where('status_id', '!=', 4)
            ->get();

        return view('reservations.checkout')->with(['reservations' => $reservations]);
    }

    public function setCheckIn($reservationId)
    {
        /*
         * Busco la habitación a la cual hay que cambiar el estado a checkIn
         */
        $reservation = Reservation::findOrFail($reservationId);

        $fromDate = Carbon::parse($reservation->from_date);

        if (Carbon::now()->gte($fromDate)) {

            $reservedRooms = $reservation->reservedRooms;

            /*
             * Busco el registro de servicio "ocupada"
             */
            $occupatedStatus = StateOfService::where('description', 'like', 'Ocupad%')->get();

            $occupatedStatus = $occupatedStatus[0];

            /*
             * Busco el registro de estado de limpieza "Sucia"
             */
            $cleaningStatus = CleaningStatus::where('description', 'like', 'Suci%')->get();

            $cleaningStatus = $cleaningStatus[0];


            /*
             * Pongo el estado ocupada en cada habitación que posea la reserva
             */
            foreach ($reservedRooms as $reservedRoom) {

                Room::where('id', $reservedRoom->room_id)->update([
                    'status' => $occupatedStatus->id,
                    'cleaning_status' => $cleaningStatus->id
                ]);
            }

            /*
             * Pongo el estado de la reserva en CheckIn
             */
            Reservation::where('id', $reservationId)->update([
                'status_id' => 2
            ]);

            /*Creo la cuenta corriente para la reserva*/
            ReservationService::openBillingAccount($reservationId);

            return \Response::json("Ok", 200);
        }

        return \Response::json(array("Error" => "La reserva seleccionada no está en fecha de CheckIn."), 400);
    }



    public function setCheckOut($reservationId)
    {
        /*
         * Busco la habitación a la cual hay que cambiar el estado a checkOut
         */
        $reservation = Reservation::findOrFail($reservationId);

        $reservedRooms = $reservation->reservedRooms;

        /*
         * Busco el registro de servicio "Disponible"
         */
        $occupatedStatus = StateOfService::where('description', 'like', 'Disponible')->get();

        $occupatedStatus = $occupatedStatus[0];

        /*
         * Busco el estado de limpieza "Sucia"
         */
        $cleaningStatus = CleaningStatus::where('description', 'like', 'Sucia')->get();

        $cleaningStatus = $cleaningStatus[0];

        /*
         * Pongo el estado disponible en cada habitación que posea la reserva y le pongo el estado de limpieza "sucia"
         */
        foreach ($reservedRooms as $reservedRoom) {
            Room::where('id', $reservedRoom->room_id)->update([
                'status' => $occupatedStatus->id,
                'cleaning_status' => $cleaningStatus->id
            ]);
        }

        /*
         * Pongo el estado de la reserva en CheckOut
         */
        Reservation::where('id', $reservationId)->update([
            'status_id' => 3
        ]);

        /*Cierro la cta. corriente*/
        ReservationService::closeBillingAccount($reservationId);

        \Flash::success("Check Out Exitoso.");

        return redirect('/rooms');
    }

    public function locatedReservations()
    {
        $reservations = Reservation::where('status_id', 2)->get();

        return view('reservations.located')->with('reservations', $reservations);
    }

    public function all(Request $request)
    {
        DB::enableQueryLog();

        $reservations = Reservation::withTrashed();


        if ($request->filled('from_date')) {
            $reservations->where('from_date', '>=', Carbon::parse($request->input('from_date'))->format('Y-m-d'));
        } elseif ($request->filled('to_date')) {
            $reservations->where('to_date', '<=', Carbon::parse($request->input('to_date'))->format('Y-m-d'));
        } else {
            $reservations->whereRaw('from_date >= curdate()');
        }
        // dd($reservations->toSql());
        $reservations->get();
        return view('reservations.all')
            ->with('reservations', $reservations->get());
    }

    public function show($id)
    {
        return view('reservations.show')
            ->with('reservation', Reservation::withTrashed()->find($id));
    }

    /**
     * Accesos con AJAX al formulario de acompañantes
     */
    public function formCompanions()
    {
        return view('reservations.include.forms.companions');
    }
}
