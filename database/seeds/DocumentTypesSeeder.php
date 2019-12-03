<?php

use Illuminate\Database\Seeder;

class DocumentTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('document_types')->insert([
           'name' => 'DNI'
        ]);

        DB::table('document_types')->insert([
            'name' => 'PASAPORTE'
        ]);

        DB::table('document_types')->insert([
            'name' => 'CUIL/CUIT'
        ]);

        DB::table('document_types')->insert([
            'name' => 'LC'
        ]);

        DB::table('document_types')->insert([
            'name' => 'LE'
        ]);

        DB::table('document_types')->insert([
            'name' => 'CI'
        ]);

    }
}
