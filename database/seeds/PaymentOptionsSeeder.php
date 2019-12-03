<?php

use Illuminate\Database\Seeder;

class PaymentOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_options')->insert([
            'description' => 'PAGO EN DESTINO'
        ]);

        DB::table('payment_options')->insert([
            'description' => 'TRANSFERENCIA BANCARIA.'
        ]);

        DB::table('payment_options')->insert([
            'description' => 'OBRA SOCIAL'
        ]);

        DB::table('payment_options')->insert([
            'description' => 'SECCIONAL'
        ]);

        DB::table('payment_options')->insert([
            'description' => 'CTA. CORRIENTE'
        ]);
    }
}
