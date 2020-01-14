<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WarrantyOption extends Model
{
    public $timestamps = false;

    public $table = 'warranty_options';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'warranty_option_id');
    }
    static function toScheduler()
    {
        return WarrantyOption::select(DB::raw('id as value, description as label'))
            ->get()
            ->toArray();
    }
}
