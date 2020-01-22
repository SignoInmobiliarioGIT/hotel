<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Reservation;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $users = factory(Reservation::class, 1000)->create();

        $insertReservation = [];
        $insertReservedRoom = [];
        for ($room = 1; $room < 50; $room++) {
            for ($i = 0; $i < 100; $i++) {
                $reservation = \App\Models\Reservation::create([
                    'from_date' => Carbon::now()->subDays($i)->format('d-m-Y'),
                    'to_date' => Carbon::now()->subDays($i)->format('d-m-Y'),
                    'status_id' => 1,
                    'customer_id' => rand(1, 3),
                    'payment_option_id' => 1,
                    'currency_id' => 1,
                    'warranty_option_id' => 1,
                    'total_to_bill' => rand(1000, 30000),
                    'created_at' => Carbon::now(),
                    'comments' => Str::random(10),
                    'adults' => 2,
                    'children' => 1
                ]);


                \App\Models\ReservedRoom::create([
                    'reservation_id' => $reservation->id,
                    'room_id' => $room,
                    'price' => $i,
                    'created_at' => Carbon::now()
                ]);
            }
        }
    }
}
