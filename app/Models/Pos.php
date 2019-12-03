<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Pos
 * @package App\Models
 * @version February 15, 2018, 12:02 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection PosOpening
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property string name
 * @property string description
 */
class Pos extends Model
{

    public $table = 'pos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'name',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        "name" => "required"
    ];

    public static $messages = [
        "name.required" => "El campo 'Nombre' es obligatorio."
        ];

}
