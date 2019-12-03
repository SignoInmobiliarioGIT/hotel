<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Customer::create([
            'name' => 'Paz, Ruben',
            'nationality' => 'Uruguayo',
            'document_type' => 1,
            'document_number' => '36604064',
            'phone' => '3364362286',
            'email' => 'alejandro@gmail.com.ar',
            'address' => 'Catamarca 123',
            'city' => 'CABA',
            'birthdate' => Carbon::parse('20-05-1976')->format('Y-m-d'),
            'profession' => 'desarrollador',
            'civil_status' => 'separado',
            'province' => 'Buenos Aires',
            'customer_type' => 1
        ]);
        \App\Models\Customer::create([
            'name' => 'Gomez, Ana',
            'nationality' => 'Croata',
            'document_type' => 1,
            'document_number' => '22333444',
            'phone' => '48482211',
            'email' => 'gomez@gmail.com.ar',
            'address' => 'San Martín 55',
            'city' => 'CABA',
            'birthdate' => Carbon::parse('28-05-1981')->format('Y-m-d'),
            'profession' => 'metalúrgico',
            'civil_status' => 'casada',
            'province' => 'Buenos Aires',
            'customer_type' => 1
        ]);
        \App\Models\Customer::create([
            'name' => 'López, Lisandro',
            'nationality' => 'Argentino',
            'document_type' => 1,
            'document_number' => '30888999',
            'phone' => '44556677',
            'email' => 'lisandro@gmail.com.ar',
            'address' => 'Belgrano 53',
            'city' => 'CABA',
            'birthdate' => Carbon::parse('18-06-1974')->format('Y-m-d'),
            'profession' => 'músico',
            'civil_status' => 'casado',
            'province' => 'Buenos Aires',
            'customer_type' => 1
        ]);
    }
}
