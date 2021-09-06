<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PropertiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('properties')->delete();
        
        \DB::table('properties')->insert(array (
            0 => 
            array (
                'id' => 1,
                'category' => 'PMET',
                'code' => 'MLA',
                'name' => 'Mercadopago',
                'data' => NULL,
                'active' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'category' => 'OSTA',
                'code' => 'PROC',
                'name' => 'Procesando',
                'data' => NULL,
                'active' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'category' => 'OSTA',
                'code' => 'SUCC',
                'name' => 'Pago con éxito',
                'data' => NULL,
                'active' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'category' => 'MLOG',
                'code' => 'FB',
                'name' => 'Facebook',
                'data' => '{"class": "my-3 inline-block transition ease-in duration-200 rounded-sm shadow-lg bg-blue-600 hover:bg-blue-800 text-center"}',
                'active' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'category' => 'MLOG',
                'code' => 'GLE',
                'name' => 'Google',
                'data' => '{"class": "my-3 inline-block transition ease-in duration-200 rounded-sm shadow-lg bg-red-600 hover:bg-red-800 text-center"}',
                'active' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'category' => 'PMET',
                'code' => 'PYP',
                'name' => 'Paypal',
                'data' => NULL,
                'active' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'category' => 'CURR',
                'code' => 'ARS',
                'name' => 'Peso Argentino',
                'data' => NULL,
                'active' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'category' => 'CURR',
                'code' => 'USD',
                'name' => 'Dólar americano',
                'data' => NULL,
                'active' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'category' => 'CURR',
                'code' => 'BTC',
                'name' => 'Bitcoin',
                'data' => NULL,
                'active' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'category' => 'OSTA',
                'code' => 'CANCEL',
                'name' => 'Cancelado',
                'data' => NULL,
                'active' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}