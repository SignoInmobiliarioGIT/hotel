<?php

use Illuminate\Database\Seeder;

class WarrantyOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('warranty_options')->insert([
            'description' => 'TRANSFERENCIA'
        ]);

        DB::table('warranty_options')->insert([
            'description' => 'OBRA SOCIAL'
        ]);

        DB::table('warranty_options')->insert([
            'description' => 'SECCIONAL'
        ]);

        DB::table('warranty_options')->insert([
            'description' => 'CTA. CORRIENTE'
        ]);

        DB::table('warranty_options')->insert([
            'description' => 'NO GARANTIZADA'
        ]);

        DB::table('warranty_options')->insert([
            'description' => 'TARJ. DE CRÉDITO'
        ]);
    }
}
