<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'for_products' => False
        ]);

        DB::table('properties')->insert([
            'category' => 'OSTA',
            'code' => 'PROC',
            'name' => 'Procesando',
            'for_products' => False
        ]);

        DB::table('properties')->insert([
            'category' => 'OSTA',
            'code' => 'SUCC',
            'name' => 'Pago con éxito',
            'for_products' => False
        ]);
    }
}
