<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

use Eloquent as Model;

/**
 * Class CleaningStatus
 * @package App\Models
 * @version February 12, 2018, 8:50 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property string description
 * @property string background_color
 */
class CleaningStatus extends Model
{

    public $table = 'cleaning_statuses';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'description',
        'color'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'description' => 'string',
        'color' => 'string'
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
        "decription.required" => "El campo 'Descripción' es obligatorio",
        "description.min" => "El valor del campo 'Descripción' debe contener al menos :min caracteres"
    ];

    static function toScheduler()
    {
        return CleaningStatus::select(DB::raw('id as value, description as label'))
            ->get()
            ->toArray();
    }
}
