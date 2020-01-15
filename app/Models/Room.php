<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

use Eloquent as Model;

/**
 * Class Room
 * @package App\Models
 * @version February 12, 2018, 9:43 pm UTC
 *
 * @property \App\Models\CleaningStatus cleaningStatus
 * @property \App\Models\RoomCategory roomCategory
 * @property \App\Models\StateOfService stateOfService
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property string name
 * @property string floor
 * @property string description
 * @property integer status
 * @property integer cleaning_status
 * @property integer room_category
 */
class Room extends Model
{

    public $table = 'rooms';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'name',
        'floor',
        'description',
        'status',
        'cleaning_status',
        'room_category',
        'baby_crib', 'sofa', 'extra_bed'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'floor' => 'string',
        'description' => 'string',
        'status' => 'integer',
        'cleaning_status' => 'integer',
        'room_category' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        "name" => "required|min:1",
        "floor" => "required|min:1",
        "status" => "required|exists:state_of_service,id",
        "cleaning_status" => "required|exists:cleaning_statuses,id",
        "room_category" => "required|exists:room_categories,id"
    ];

    public static $messages = [
        "name.required" => "El campo 'Nombre' es obligatorio",
        "name.min" => "El valor del campo 'Nombre' debe contener como mínimo :min caracteres",
        "floor.required" => "El campo 'Piso' es obligatorio",
        "floor.min" => "El valor del campo 'Piso' debe contener como mínimo :min caracteres",
        "status.required" => "El campo 'Estado de Servicio' es obligatorio",
        "status.exists" => "El valor del campo 'Estado de Servicio' no es válido",
        "cleaning_status.required" => "El campo 'Estado de Limpieza' es obligatorio",
        "cleaning_status.exists" => "El valor del campo 'Estado de Limpieza' no es válido",
        "room_category.required" => "El campo 'Tipo de Habitación' es obligatorio",
        "room_category.exists" => "El valor del campo 'Tipo de Habitación' no es válido"
    ];

    public function stateOfService()
    {
        return $this->belongsTo('App\Models\StateOfService', 'status');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function cleaningStatus()
    {
        return $this->belongsTo(\App\Models\CleaningStatus::class, "cleaning_status");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * This method is being used by RoomDatatable.
     * I can't use the method cleaningStatus because there is a bug in Yajra datatables with the name of methods in relationships..
     **/
    public function cleaning_status()
    {
        return $this->belongsTo(\App\Models\CleaningStatus::class, "cleaning_status");
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * This method is being used by RoomDatatable.
     * I can't use the method cleaningStatus because there is a bug in Yajra datatables with the name of methods in relationships..
     **/
    public function roomCategory()
    {
        return $this->belongsTo(\App\Models\RoomCategory::class, "room_category");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function status()
    {
        return $this->belongsTo(\App\Models\StateOfService::class, "status");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function roomStatus()
    {
        return $this->belongsTo(\App\Models\StateOfService::class, "status");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function reservation()
    {
        return $this->belongsToMany(\App\Models\Reservation::class, 'reserved_room');
    }

    public function updateStatesOfDay()
    {
        $query = "update rooms
            set cleaning_status = 6
            where status in (2, 4)
            and cleaning_status != 4";

        return DB::insert($query);
    }

    static function availableFromCategoryBetweenDates($room_category_id, $from_date, $to_date)
    {
        $from = date("Y-m-d", strtotime($from_date));
        $to   = date("Y-m-d", strtotime($to_date));

        return  Room::selectRaw('distinct rooms.*')
            ->leftJoin('hoteluom.reserved_room', 'rooms.id', 'reserved_room.room_id')
            ->leftJoin('hoteluom.reservation', 'reservation.id', 'reserved_room.reservation_id')
            ->where('room_category', $room_category_id)
            ->whereNotIn('rooms.id', Room::selectRaw('rooms.id')
                ->leftJoin('hoteluom.reserved_room', 'rooms.id', 'reserved_room.room_id')
                ->leftJoin('hoteluom.reservation', 'reservation.id', 'reserved_room.reservation_id')
                ->where('room_category', $room_category_id)
                ->WhereBetween('from_date', [$from, $to])
                ->orWhereBetween('to_date', [$from, $to]))
            ->get();
    }
    static function toScheduler()
    {
        return Room::select(DB::raw('rooms.id as value, rooms.name as label,rooms.status, room_category as type, status, room_categories.price, room_categories.max_capacity'))
            ->leftJoin('room_categories', 'room_categories.id', '=', 'rooms.room_category')
            ->get()
            ->toArray();
    }
}
