<?php

use Illuminate\Database\Seeder;

class BillingAccountStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('billing_account_status')->insert([
            'description' => 'ABIERTA'
        ]);

        DB::table('billing_account_status')->insert([
            'description' => 'CERRADA'
        ]);
    }
}
