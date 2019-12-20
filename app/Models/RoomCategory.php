<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

use Eloquent as Model;

/**
 * Class RoomCategory
 * @package App\Models
 * @version February 12, 2018, 8:30 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property string name
 * @property string description
 * @property integer max_capacity
 */
class RoomCategory extends Model
{

    public $table = 'room_categories';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'name',
        'description',
        'max_capacity',
        'price'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'max_capacity' => 'integer',
        'price' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        "name" => "required|min:1",
        "max_capacity" => "numeric|min:1",
        "price" => "required|min:1"
    ];

    public static $messages = [
        "name.required" => "El campo 'Nombre' es obligatorio",
        "name.min" => "El valor del campo 'Nombre' debe contener como mínimo :min caracteres",
        "max_capacity.numeric" => "El campo 'Capacidad Máxima' es obligatorio y debe ser un número entero",
        "max_capacity.min" => "El valor del campo 'Capacidad Máxima' debe ser mayor a :min",
        "price.required" => "El campo 'Precio' es obligatorio",
        "price.min" => "El valor del campo 'Precio' debe ser mayor a :min"
    ];

    static function toScheduler()
    {
        return RoomCategory::select(DB::raw('id as value, name as label'))
            ->get()
            ->toArray();
    }
}
