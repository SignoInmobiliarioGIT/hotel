<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class creditCards extends Model
{
    public $timestamps = false;

    public $table = "credit_cards";

    public function warrantiesAssigned()
    {
        return $this->hasOne(ReservationCCWarrantyConnection::class,'credit_card_id');
    }
}
