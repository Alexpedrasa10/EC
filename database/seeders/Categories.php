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
            'name' => 'Generos'
        ]);

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
            'name' => 'Categorías',
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
            'category' => 'CAT',
            'code' => 'PANT',
            'name' => 'Pantalón'
        ]);

        DB::table('categories')->insert([
            'category' => 'CAT',
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
            'name' => 'Marcas'
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
            'category' => 'CAT',
            'code' => ' SNEAKER',
            'name' => 'Sneaker'
        ]);
    }
}
