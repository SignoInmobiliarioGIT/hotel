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
        for ($i = 1; $i < 20; $i++) {
            for ($category = 1; $category < 5; $category++) {
                \App\Models\Room::create([
                    'name' => $i . $category,
                    'floor' => "Piso " . $category,
                    'description' => "La descripción",
                    'status' => 1,
                    'cleaning_status' => 1,
                    'room_category' => $category
                ]);
            }
        }
    }
}
