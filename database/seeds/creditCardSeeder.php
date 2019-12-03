<?php

use Illuminate\Database\Seeder;

class creditCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('credit_cards')->insert([
            'description' => 'VISA'
        ]);

        DB::table('credit_cards')->insert([
            'description' => 'MASTER CARD'
        ]);

        DB::table('credit_cards')->insert([
            'description' => 'AMERICAN EXPRESS'
        ]);
    }
}
