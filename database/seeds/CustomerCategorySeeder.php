<?php

use Illuminate\Database\Seeder;

class CustomerCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customer_types')->insert([
           'description' => 'PARTICULAR',
           'discount' => 0
        ]);
    }
}
