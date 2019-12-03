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
            'description' => "Descripción  de categoría de habitación",
            'max_capacity' => 4,
            'price' => 5000
        ]);

        \App\Models\RoomCategory::create([
            'name' => "Doble",
            'description' => "Descripción  de categoría de habitación",
            'max_capacity' => 2,
            'price' => 1500
        ]);
    }
}
