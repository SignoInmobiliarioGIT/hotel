<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class Reservation extends Model
{
    use SoftDeletes;

    public $timestamps = true;

    protected $dates = ['from_date', 'to_date'];
    protected $dateFormat = 'Y-m-d';

    public $table = 'reservation';

    public $fillable = ['from_date', 'to_date', 'status_id', 'customer_id', 'partner_id', 'payment_option_id', 'warranty_option_id', 'total_to_bill', 'currency_id', 'comments', 'adults', 'children'];

    public static $rules = [
        'fromDate' => 'required|date|after_or_equal:today',
        'toDate' => 'required|date|after_or_equal:fromDate',
        'customer' => 'required|array',
        'rooms' => 'required|array',
        'isPartner' => 'required|boolean',
        //'paymentOption' => 'required',
        //'warranty' => 'required',
        'creditCardId' => 'required_if:warranty,6',
        'creditCardNumber' => 'required_if:warranty,6',
        'creditCardExpirationDate' => 'required_if:warranty,6',
        //'total_to_bill' => 'numeric'
    ];

    public static $messages = [
        'fromDate.required' => 'El campo "Fecha de Entrada" es obligatorio.',
        'fromDate.date' => 'El campo "Fecha de Entrada" debe ser una fecha válida.',
        'fromDate.after_or_equal' => 'El campo "Fecha de Entrada" debe ser una fecha igual o mayor al día de hoy.',
        'toDate.required' => 'Debe ingresar la fecha de salida de la reserva.',
        'toDate.date' => 'El campo "Fecha de Salida" debe ser una fecha válida.',
        'toDate.after_or_equal' => 'El campo "Fecha de Salida" debe ser mayor o igual a la fecha de entrada.',
        'customer.required' => 'Debe seleccionar un cliente.',
        'customer.array' => 'El cliente seleccionado es inválido.',
        'rooms.required' => 'Debe seleccionar AL MENOS una habitación.',
        'rooms.array' => 'La habitación seleccionada no es válida.',
        'isPartner.required' => 'Debe indicar si el cliente es afiliado o particular.',
        'isPartner.boolean' => 'Debe indicar si el cliente es afiliado o particular.',
        //'paymentOption.required' => 'Debe ingresar el método de pago',
        //'warranty.required' => 'Debe ingresar el tipo de garantía',
        'creditCardId.required_if' => 'Debe seleccionar una tarjeta de crédito',
        'creditCardNumber.required_if' => 'Debe ingresar el número de la tarjeta de crédito',
        'creditCardExpirationDate.required_if' => 'Debe ingresar la fecha de vencimiento de la tarjeta de crédito',
        'creditCardSecurityNumber.required_if' => 'Debe ingresar el código de seguridad de la tarjeta de crédito',
        'id.required' => 'Error al actualizar la reserva',
        //'total_to_bill.numeric' => 'El campo "Total de la Reserva" es requerido y debe ser un número.'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function status()
    {
        return $this->belongsTo(reservationStatus::class, 'status_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function partner()
    {
        return $this->belongsTo(Partners::class, 'partner_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function reservedRooms()
    {
        return $this->hasMany(ReservedRoom::class, 'reservation_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function companion()
    {
        return $this->hasMany(ReservationCompanion::class, 'reservation_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function paymentOption()
    {
        return $this->belongsTo(PaymentOption::class);
    }
    public function warrantyOption()
    {
        return $this->belongsTo(WarrantyOption::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function creditCardWarranty()
    {
        return $this->hasOne(CcReservationWarranty::class);
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'reserved_room');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    static function betweenDates($from, $to)
    {
        return Reservation::whereBetween('from_date', [$from, $to])->orWhereBetween('to_date', [$from, $to])
            ->with(['reservedRooms', 'rooms', 'customer'])
            ->get();
    }

    /**
     * Metodo para el scheduler
     *
     * Selecciona y renombra los campos para el scheduler
     *
     * @return array
     */
    static function toScheduler()
    {
        return DB::table('reservation')
            ->select(DB::raw('reservation.id as text, from_date as start_date, to_date as end_date, reserved_room.room_id as room_id, status_id as status_id, payment_option_id as payment_option_id, customers.id as customer_id, customers.name as customer_name, reserved_room.room_id as room_id, reserved_room.price as night_price, reservation.id as reservation_id, total_to_bill, currency_id,  warranty_option_id AS warranty_id, adults, children, comments'))
            ->leftJoin('reserved_room', 'reserved_room.reservation_id', '=', 'reservation.id')
            ->leftJoin('customers', 'customers.id', '=', 'reservation.customer_id')
            ->get()->toArray();
    }

    public function setFromDateAttribute($value)
    {
        $this->attributes['from_date'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }
    public function setToDateAttribute($value)
    {
        $this->attributes['to_date'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }

    public function getFromDateAttribute($value)
    {
        return (new Carbon($value))->format('d-m-Y');
    }
    public function getToDateAttribute($value)
    {
        return (new Carbon($value))->format('d-m-Y');
    }
}
