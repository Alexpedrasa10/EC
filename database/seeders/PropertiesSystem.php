<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use stdClass;

class PropertiesSystem extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('properties')->insert([
            'category' => 'PMET',
            'code' => 'MLA',
            'name' => 'Mercadopago',
        ]);

        DB::table('properties')->insert([
            'category' => 'OSTA',
            'code' => 'PROC',
            'name' => 'Procesando',
        ]);

        DB::table('properties')->insert([
            'category' => 'OSTA',
            'code' => 'SUCC',
            'name' => 'Pago con éxito',
        ]);

        $propFB = new Stdclass();
        $propFB->class = "my-3 inline-block transition ease-in duration-200 rounded-sm shadow-lg bg-blue-600 hover:bg-blue-800 text-center";

        DB::table('properties')->insert([
            'category' => 'MLOG',
            'code' => 'FB',
            'name' => 'Facebook',
            'data' => json_encode($propFB)
        ]);

        $propGO = new Stdclass();
        $propGO->class = "my-3 inline-block transition ease-in duration-200 rounded-sm shadow-lg bg-red-600 hover:bg-red-800 text-center";

        DB::table('properties')->insert([
            'category' => 'MLOG',
            'code' => 'GLE',
            'name' => 'Google',
            'data' => json_encode($propGO)
        ]);
    }
}
