<?php

use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert([
            'sign' => '$',
            'description' => 'pesos'
        ]);
        DB::table('currencies')->insert([
            'sign' => 'U$S',
            'description' => 'dólares'
        ]);
    }
}
