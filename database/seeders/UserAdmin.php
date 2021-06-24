<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Administrador',
            'email' => 'admin@ecommerce.com',
            'password' => bcrypt("admin123"),
            'current_team_id' => 1
        ]);

        DB::table('team_user')->insert([
            'team_id' => '1',
            'user_id' => '1',
            'role' => 'Admin'
        ]);
    }
}
