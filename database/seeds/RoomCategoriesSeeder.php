<?php

use Illuminate\Database\Seeder;

class RoomCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\RoomCategory::create([
            'name' => "Suite",
            'description' => "Habitación Suite",
            'max_capacity' => 2,
            'price' => 5000
        ]);

        \App\Models\RoomCategory::create([
            'name' => "Doble",
            'description' => "Habitación doble",
            'max_capacity' => 2,
            'price' => 2222
        ]);

        \App\Models\RoomCategory::create([
            'name' => "Simple",
            'description' => "Habitación simple",
            'max_capacity' => 1,
            'price' => 1111
        ]);
        \App\Models\RoomCategory::create([
            'name' => "Triple",
            'description' => "Habitación triple",
            'max_capacity' => 3,
            'price' => 3333
        ]);
    }
}
