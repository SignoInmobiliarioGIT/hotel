<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partners extends Model
{
    public $table = 'partners';

    public $fillable = ['id_seccional', 'seccional', 'nombre_seccional', 'dni', 'afiliado'];
}
