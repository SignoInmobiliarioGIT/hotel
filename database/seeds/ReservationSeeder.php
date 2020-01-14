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

        $now = Carbon::now()->format('Y-m-d H:i:s');
        for ($i = 1; $i < 10; $i++) {
            $reservation = \App\Models\Reservation::create([
                'from_date' => Carbon::now()->subDays($i),
                'to_date' => Carbon::now()->addDays($i),
                'status_id' => 1,
                'customer_id' => rand(1, 3),
                'payment_option_id' => 1,
                'currency_id' => 1,
                'warranty_option_id' => 1,
                'total_to_bill' => rand(1000, 30000),
                'created_at' => $now,
                'comments' => Str::random(10),
            ]);


            \App\Models\ReservedRoom::create([
                'reservation_id' => $reservation->id,
                'room_id' => $i,
                'price' => $i * $reservation->id * 2.5,
                'created_at' => $now
            ]);

            $reservation = \App\Models\Reservation::create([
                'from_date' => Carbon::now(),
                'to_date' => Carbon::now()->addDays($i),
                'status_id' => 1,
                'customer_id' => rand(1, 3),
                'currency_id' => 1,
                'payment_option_id' => 1,
                'warranty_option_id' => 1,
                'total_to_bill' => rand(1000, 30000),
                'created_at' => Carbon::now(),
                'comments' => Str::random(10),
            ]);
            \App\Models\ReservedRoom::create([
                'reservation_id' => $reservation->id,
                'room_id' => $i + 15,
                'price' => $i * $reservation->id * 2.2,
                'created_at' => Carbon::now()
            ]);

            $reservation = \App\Models\Reservation::create([
                'from_date' => Carbon::now()->subDays($i),
                'to_date' => Carbon::now(),
                'status_id' => 2,
                'customer_id' => rand(1, 3),
                'payment_option_id' => 1,
                'currency_id' => 2,
                'warranty_option_id' => 1,
                'total_to_bill' => rand(1000, 30000),
                'created_at' => Carbon::now()->subDays($i + 1),
                'comments' => Str::random(10),
            ]);
            \App\Models\ReservedRoom::create([
                'reservation_id' => $reservation->id,
                'room_id' => $i + 30,
                'price' => $i * $reservation->id * 3.5,
                'created_at' => Carbon::now()->subDays($i + 1)
            ]);
        }
    }
}
