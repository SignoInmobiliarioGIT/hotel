<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaleSubGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sale_sub_groups')->insert([
            'name' => 'Alojamiento',
            'sale_group_id' => 1,
        ], [
            'name' => 'Frigobar',
            'sale_group_id' => 1,
        ], [
            'name' => 'Almuerzo',
            'sale_group_id' => 2,
        ], [
            'name' => 'Cafetería',
            'sale_group_id' => 2,
        ], [
            'name' => 'Cena',
            'sale_group_id' => 2,
        ], [
            'name' => 'Servicio de habitación',
            'sale_group_id' => 2,
        ], [
            'name' => 'Varios',
            'sale_group_id' => 3,
        ]);
    }
}
