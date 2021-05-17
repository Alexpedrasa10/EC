<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Teams extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->insert([
            'user_id' => '1',
            'name' => 'Administracion',
            'personal_team' => '0'
        ]);

        DB::table('teams')->insert([
            'user_id' => '1',
            'name' => 'Cliente',
            'personal_team' => '0'
        ]);
    }
}
