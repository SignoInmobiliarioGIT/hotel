<?php

use Illuminate\Database\Seeder;

class StateOfServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\StateOfService::create([
            'description' => "Disponible"
        ]);

        \App\Models\StateOfService::create([
            'description' => "Ocupada"
        ]);
    }
}
