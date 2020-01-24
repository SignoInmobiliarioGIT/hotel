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
            'color' => '#51D904'
        ]);

        \App\Models\reservationStatus::create([
            'description' => 'Salió',
            'color' => '#0098E8'
        ]);

        \App\Models\reservationStatus::create([
            'description' => 'Por arribar',
            'color' => '#FFF40D'
        ]);

        \App\Models\reservationStatus::create([
            'description' => 'Arrivada',
            'color' => '#0098E8'
        ]);
        \App\Models\reservationStatus::create([
            'description' => 'Ocupada',
            'color' => '#0098E8'
        ]);
        \App\Models\reservationStatus::create([
            'description' => 'Por Salir / Por arribar',
            'color' => '#0098E8'
        ]);
        \App\Models\reservationStatus::create([
            'description' => 'Salió / Por Arribar',
            'color' => '#0098E8'
        ]);
        \App\Models\reservationStatus::create([
            'description' => 'Salió / Arribado',
            'color' => '#0098E8'
        ]);
    }
}
