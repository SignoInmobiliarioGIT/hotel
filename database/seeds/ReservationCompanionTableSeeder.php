<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationCompanionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservation_companion')->insert([
            'reservation_id' => 1,
            'dni' => '11523698',
            'name' => 'Ale',
            'age' => 50,
            'relationship' => 'padre',
            'assigned_room_id' => 1,
        ]);
        DB::table('reservation_companion')->insert([
            'reservation_id' => 1,
            'dni' => '987456321',
            'name' => 'Juan',
            'age' => 6,
            'relationship' => 'hijo',
            'assigned_room_id' => 1,
        ]);
        DB::table('reservation_companion')->insert([
            'reservation_id' => 2,
            'dni' => '987456321',
            'name' => 'Ana',
            'age' => 65,
            'relationship' => 'madre',
            'assigned_room_id' => 2,
        ]);
    }
}
