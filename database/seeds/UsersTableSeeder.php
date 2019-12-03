<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::create([
            "name" => "admin",
            "email" => "admin@gmail.com",
            "password" => bcrypt("admin"),
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()
        ]);

        // $user->assignRole(["Administrador"]);

        $user = \App\User::create([
            "name" => "user1",
            "email" => "user1@gmail.com",
            "password" => bcrypt("password"),
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()
        ]);

        // $user->assignRole(["Administrador"]);

        $user = \App\User::create([
            "name" => "user2",
            "email" => "user2@gmail.com",
            "password" => bcrypt("password"),
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()
        ]);

        // $user->assignRole(["Administrador"]);
    }
}
