<?php

use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 70; $i++) {
            \App\Models\Room::create([
                'name' => $i * 8,
                'floor' => "Piso " . $i,
                'description' => "La descripción",
                'status' => 1,
                'cleaning_status' => 1,
                'room_category' => 1
            ]);
        }
    }
}
