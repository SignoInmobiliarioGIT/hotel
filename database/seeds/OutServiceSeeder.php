<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\OutService;

class OutServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OutService::insert([
            'from_date' => Carbon::now(),
            'to_date' => Carbon::now()->addDays(5),
            'room_id' => 60,
            'description' => Str::random(40),
        ]);
    }
}
