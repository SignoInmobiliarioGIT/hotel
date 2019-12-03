<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillingAccountItems extends Model
{
    public $table = 'billing_account_items';

    public $fillable =
        [
        'billing_account_id',
        'room_id',
        'date',
        'debe',
        'haber'
    ];
}
