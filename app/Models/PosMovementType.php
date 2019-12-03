<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PosMovementType extends Model
{
    public $table = 'pos_movements_types';

    public $fillable = ['description'];
}
