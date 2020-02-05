<?php

use Illuminate\Database\Seeder;

class CleaningStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\CleaningStatus::create([
            'description' => "Limpia",
            'color' => "green"
        ]);

        \App\Models\CleaningStatus::create([
            'description' => "Sucia",
            'color' => "red"
        ]);
        \App\Models\CleaningStatus::create([
            'description' => "A inspeccionar",
            'color' => "red"
        ]);
              \App\Models\CleaningStatus::create([
            'description' => "Rechazo de servicio",
            'color' => "red"
        ]);
    }
}
