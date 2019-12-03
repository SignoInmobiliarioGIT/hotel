<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class CustomerType
 * @package App\Models
 * @version February 13, 2018, 3:13 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection Customer
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property string description
 * @property float discount
 */
class CustomerType extends Model
{

    public $table = 'customer_types';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public $fillable = [
        'description',
        'discount'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'description' => 'string',
        'discount' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        "description" => "required|min:1|max:30",
        "discount" => "numeric|min:0|max:100"
    ];

    public static $messages = [
        "description.required" => "El campo 'Nombre' es obligatorio.",
        "description.min" => "El valor del campo 'Nombre' debe contener como mínimo :min caracteres.",
        "description.max" => "El valor del campo 'Nombre' debe contener como máximo :max caracteres",
        "discount.required" => "El campo 'Descuento' es obligatorio.",
        "discount.min" => "El valor del campo 'Descuento' debe ser mayor a :min.",
        "discount.max" => "El valor del campo 'Descuento' debe ser menor a :max."
    ];

}
