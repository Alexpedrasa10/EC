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
            'code' => 'MEN',
            'name' => 'Hombre'
        ]);

        DB::table('properties')->insert([
            'category' => 'GENDER',
            'code' => 'WOMEN',
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

        DB::table('properties')->insert([
            'category' => 'CAT',
            'code' => 'HYPE',
            'name' => 'Hype'
        ]);

        DB::table('properties')->insert([
            'category' => 'BRAND',
            'code' => 'PSG',
            'name' => 'Paris Saint-Germain'
        ]);

        DB::table('properties')->insert([
            'category' => 'BRAND',
            'code' => 'NIKE',
            'name' => 'Nike'
        ]);

        DB::table('properties')->insert([
            'category' => 'BRAND',
            'code' => 'ADIDAS',
            'name' => 'Adidas'
        ]);

        DB::table('properties')->insert([
            'category' => 'BRAND',
            'code' => 'PUMA',
            'name' => 'Puma',
        ]);

        DB::table('properties')->insert([
            'category' => 'BRAND',
            'code' => 'GUCCI',
            'name' => 'Gucci',
        ]);

        DB::table('properties')->insert([
            'category' => 'BRAND',
            'code' => 'NORTHFACE',
            'name' => 'North Face',
        ]);

        DB::table('properties')->insert([
            'category' => 'BRAND',
            'code' => 'BURBERRY',
            'name' => 'Burberry',
        ]);

        DB::table('properties')->insert([
            'category' => 'BRAND',
            'code' => 'JORDAN',
            'name' => 'Jordan'
        ]);

        DB::table('properties')->insert([
            'category' => 'SUBCAT',
            'code' => ' SNEAKER',
            'name' => 'Sneaker'
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
