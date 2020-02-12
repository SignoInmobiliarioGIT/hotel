<?php

use Illuminate\Database\Seeder;
use App\Models\ReceptionState;

class StateOfServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReceptionState::create([
            'description' => "Disponible"
        ]);

        ReceptionState::create([
            'description' => "Ocupada"
        ]);
    }
}
