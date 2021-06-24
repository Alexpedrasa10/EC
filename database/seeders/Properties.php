<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Properties extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('properties')->insert([
            'category' => 'GENDER',
            'code' => 'M',
            'name' => 'Hombre'
        ]);

        DB::table('properties')->insert([
            'category' => 'GENDER',
            'code' => 'W',
            'name' => 'Mujer'
        ]);

        DB::table('properties')->insert([
            'category' => 'CAT',
            'code' => 'SPORT',
            'name' => 'Ropa deportiva',
        ]);

        DB::table('properties')->insert([
            'category' => 'CAT',
            'code' => 'URBAN',
            'name' => 'Ropa urbana',
        ]);

        DB::table('properties')->insert([
            'category' => 'CAT',
            'code' => 'ACCES',
            'name' => 'Accesorio',
        ]);

        DB::table('properties')->insert([
            'category' => 'SUBCAT',
            'code' => 'PANT',
            'name' => 'Pantalón'
        ]);

        DB::table('properties')->insert([
            'category' => 'SUBCAT',
            'code' => 'TSHIRT',
            'name' => 'Remera'
        ]);

        // Tabla Pivot
        DB::table('product_properties')->insert([
            'product_id' => 1,
            'property_id' => 3,
        ]);

        DB::table('product_properties')->insert([
            'product_id' => 1,
            'property_id' => 1,
        ]);

        DB::table('product_properties')->insert([
            'product_id' => 2,
            'property_id' => 2,
        ]);

        DB::table('product_properties')->insert([
            'product_id' => 2,
            'property_id' => 4,
        ]);

        DB::table('product_properties')->insert([
            'product_id' => 2,
            'property_id' => 3,
        ]);

        DB::table('product_properties')->insert([
            'product_id' => 2,
            'property_id' => 6,
        ]);

        DB::table('product_properties')->insert([
            'product_id' => 3,
            'property_id' => 1,
        ]);

        DB::table('product_properties')->insert([
            'product_id' => 3,
            'property_id' => 4,
        ]);

        DB::table('product_properties')->insert([
            'product_id' => 4,
            'property_id' => 1,
        ]);

        DB::table('product_properties')->insert([
            'product_id' => 4,
            'property_id' => 3,
        ]);

        DB::table('product_properties')->insert([
            'product_id' => 5,
            'property_id' => 2,
        ]);

        DB::table('product_properties')->insert([
            'product_id' => 5,
            'property_id' => 4,
        ]);

        DB::table('product_properties')->insert([
            'product_id' => 5,
            'property_id' => 6,
        ]);

        DB::table('product_properties')->insert([
            'product_id' => 6,
            'property_id' => 1,
        ]);

        DB::table('product_properties')->insert([
            'product_id' => 6,
            'property_id' => 4,
        ]);

        DB::table('product_properties')->insert([
            'product_id' => 7,
            'property_id' => 2,
        ]);

        DB::table('product_properties')->insert([
            'product_id' => 7,
            'property_id' => 4,
        ]);
    }
}
