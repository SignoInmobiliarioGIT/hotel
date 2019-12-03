<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();
        DB::table('permissions')->truncate();
        Schema::enableForeignKeyConstraints();

        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        /*
         * Permisos para ABM usuarios del sistema
         */
        Permission::create(["name" => "user.view", "guard_name" => "web"]);
        Permission::create(["name" => "user.create", "guard_name" => "web"]);
        Permission::create(["name" => "user.edit", "guard_name" => "web"]);
        Permission::create(["name" => "user.delete", "guard_name" => "web"]);
        /*
         * Permisos para ABM de tipos de habitaciones
         */
        Permission::create(["name" => "room_category.view", "guard_name" => "web"]);
        Permission::create(["name" => "room_category.create", "guard_name" => "web"]);
        Permission::create(["name" => "room_category.edit", "guard_name" => "web"]);
        Permission::create(["name" => "room_category.delete", "guard_name" => "web"]);
        /*
         * Permisos para ABM de estados de limpieza
         */
        Permission::create(["name" => "cleaning_status.view", "guard_name" => "web"]);
        Permission::create(["name" => "cleaning_status.create", "guard_name" => "web"]);
        Permission::create(["name" => "cleaning_status.edit", "guard_name" => "web"]);
        Permission::create(["name" => "cleaning_status.delete", "guard_name" => "web"]);
        /*
         * Permisos para ABM de estados de servicio (sos = state of service)
         */
        Permission::create(["name" => "sos.view", "guard_name" => "web"]);
        Permission::create(["name" => "sos.create", "guard_name" => "web"]);
        Permission::create(["name" => "sos.edit", "guard_name" => "web"]);
        Permission::create(["name" => "sos.delete", "guard_name" => "web"]);
        /*
         * Permisos para ABM de habitaciones
         */
        Permission::create(["name" => "room.view", "guard_name" => "web"]);
        Permission::create(["name" => "room.create", "guard_name" => "web"]);
        Permission::create(["name" => "room.edit", "guard_name" => "web"]);
        Permission::create(["name" => "room.delete", "guard_name" => "web"]);
        /*
         * Permisos para ABM de tipos de clientes
         */
        Permission::create(["name" => "customer_type.view", "guard_name" => "web"]);
        Permission::create(["name" => "customer_type.create", "guard_name" => "web"]);
        Permission::create(["name" => "customer_type.edit", "guard_name" => "web"]);
        Permission::create(["name" => "customer_type.delete", "guard_name" => "web"]);
        /*
         * Permisos para ABM de clientes
         */
        Permission::create(["name" => "customer.view", "guard_name" => "web"]);
        Permission::create(["name" => "customer.create", "guard_name" => "web"]);
        Permission::create(["name" => "customer.edit", "guard_name" => "web"]);
        Permission::create(["name" => "customer.delete", "guard_name" => "web"]);
        /*
         * Permisos para ABM de POS
         */
        Permission::create(["name" => "pos.view", "guard_name" => "web"]);
        Permission::create(["name" => "pos.create", "guard_name" => "web"]);
        Permission::create(["name" => "pos.edit", "guard_name" => "web"]);
        Permission::create(["name" => "pos.delete", "guard_name" => "web"]);
        /*
         * Permisos para ABM de POS_OPENING
         */
        Permission::create(["name" => "pos_opening.view", "guard_name" => "web"]);
        Permission::create(["name" => "pos_opening.create", "guard_name" => "web"]);
        Permission::create(["name" => "pos_opening.edit", "guard_name" => "web"]);
        Permission::create(["name" => "pos_opening.delete", "guard_name" => "web"]);
        /*
         * Permisos para ABM de POS_MOVEMENTS
         */
        Permission::create(["name" => "pos_movement.view", "guard_name" => "web"]);
        Permission::create(["name" => "pos_movement.create", "guard_name" => "web"]);
        Permission::create(["name" => "pos_movement.edit", "guard_name" => "web"]);
        /*
         * Permisos para ABM de RESERVATIONS
         */
        Permission::create(["name" => "reservations.view", "guard_name" => "web"]);
        Permission::create(["name" => "reservations.create", "guard_name" => "web"]);
        Permission::create(["name" => "reservations.edit", "guard_name" => "web"]);
        Permission::create(["name" => "reservations.delete", "guard_name" => "web"]);

        /*
         * Permisos para ABM de BillingAccounts
         */
        Permission::create(["name" => "billingAccounts.view", "guard_name" => "web"]);
        Permission::create(["name" => "billingAccounts.create", "guard_name" => "web"]);
        Permission::create(["name" => "billingAccounts.edit", "guard_name" => "web"]);
        Permission::create(["name" => "billingAccounts.delete", "guard_name" => "web"]);

        /*
         * Permisos para ABM de BillingAccounts
         */
        Permission::create(["name" => "profiles.view", "guard_name" => "web"]);
        Permission::create(["name" => "profiles.create", "guard_name" => "web"]);
        Permission::create(["name" => "profiles.edit", "guard_name" => "web"]);
        Permission::create(["name" => "profiles.delete", "guard_name" => "web"]);

        $role = \Spatie\Permission\Models\Role::find(1);
        //$role->syncPermissions(\Spatie\Permission\Models\Permission::all());

    }
}
