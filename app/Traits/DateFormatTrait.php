<?php

namespace App\Traits;

use Illuminate\Support\Carbon;


trait DateFormatTrait
{
    public function bd2App(String $date)
    {
        return Carbon::parse($date)->isoFormat('DD-MM-YYYY');
    }

    public function app2Db(String $date)
    {
        return Carbon::create($date)->toDateString();
    }
}
