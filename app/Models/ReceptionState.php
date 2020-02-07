<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class StateOfService
 * @package App\Models
 * @version February 12, 2018, 9:22 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property string description
 */
class ReceptionState extends Model
{

    public $table = 'state_of_service';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        "description" => "required|min:1"
    ];

    public static $messages = [
        "decription.required" => "El campo 'Descripci?n' es obligatorio",
        "description.min" => "El valor del campo 'Descripci?n' debe contener al menos :min caracteres"
    ];

    /**
     * @return mixed
     */
    public function room()
    {
        return $this->hasMany(Room::class, 'status');
    }
}
