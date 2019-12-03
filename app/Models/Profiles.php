<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Profiles
 * @package App\Models
 * @version August 20, 2018, 1:47 pm -03
 *
 * @property \Illuminate\Database\Eloquent\Collection billingAccounts
 * @property \Illuminate\Database\Eloquent\Collection billingAccountsItems
 * @property \Illuminate\Database\Eloquent\Collection creditCardWarranty
 * @property \Illuminate\Database\Eloquent\Collection customers
 * @property \App\Models\ModelHasRole modelHasRole
 * @property \Illuminate\Database\Eloquent\Collection posOpening
 * @property \Illuminate\Database\Eloquent\Collection reservationCompanion
 * @property \Illuminate\Database\Eloquent\Collection reservedRoom
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property string name
 * @property string guard_name
 */
class Profiles extends Model
{

    public $table = 'roles';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'name',
        'guard_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'guard_name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|unique:roles,name'
    ];

    public static $messages = [
        'name.required' => 'El campo "Nombre" es obligatorio.',
        'name.unique' => 'El perfil ingresado ya existe en la base de datos.',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function modelHasRole()
    {
        return $this->hasOne(\App\Models\ModelHasRole::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function permissions()
    {
        return $this->belongsToMany(\App\Models\Permission::class, 'role_has_permissions');
    }
}
