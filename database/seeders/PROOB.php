<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use stdClass;

class PROOB extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('properties')->insert([
        //     'category' => 'GENDER',
        //     'code' => 'M',
        //     'name' => 'Hombre'
        // ]);

        // DB::table('properties')->insert([
        //     'category' => 'GENDER',
        //     'code' => 'W',
        //     'name' => 'Mujer'
        // ]);

        // DB::table('properties')->insert([
        //     'category' => 'CAT',
        //     'code' => 'SPORT',
        //     'name' => 'Ropa deportiva',
        // ]);

        // DB::table('properties')->insert([
        //     'category' => 'SUBCAT',
        //     'code' => 'PANT',
        //     'name' => 'Pantalón'
        // ]);

        // DB::table('properties')->insert([
        //     'category' => 'SUBCAT',
        //     'code' => 'TSHIRT',
        //     'name' => 'Remera'
        // ]);

        // PRODUCTS

        $categories = new stdClass;
        $categories->categories = 1;


        DB::table('products')->insert([
            'name' => 'Sudadera Nike',
            'description' => 'El mejor pantalon de la vida',
            'stock' => 3,
            'price' => 250.00,
            'category' => json_encode($categories),
            'url_photos' => "asfasjdfklejfewf",
            'is_active' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'Pantalón Gucci',
            'description' => 'alto lompa',
            'stock' => 7,
            'price' => 450.00,
            'category' => json_encode($categories),
            'url_photos' => "asfasjdfklejfewf",
            'is_active' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'Air Jordan',
            'description' => 'alta pilcha juju',
            'stock' => 7,
            'price' => 999.99,
            'category' => json_encode($categories),
            'url_photos' => "asfasjdfklejfewf",
            'is_active' => 1
        ]);
    }
}
