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
            'category' => 'SUBCAT',
            'code' => 'PANT',
            'name' => 'Pantalón'
        ]);

        DB::table('properties')->insert([
            'category' => 'SUBCAT',
            'code' => 'TSHIRT',
            'name' => 'Remera'
        ]);

        // PRODUCTS

        $categories = new stdClass;
        $categories->categories = 1;

        $sizesOne = new stdClass;
        $sizesOne->S = 2;
        $sizesOne->M = 4;
        $sizesOne->XL = 4;

        $sizesTwo = new stdClass;
        $sizesTwo->S = 1;
        $sizesTwo->L = 5;
        $sizesTwo->XL = 4;

        $colors = new stdClass;
        $colors->yellow = $sizesOne;
        $colors->black = $sizesOne;
        $colors->green = $sizesTwo;

        $colorsTwo = new stdClass;
        $colorsTwo->black =  $sizesTwo;
        $colorsTwo->gray =  $sizesTwo;
        $colorsTwo->blue =  $sizesOne;



        DB::table('products')->insert([
            'name' => 'Sudadera Nike',
            'slug' => 'SudaderaNike',
            'description' => 'El mejor pantalon de la vida',
            'stock' => 10,
            'price' => 250.00,
            'category' => json_encode($categories),
            'data' => json_encode($colorsTwo),
            'url_photos' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSnMPTgGjLMCU5FPFFn6GaxrNdv2ROkhUkDQ&usqp=CAU",
            'is_active' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'Pantalón Gucci',
            'slug' => 'PantalonGucci',
            'description' => 'alto lompa',
            'stock' => 10,
            'price' => 450.00,
            'category' => json_encode($categories),
            'data' => json_encode($colors),
            'url_photos' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSnMPTgGjLMCU5FPFFn6GaxrNdv2ROkhUkDQ&usqp=CAU",
            'is_active' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'Campera Air Jordan',
            'slug' => 'CamperaAirJordan',
            'description' => 'alta pilcha juju',
            'stock' => 10,
            'price' => 999.99,
            'category' => json_encode($categories),
            'data' => json_encode($colorsTwo),
            'url_photos' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSnMPTgGjLMCU5FPFFn6GaxrNdv2ROkhUkDQ&usqp=CAU",
            'is_active' => 1
        ]);

        //
        DB::table('products')->insert([
            'name' => 'Sudadera Puma',
            'slug' => 'SudaderaPuma',
            'description' => 'El mejor pantalon de la vida',
            'stock' => 10,
            'price' => 480.00,
            'category' => json_encode($categories),
            'data' => json_encode($colors),
            'url_photos' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSnMPTgGjLMCU5FPFFn6GaxrNdv2ROkhUkDQ&usqp=CAU",
            'is_active' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'Remera Gucci',
            'slug' => 'RemeraGucci',
            'description' => 'alto lompa',
            'stock' => 10,
            'price' => 450.00,
            'category' => json_encode($categories),
            'data' => json_encode($colors),
            'url_photos' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSnMPTgGjLMCU5FPFFn6GaxrNdv2ROkhUkDQ&usqp=CAU",
            'is_active' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'Campera NorthFace',
            'slug' => 'CamperaNorthFace',
            'description' => 'alta pilcha juju',
            'stock' => 10,
            'price' => 799.99,
            'category' => json_encode($categories),
            'data' => json_encode($colorsTwo),
            'url_photos' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSnMPTgGjLMCU5FPFFn6GaxrNdv2ROkhUkDQ&usqp=CAU",
            'is_active' => 1
        ]);

        //
        DB::table('products')->insert([
            'name' => 'Musculosa Nike',
            'slug' => 'MusculosaNike',
            'description' => 'El mejor pantalon de la vida',
            'stock' => 10,
            'price' => 179.99,
            'category' => json_encode($categories),
            'data' => json_encode($colors),
            'url_photos' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSnMPTgGjLMCU5FPFFn6GaxrNdv2ROkhUkDQ&usqp=CAU",
            'is_active' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'Pantalón Kappa',
            'slug' => 'PantalonKappa',
            'description' => 'alto lompa',
            'stock' => 10,
            'price' => 420.00,
            'category' => json_encode($categories),
            'data' => json_encode($colors),
            'url_photos' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSnMPTgGjLMCU5FPFFn6GaxrNdv2ROkhUkDQ&usqp=CAU",
            'is_active' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'Campera Air Jordan',
            'slug' => 'CamperaAirJordan',
            'description' => 'alta pilcha juju',
            'stock' => 10,
            'price' => 999.99,
            'category' => json_encode($categories),
            'data' => json_encode($colors),
            'url_photos' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSnMPTgGjLMCU5FPFFn6GaxrNdv2ROkhUkDQ&usqp=CAU",
            'is_active' => 1
        ]);

        //
        DB::table('products')->insert([
            'name' => 'Campera Adidas',
            'slug' => 'CamperaAdidas',
            'description' => 'El mejor pantalon de la vida',
            'stock' => 10,
            'price' => 300.00,
            'category' => json_encode($categories),
            'data' => json_encode($colors),
            'url_photos' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSnMPTgGjLMCU5FPFFn6GaxrNdv2ROkhUkDQ&usqp=CAU",
            'is_active' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'Medias Gucci',
            'slug' => 'CamperaAdidas',
            'description' => 'alto lompa',
            'stock' => 10,
            'price' => 150.00,
            'category' => json_encode($categories),
            'data' => json_encode($colorsTwo),
            'url_photos' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSnMPTgGjLMCU5FPFFn6GaxrNdv2ROkhUkDQ&usqp=CAU",
            'is_active' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'Campera Burberry',
            'slug' => 'CamperaAdidas',
            'description' => 'alta pilcha juju',
            'stock' => 10,
            'price' => 1999.99,
            'category' => json_encode($categories),
            'data' => json_encode($colorsTwo),
            'url_photos' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSnMPTgGjLMCU5FPFFn6GaxrNdv2ROkhUkDQ&usqp=CAU",
            'is_active' => 1
        ]);
    }
}
