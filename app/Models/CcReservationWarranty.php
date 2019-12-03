<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CcReservationWarranty extends Model
{

    public $table = "credit_card_warranty";

    public $fillable = ['reservation_id','credit_card_id', 'cc_number', 'cc_expiration_date'];

    public function creditCardType()
    {
        return $this->belongsTo(creditCards::class,'credit_card_id');
    }

}
