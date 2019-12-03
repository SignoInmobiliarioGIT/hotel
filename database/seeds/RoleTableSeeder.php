<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(["name" => "Administrador", "guard_name" => "web"]);
        $role->syncPermissions(\Spatie\Permission\Models\Permission::all());
    }
}
