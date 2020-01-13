<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Currency extends Model
{
    static function toScheduler()
    {
        return DB::table('currencies')
            ->select(DB::raw('id as value, description as label, sign'))
            ->orderBy('description', 'desc')
            ->get()
            ->toArray();
    }
}
