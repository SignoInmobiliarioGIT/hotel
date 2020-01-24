<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        $dayFromInit = -5;
        $dayToInit = 5;
        for ($room = 1; $room < 20; $room++) {
            if ($room % 2 == 0) {
                $now = Carbon::now();
                $dayFromInit = -10 + $room;
                $dayToInit = 1 + $room;
            }
            // $dayToInit++;

            for ($i = 0; $i < 2; $i++) {
                if ($i > 0) {
                    $dayFromInit = 1;
                }
                $reservation = \App\Models\Reservation::create([
                    'from_date' => $now->addDays($dayFromInit)->format('d-m-Y'),
                    'to_date' => $now->addDays($dayToInit)->format('d-m-Y'),
                    'status_id' => 1,
                    'customer_id' => rand(1, 3),
                    'payment_option_id' => 1,
                    'currency_id' => 1,
                    'warranty_option_id' => 1,
                    'total_to_bill' => rand(1000, 30000),
                    'created_at' => $now,
                    'comments' => Str::random(100),
                    'adults' => 2,
                    'children' => 1
                ]);


                \App\Models\ReservedRoom::create([
                    'reservation_id' => $reservation->id,
                    'room_id' => $room,
                    'price' => $i,
                    'created_at' => Carbon::now()
                ]);

                $reservation = \App\Models\Reservation::create([
                    'from_date' => $now->addDays(2)->format('d-m-Y'),
                    'to_date' => $now->addDays(3)->format('d-m-Y'),
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

                $reservation = \App\Models\Reservation::create([
                    'from_date' => $now->addDays(2)->format('d-m-Y'),
                    'to_date' => $now->addDays(2)->format('d-m-Y'),
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
