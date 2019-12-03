<?php

namespace App\Models;

use App\User;
use Eloquent as Model;

/**
 * Class PosOpening
 * @package App\Models
 * @version February 16, 2018, 12:38 pm UTC
 *
 * @property \App\Models\Pos
 * @property \Illuminate\Database\Eloquent\Collection PosMovement
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property integer pos_id
 * @property float initial_change
 * @property string|\Carbon\Carbon opening_timestamp
 * @property string|\Carbon\Carbon closing_timestamp
 * @property boolean status
 */
class PosOpening extends Model
{

    public $table = 'pos_opening';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'pos_id',
        'initial_change',
        'status',
        'comments',
        'opening_datetime',
        'closing_datetime',
        'opened_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'pos_id' => 'integer',
        'initial_change' => 'integer',
        'status' => 'boolean',
        'comments' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        "pos_id" => "required|exists:pos,id",
        "initial_change" => "numeric|min:0"
    ];

    public static $messages = [
        "pos_id.required" => "El campo 'Caja' es obligatorio",
        "pos_id.exists" => "El valor del campo 'Caja' no es válido.",
        "initial_change.required" => "El campo 'Monto Inicial' es obligatorio",
        "initial_change.min" => "El valor del campo 'Monto Inicial' debe ser mayor a $ :min"
        ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function pos()
    {
        return $this->belongsTo(Pos::class,"pos_id",'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(User::class,"opened_by","id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function movements()
    {
        return $this->hasMany(PosMovement::class,"pos_opening_id");
    }


}
