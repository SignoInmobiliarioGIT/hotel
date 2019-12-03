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
            'description' => 'Nueva Reserva',
            'color' => '#51D904'
        ]);

        \App\Models\reservationStatus::create([
            'description' => 'Check In',
            'color' => '#0098E8'
        ]);

        \App\Models\reservationStatus::create([
            'description' => 'Check Out',
            'color' => '#FFF40D'
        ]);

        \App\Models\reservationStatus::create([
            'description' => 'Cancelada',
            'color' => '#0098E8'
        ]);
    }
}
