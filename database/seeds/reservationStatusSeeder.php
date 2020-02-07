<?php

use Illuminate\Database\Seeder;

class reservationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\reservationStatus::create([
            'description' => 'Por Salir',
            'color' => 'blue'
        ]);

        \App\Models\reservationStatus::create([
            'description' => 'Salió',
            'color' => 'orange'
        ]);

        \App\Models\reservationStatus::create([
            'description' => 'Por arribar',
            'color' => 'red'
        ]);

        \App\Models\reservationStatus::create([
            'description' => 'Arribada',
            'color' => 'green'
        ]);
        \App\Models\reservationStatus::create([
            'description' => 'Estancia',
            'color' => 'yellow'
        ]);
        \App\Models\reservationStatus::create([
            'description' => 'Por Salir / Por arribar',
            'color' => 'purple'
        ]);
        \App\Models\reservationStatus::create([
            'description' => 'Salió / Por Arribar',
            'color' => 'gray'
        ]);
        \App\Models\reservationStatus::create([
            'description' => 'Salió / Arribada',
            'color' => 'pink'
        ]);
        \App\Models\reservationStatus::create([
            'description' => 'No reservada',
            'color' => 'brown'
        ]);
    }
}
