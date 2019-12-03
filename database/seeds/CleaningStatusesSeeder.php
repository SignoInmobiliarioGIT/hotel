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
            'color' => "#0c9602"
        ]);

        \App\Models\CleaningStatus::create([
            'description' => "Sucia",
            'color' => "red"
        ]);
    }
}
