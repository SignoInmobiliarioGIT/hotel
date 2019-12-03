<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Customer
 * @package App\Models
 * @version February 13, 2018, 3:31 pm UTC
 *
 * @property \App\Models\CustomerType customerType
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property string name
 * @property string nationality
 * @property string document_type
 * @property string document_number
 * @property string phone
 * @property string email
 * @property string address
 * @property string city
 * @property string province
 * @property integer customer_type
 */
class Customer extends Model
{

    public $table = 'customers';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'name',
        'nationality',

        'document_type',
        'document_number',
        'phone',
        'email',
        'address',
        'city',
        'province',
        'profession',
        'civil_status',
        'customer_type',
        'birthdate'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'nationality' => 'string',
        'document_type' => 'string',
        'document_number' => 'string',
        'phone' => 'string',
        'email' => 'string',
        'address' => 'string',
        'city' => 'string',
        'province' => 'string',
        'civil_status' => 'string',
        'profession' => 'string',
        'customer_type' => 'integer',
        'birthdate' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        "name" => "required",
        "document_type" => "required",
        "document_number" => "numeric|unique:customers,document_number",
        "customer_type" => "required|exists:customer_types,id",
        "birthdate" => "date"
    ];

    public static $messages = [
        "name.required" => "El campo 'Apellido y Nombre' es obligatorio.",
        "document_type.required" => "El campo 'Tipo de Documento' es obligatorio.",
        "document_number.numeric" => "El valor del campo 'Número de Documento' debe ser numérico.",
        "document_number.unique" => "El documento ingresado corresponde a una persona que ya existe en la base de datos.",
        "phone.required" => "El campo 'Teléfono' es obligatorio.",
        "customer_type.required" => "El campo 'Categoría de Cliente' es obligatorio.",
        "customer_type.exists" => "El valor del campo 'Categoría de Cliente' no es válido.",
        "birthdate.date" => "La Fecha de nacimiento no es una fecha válida."
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/

    public function customer_type()
    {
        return $this->belongsTo(\App\Models\CustomerType::class, "customer_type");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * This method is being used by CustomersDatatable.
     * I can't use the method customer_type because there is a bug in Yajra datatables with the name of methods in relationships..
     **/
    public function customerType()
    {
        return $this->belongsTo(\App\Models\CustomerType::class, "customer_type");
    }
    public function documentType()
    {
        return $this->belongsTo(\App\Models\DocumentType::class, "document_type");
    }
}
