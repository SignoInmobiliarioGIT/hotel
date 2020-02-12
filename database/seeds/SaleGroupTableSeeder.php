<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaleGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sale_groups')->insert([
            'name' => 'Recepción'
        ], [
            'name' => 'AABB'
        ], [
            'name' => 'Miscelánea'
        ]);
    }
}
