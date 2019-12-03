<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillingAccount extends Model
{
    public $table = 'billing_accounts';

    public $fillable =
        [
            'reservation_id',
            'billing_account_status_id'
        ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class,'reservation_id');
    }
}
