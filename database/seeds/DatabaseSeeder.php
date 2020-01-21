<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Eloquent::unguard();

        // $path = 'database/sqls/permissions.sql';
        // DB::unprepared(file_get_contents($path));
        // $this->command->info('Tablas de permisos y roles seeder');

        $this->call(DocumentTypesSeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(creditCardSeeder::class);
        // $this->call(PosMovementsSeeder::class);
        // $this->call(PermissionTableSeeder::class);
        // $this->call(RoleTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(reservationStatusSeeder::class);
        $this->call(CleaningStatusesSeeder::class);
        $this->call(RoomCategoriesSeeder::class);
        $this->call(StateOfServiceSeeder::class);
        $this->call(RoomSeeder::class);
        $this->call(PaymentOptionsSeeder::class);
        $this->call(WarrantyOptionsSeeder::class);
        $this->call(BillingAccountStatusSeeder::class);
        $this->call(CustomerCategorySeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(ReservationSeeder::class);
    }
}
