<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OutService extends Model
{
    public $table = 'outservices';

    public $fillable = [
        'from_date',
        'to_date',
        'room_id',
        'description'
    ];

    protected $dates = [
    	'from_date', 
    	'to_date',
    	'created_at',
    	'updated_at'
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
