<?php

namespace App\Models;

use App\User;
use Eloquent as Model;

/**
 * Class PosMovement
 * @package App\Models
 * @version February 19, 2018, 8:53 am -03
 *
 * @property \App\Models\PosOpening posOpening
 * @property \Illuminate\Database\Eloquent\Collection posOpening
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property integer pos_opening_id
 * @property boolean type
 * @property float amount
 */
class PosMovement extends Model
{

    public $table = 'pos_movements';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'pos_opening_id',
        'type',
        'amount',
        'created_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'pos_opening_id' => 'integer',
        'type' => 'integer',
        'amount' => 'float',
        'created_by' => "string"
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public static $messages = [
        ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function pos_movement_type()
    {
        return $this->belongsTo(PosMovementType::class,'type');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * This method is being used by RoomDatatable.
     * I can't use the method pos_movement_type because there is a bug in Yajra datatables with the name of methods in relationships..
     **/
    public function movementType()
    {
        return $this->belongsTo(PosMovementType::class,'type',"id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function opened_pos()
    {
        return $this->belongsTo(PosOpening::class,'pos_opening_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(User::class,"created_by","id");
    }
}
