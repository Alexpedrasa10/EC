<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Categories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'category' => 'GENDER',
            'code' => 'MEN',
            'name' => 'Hombre'
        ]);

        DB::table('categories')->insert([
            'category' => 'GENDER',
            'code' => 'WOMEN',
            'name' => 'Mujer'
        ]);

        DB::table('categories')->insert([
            'category' => 'CAT',
            'code' => 'SPORT',
            'name' => 'Ropa deportiva',
        ]);

        DB::table('categories')->insert([
            'category' => 'CAT',
            'code' => 'URBAN',
            'name' => 'Ropa urbana',
        ]);

        DB::table('categories')->insert([
            'category' => 'CAT',
            'code' => 'ACCES',
            'name' => 'Accesorio',
        ]);

        DB::table('categories')->insert([
            'category' => 'SUBCAT',
            'code' => 'PANT',
            'name' => 'Pantalón'
        ]);

        DB::table('categories')->insert([
            'category' => 'SUBCAT',
            'code' => 'TSHIRT',
            'name' => 'Remera'
        ]);

        DB::table('categories')->insert([
            'category' => 'CAT',
            'code' => 'HYPE',
            'name' => 'Hype'
        ]);

        DB::table('categories')->insert([
            'category' => 'BRAND',
            'code' => 'PSG',
            'name' => 'Paris Saint-Germain'
        ]);

        DB::table('categories')->insert([
            'category' => 'BRAND',
            'code' => 'NIKE',
            'name' => 'Nike'
        ]);

        DB::table('categories')->insert([
            'category' => 'BRAND',
            'code' => 'ADIDAS',
            'name' => 'Adidas'
        ]);

        DB::table('categories')->insert([
            'category' => 'BRAND',
            'code' => 'PUMA',
            'name' => 'Puma',
        ]);

        DB::table('categories')->insert([
            'category' => 'BRAND',
            'code' => 'GUCCI',
            'name' => 'Gucci',
        ]);

        DB::table('categories')->insert([
            'category' => 'BRAND',
            'code' => 'NORTHFACE',
            'name' => 'North Face',
        ]);

        DB::table('categories')->insert([
            'category' => 'BRAND',
            'code' => 'BURBERRY',
            'name' => 'Burberry',
        ]);

        DB::table('categories')->insert([
            'category' => 'BRAND',
            'code' => 'JORDAN',
            'name' => 'Jordan'
        ]);

        DB::table('categories')->insert([
            'category' => 'SUBCAT',
            'code' => ' SNEAKER',
            'name' => 'Sneaker'
        ]);

        // Tabla Pivot
        DB::table('product_categories')->insert([
            'product_id' => 1,
            'category_id' => 3,
        ]);

        DB::table('product_categories')->insert([
            'product_id' => 1,
            'category_id' => 1,
        ]);

        DB::table('product_categories')->insert([
            'product_id' => 2,
            'category_id' => 2,
        ]);

        DB::table('product_categories')->insert([
            'product_id' => 2,
            'category_id' => 4,
        ]);

        DB::table('product_categories')->insert([
            'product_id' => 2,
            'category_id' => 3,
        ]);

        DB::table('product_categories')->insert([
            'product_id' => 2,
            'category_id' => 6,
        ]);

        DB::table('product_categories')->insert([
            'product_id' => 3,
            'category_id' => 1,
        ]);

        DB::table('product_categories')->insert([
            'product_id' => 3,
            'category_id' => 4,
        ]);

        DB::table('product_categories')->insert([
            'product_id' => 4,
            'category_id' => 1,
        ]);

        DB::table('product_categories')->insert([
            'product_id' => 4,
            'category_id' => 3,
        ]);

        DB::table('product_categories')->insert([
            'product_id' => 5,
            'category_id' => 2,
        ]);

        DB::table('product_categories')->insert([
            'product_id' => 5,
            'category_id' => 4,
        ]);

        DB::table('product_categories')->insert([
            'product_id' => 5,
            'category_id' => 6,
        ]);

        DB::table('product_categories')->insert([
            'product_id' => 6,
            'category_id' => 1,
        ]);

        DB::table('product_categories')->insert([
            'product_id' => 6,
            'category_id' => 4,
        ]);

        DB::table('product_categories')->insert([
            'product_id' => 7,
            'category_id' => 2,
        ]);

        DB::table('product_categories')->insert([
            'product_id' => 7,
            'category_id' => 4,
        ]);
    }
}
