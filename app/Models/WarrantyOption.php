<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarrantyOption extends Model
{
    public $timestamps = false;

    public $table = 'warranty_options';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function reservations()
    {
        return $this->hasMany(Reservation::class,'warranty_option_id');
    }
}
